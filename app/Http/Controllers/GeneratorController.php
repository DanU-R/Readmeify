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
        // Kita scan file kunci untuk menentukan bahasa pemrograman
        
        $makeRequest = function($path) use ($user, $owner, $repo) {
            return Http::withToken($user->github_token)
                ->withoutVerifying()
                ->get("https://api.github.com/repos/{$owner}/{$repo}/{$path}");
        };

        // 1. Cek File Dependency (PHP, JS, Python, Golang)
        $filesToCheck = [
            'contents/composer.json', // PHP
            'contents/package.json',  // JS/Node
            'contents/requirements.txt', // Python
            'contents/go.mod', // Go
            'contents/Gemfile', // Ruby
        ];
        
        foreach ($filesToCheck as $file) {
            $res = $makeRequest($file);
            if ($res->successful()) {
                $content = base64_decode($res->json()['content']);
                // Ambil keyword teknologi dari file dependency
                preg_match_all('/"([^"]+)"\s*:/', $content, $matches); 
                if (!empty($matches[1])) $techStack = array_merge($techStack, array_slice($matches[1], 0, 15));
            }
        }

        // 2. Cek Bahasa Utama dari GitHub
        $languages = $makeRequest('languages');
        if ($languages->successful()) {
            $techStack = array_merge($techStack, array_keys($languages->json()));
        }

        // Bersihkan duplikat
        $techStackList = implode(', ', array_unique($techStack));
        
        // --- LOGIKA CERDAS: DETEKSI FRAMEWORK ---
        // Kita tentukan instruksi instalasi berdasarkan apa yang ditemukan
        
        $installInstruction = "Analyze the tech stack ({$techStackList}) and provide the standard, best-practice installation steps for this specific technology.";

        // Cek apakah ini Laravel?
        if (str_contains(strtolower($techStackList), 'laravel')) {
            $installInstruction = "Since this is a **Laravel** project, you MUST include specific steps:
            1. `cp .env.example .env` (Environment Setup)
            2. `composer install` (Dependencies)
            3. `php artisan key:generate`
            4. `php artisan migrate` (Database)
            5. `npm install && npm run build` (Assets)
            6. `php artisan serve`";
        } 
        // Cek apakah ini Node.js / React / Vue?
        elseif (str_contains(strtolower($techStackList), 'react') || str_contains(strtolower($techStackList), 'vue') || str_contains(strtolower($techStackList), 'next.js') || str_contains(strtolower($techStackList), 'express')) {
            $installInstruction = "Since this is a **Node.js/JavaScript** project, you MUST include specific steps:
            1. `npm install` or `yarn install`
            2. Environment setup (.env) if applicable
            3. `npm run dev` or `npm start` to run the server.";
        }
        // Cek apakah ini Python / Django / Flask?
        elseif (str_contains(strtolower($techStackList), 'django') || str_contains(strtolower($techStackList), 'flask') || str_contains(strtolower($techStackList), 'python')) {
            $installInstruction = "Since this is a **Python** project, you MUST include specific steps:
            1. Create a virtual environment (`python -m venv venv` and `source venv/bin/activate`)
            2. `pip install -r requirements.txt`
            3. Database migrations (if Django: `python manage.py migrate`)
            4. Run server (`python manage.py runserver` or `flask run`).";
        }

        // --- LOGIKA BAHASA (ID/EN) ---
        $lang = $request->query('lang', 'en'); 
        $languageInstruction = "Write the README entirely in English.";
        if ($lang === 'id') {
            $languageInstruction = "IMPORTANT: Write the entire README in INDONESIAN LANGUAGE (Bahasa Indonesia). Use formal, professional tone. However, keep technical commands (like 'composer install', 'npm run dev') in English/Code.";
        }
        
        // --- BAGIAN 2: OTAK AI (OPENAI) ---

        $model = "gpt-4o-mini"; 
        $apiKey = env('OPENAI_API_KEY');
        
        // Prompt Dinamis
        $prompt = "Act as a Senior Open Source Maintainer. Write a visually stunning GitHub README.md for a project named '{$repo}'. 
        
        The project uses these technologies: {$techStackList}.
        
        LANGUAGE REQUIREMENT:
        {$languageInstruction}
        
        RULES FOR VISUALS:
        1. **Badges:** You MUST use Shields.io badges for the tech stack.
        2. **Layout:** Center-align the Project Title and Description.
        3. **Icons:** Use Emojis for all section headers.
        
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
        [List the technologies using Shields.io Badges 'for-the-badge' style.]

        ## ⚙️ Installation
        Provide a step-by-step guide to set up this project locally.
        
        INSTALLATION RULES FOR THIS PROJECT:
        {$installInstruction} 

        IMPORTANT: You MUST wrap all command line instructions in code blocks with the correct language identifier (bash, python, etc.).

        ## 🤝 Contributing
        Contributions are welcome!

        ## 📄 License
        This project is licensed under the MIT License.
        
        IMPORTANT: Return ONLY the raw Markdown content. Do NOT use code blocks (```markdown).";

        // Request ke OpenAI
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

        // Cek Error
        if ($response->failed()) {
            dd([
                'error' => 'Gagal koneksi ke OpenAI',
                'status' => $response->status(),
                'body' => $response->json()
            ]);
        }

        $generatedReadme = $response->json()['choices'][0]['message']['content'];

        // --- PEMBERSIH CERDAS ---
        $lines = explode("\n", $generatedReadme);
        
        if (isset($lines[0]) && (str_contains($lines[0], '```markdown') || str_contains($lines[0], '```'))) {
            array_shift($lines);
        }
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
        $message = "docs: update README.md via Readmeify ✨";

        $checkUrl = "https://api.github.com/repos/{$owner}/{$repo}/contents/README.md";
        
        $checkResponse = Http::withToken($user->github_token)
            ->withoutVerifying()
            ->get($checkUrl);

        $sha = null;
        if ($checkResponse->successful()) {
            $sha = $checkResponse->json()['sha']; 
        }

        $data = [
            'message' => $message,
            'content' => base64_encode($content),
        ];

        if ($sha) {
            $data['sha'] = $sha;
        }

        $response = Http::withToken($user->github_token)
            ->withoutVerifying()
            ->put($checkUrl, $data);

        if ($response->successful()) {
            return redirect()->route('dashboard')->with('success', "Berhasil! README.md di repo {$repo} sudah terupdate! 🚀");
        } else {
            return back()->with('error', 'Gagal commit ke GitHub: ' . $response->body());
        }
    }
}