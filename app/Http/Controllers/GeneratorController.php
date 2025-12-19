<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;

class GeneratorController extends Controller
{
    public function generate(Request $request, $owner, $repo)
    {
        $user = Auth::user();
        $techStack = [];

        // --- BAGIAN 1: MATA-MATA (SCANNING) ---
        
        $makeRequest = function($path) use ($user, $owner, $repo) {
            return Http::withToken($user->github_token)
                ->withoutVerifying()
                ->get("https://api.github.com/repos/{$owner}/{$repo}/{$path}");
        };

        // 1. Cek File Dependency
        $filesToCheck = ['contents/composer.json', 'contents/package.json', 'contents/requirements.txt'];
        foreach ($filesToCheck as $file) {
            $res = $makeRequest($file);
            if ($res->successful()) {
                $content = base64_decode($res->json()['content']);
                preg_match_all('/"([^"]+)"\s*:/', $content, $matches); 
                if (!empty($matches[1])) $techStack = array_merge($techStack, array_slice($matches[1], 0, 15));
            }
        }

        // 2. Cek Bahasa Utama
        $languages = $makeRequest('languages');
        if ($languages->successful()) {
            $techStack = array_merge($techStack, array_keys($languages->json()));
        }

        $techStackList = implode(', ', array_unique($techStack));
        
        // --- LOGIKA BAHASA (LANGUAGE SWITCHER) ---
        $lang = $request->query('lang', 'en'); 
        
        $languageInstruction = "Write the README entirely in English.";
        if ($lang === 'id') {
            $languageInstruction = "IMPORTANT: Write the entire README in INDONESIAN LANGUAGE (Bahasa Indonesia). Use formal, professional, and engaging tone. However, keep technical terms (like 'composer install', 'build', 'deploy') in English/Code.";
        }
        
        // --- BAGIAN 2: OTAK AI (OPENAI) ---

        $model = "gpt-4o-mini"; 
        $apiKey = env('OPENAI_API_KEY');
        
        // Prompt
        $prompt = "Act as a Senior Open Source Maintainer. Write a visually stunning GitHub README.md for a project named '{$repo}'. 
        
        The project uses these technologies: {$techStackList}.
        
        LANGUAGE REQUIREMENT:
        {$languageInstruction}
        
        RULES FOR VISUALS:
        1. **Badges:** You MUST use Shields.io badges for the tech stack.
        2. **Layout:** Center-align the Project Title and Description.
        3. **Icons:** Use Emojis for all section headers (e.g., 🚀 Features, 🛠️ Tech Stack).
        
        Structure the README exactly like this:
        
        <div align='center'>
           <h1>{$repo}</h1>
           <p>A short, catchy slogan for the project.</p>
           
           <p>
              <img src='https://img.shields.io/github/last-commit/{$owner}/{$repo}?style=for-the-badge&logo=github&color=blue' alt='Last Commit'>
              <img src='https://img.shields.io/github/license/{$owner}/{$repo}?style=for-the-badge&logo=github&color=green' alt='License'>
              <img src='https://img.shields.io/github/stars/{$owner}/{$repo}?style=for-the-badge&logo=github&color=yellow' alt='Stars'>
           </p>
        </div>

        ## 📖 About
        [Write a professional description here]

        ## 🚀 Key Features
        * ✅ **Feature 1:** Description
        * ✅ **Feature 2:** Description
        (Invent 4-5 features based on the tech stack: {$techStackList})

        ## 🛠️ Tech Stack
        [List the technologies using Shields.io Badges 'for-the-badge' style. Group them logically (Backend, Frontend, Tools).]

        ## ⚙️ Installation
        Provide a step-by-step guide.
        IMPORTANT: You MUST wrap all command line instructions in code blocks with the 'bash' language identifier. 
        Example format:
        ```bash
        composer install
        npm install
        ```

        ## 🤝 Contributing
        Contributions are welcome!

        ## 📄 License
        This project is licensed under the MIT License.
        
        IMPORTANT: Return ONLY the raw Markdown content. Do NOT use code blocks (```markdown).";

        // Request ke OpenAI (URL SUDAH BERSIH DAN LANGSUNG STRING)
        $response = Http::withToken($apiKey)
            ->withoutVerifying()
            ->post('https://api.openai.com/v1/chat/completions', [
                'model' => $model,
                'messages' => [
                    ['role' => 'system', 'content' => 'You are a Markdown expert specializing in beautiful GitHub READMEs.'],
                    ['role' => 'user', 'content' => $prompt]
                ],
                'temperature' => 0.7,
            ]);

        // Cek Error Koneksi
        if ($response->failed()) {
            dd([
                'error' => 'Gagal koneksi ke OpenAI',
                'status' => $response->status(),
                'body' => $response->json()
            ]);
        }

        $generatedReadme = $response->json()['choices'][0]['message']['content'];

        // --- BAGIAN 3: PEMBERSIH CERDAS ---
        
        $lines = explode("\n", $generatedReadme);
        
        // Hapus ```markdown di baris pertama
        if (isset($lines[0]) && (str_contains($lines[0], '```markdown') || str_contains($lines[0], '```'))) {
            array_shift($lines);
        }
        
        // Hapus ``` di baris terakhir
        if (isset($lines[count($lines)-1]) && trim($lines[count($lines)-1]) === '```') {
            array_pop($lines);
        }
        
        $generatedReadme = implode("\n", $lines);
        
        // Tampilkan Hasil
        return view('preview', [
            'readme' => $generatedReadme,
            'owner' => $owner,
            'repo' => $repo
        ]);
    }

    public function commit(Request $request)
    {
        $user = Auth::user();
        $owner = $request->owner;
        $repo = $request->repo;
        $content = $request->readme_content;
        $message = "docs: update README.md via Auto-Readme AI ✨";

        // 1. Cek File Lama
        $checkUrl = "https://api.github.com/repos/{$owner}/{$repo}/contents/README.md";
        
        $checkResponse = Http::withToken($user->github_token)
            ->withoutVerifying()
            ->get($checkUrl);

        $sha = null;
        if ($checkResponse->successful()) {
            $sha = $checkResponse->json()['sha']; 
        }

        // 2. Siapkan Data
        $data = [
            'message' => $message,
            'content' => base64_encode($content),
        ];

        if ($sha) {
            $data['sha'] = $sha;
        }

        // 3. Eksekusi PUT
        $response = Http::withToken($user->github_token)
            ->withoutVerifying()
            ->put($checkUrl, $data);

        // 4. Cek Hasil
        if ($response->successful()) {
            return redirect()->route('dashboard')->with('success', "Berhasil! README.md di repo {$repo} sudah terupdate! 🚀");
        } else {
            return back()->with('error', 'Gagal commit ke GitHub: ' . $response->body());
        }
    }
}