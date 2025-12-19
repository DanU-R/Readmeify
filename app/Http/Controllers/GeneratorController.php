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

        // --- BAGIAN 1: SCANNING ---
        
        $makeRequest = function($path) use ($user, $owner, $repo) {
            return Http::withToken($user->github_token)
                ->withoutVerifying()
                ->get("https://api.github.com/repos/{$owner}/{$repo}/{$path}");
        };

        // 1. Cek File Dependency
        $filesToCheck = [
            'contents/composer.json', 
            'contents/package.json',  
            'contents/requirements.txt', 
        ];
        
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
        
        // --- LOGIKA INSTALLATION (DESKRIPTIF + KODE) ---
        // Perbaikan: Kita minta AI menulis Deskripsi DULU, baru Kode.
        
        $installInstruction = "Provide standard installation steps.";

        if (str_contains(strtolower($techStackList), 'laravel')) {
            $installInstruction = "This is a **Laravel** project. Generate a detailed installation guide.
            
            Structure each step like this:
            1. **Step Title**: Brief explanation of WHY this step is needed.
            2. Code Block (bash).

            REQUIRED STEPS:
            1. **Clone Repository**: Explain cloning.
               (Command: git clone https://github.com/{$owner}/{$repo}.git)
            
            2. **Install Dependencies**: Explain that we need to install PHP and JS libraries.
               (Command: composer install && npm install)
            
            3. **Environment Setup**: Explain copying .env file for database credentials.
               (Command: cp .env.example .env)
            
            4. **Key & Database**: Explain generating app key and migrating DB.
               (Command: php artisan key:generate && php artisan migrate)
            
            5. **Serve**: Explain how to start the app.
               (Command: npm run build && php artisan serve)";
        } 
        elseif (str_contains(strtolower($techStackList), 'node') || str_contains(strtolower($techStackList), 'react') || str_contains(strtolower($techStackList), 'vue')) {
            $installInstruction = "This is a **Node.js** project. Generate detailed steps:
            1. **Clone**: Explain cloning.
            2. **Install**: Explain installing NPM packages (Command: npm install).
            3. **Run**: Explain starting the dev server (Command: npm run dev).";
        }

        // --- LOGIKA BAHASA ---
        $lang = $request->query('lang', 'en'); 
        $languageInstruction = "Write the README entirely in English.";
        if ($lang === 'id') {
            $languageInstruction = "IMPORTANT: Write the entire README in INDONESIAN LANGUAGE (Bahasa Indonesia). Use formal, professional tone. However, keep technical commands in English.";
        }
        
        // --- BAGIAN 2: OTAK AI ---

        $model = "gpt-4o-mini"; 
        $apiKey = env('OPENAI_API_KEY');
        
        $prompt = "Act as a Senior Open Source Maintainer. Write a visually stunning GitHub README.md for a project named '{$repo}'. 
        
        The project uses these technologies: {$techStackList}.
        
        LANGUAGE REQUIREMENT:
        {$languageInstruction}
        
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
        (Invent 4-5 features based on: {$techStackList})

        ## 🛠️ Tech Stack
        [List technologies using Shields.io Badges]

        ## ⚙️ Installation
        Provide a step-by-step guide.
        {$installInstruction}
        
        IMPORTANT RULE FOR INSTALLATION: 
        - You MUST provide a short text description BEFORE every code block. Do not just list code blocks.
        - Use TRIPLE BACKTICK CODE BLOCKS (```bash) for commands.

        ## 🤝 Contributing
        Contributions are welcome!

        ## 📄 License
        This project is licensed under the MIT License.
        
        IMPORTANT: Return ONLY the raw Markdown content.";

        $response = Http::withToken($apiKey)
            ->withoutVerifying()
            ->post('https://api.openai.com/v1/chat/completions', [
                'model' => $model,
                'messages' => [
                    ['role' => 'system', 'content' => 'You are a Markdown expert.'],
                    ['role' => 'user', 'content' => $prompt]
                ],
                'temperature' => 0.7,
            ]);

        if ($response->failed()) {
            dd($response->json());
        }

        $generatedReadme = $response->json()['choices'][0]['message']['content'];

        // Pembersih
        $lines = explode("\n", $generatedReadme);
        if (isset($lines[0]) && (str_contains($lines[0], '```markdown') || str_contains($lines[0], '```'))) array_shift($lines);
        if (isset($lines[count($lines)-1]) && trim($lines[count($lines)-1]) === '```') array_pop($lines);
        $generatedReadme = implode("\n", $lines);
        
        return view('preview', [
            'readme' => $generatedReadme,
            'owner' => $owner,
            'repo' => $repo
        ]);
    }

    public function commit(Request $request)
    {
        $user = Auth::user();
        
        // 1. Validasi Input (Mencegah URL kosong)
        $owner = $request->input('owner');
        $repo = $request->input('repo');
        $content = $request->input('readme_content');

        if (empty($owner) || empty($repo) || empty($content)) {
            return back()->with('error', 'Data repository tidak lengkap. Silakan generate ulang.');
        }

        $message = "docs: update README.md via Readmeify ✨";

        // 2. Definisi URL (Ditulis ulang manual agar bersih)
        $targetUrl = "https://api.github.com/repos/" . $owner . "/" . $repo . "/contents/README.md";

        // 3. Cek File Lama
        $checkResponse = Http::withToken($user->github_token)
            ->withoutVerifying()
            ->get($targetUrl);

        $sha = null;
        if ($checkResponse->successful()) {
            $sha = $checkResponse->json()['sha']; 
        }

        // 4. Siapkan Data
        $data = [
            'message' => $message,
            'content' => base64_encode($content),
        ];

        if ($sha) {
            $data['sha'] = $sha;
        }

        // 5. Eksekusi PUT
        $response = Http::withToken($user->github_token)
            ->withoutVerifying()
            ->put($targetUrl, $data);

        if ($response->successful()) {
            return redirect()->route('dashboard')->with('success', "Berhasil! README.md di repo {$repo} sudah terupdate! 🚀");
        } else {
            return back()->with('error', 'Gagal commit ke GitHub: ' . $response->body());
        }
    }
}