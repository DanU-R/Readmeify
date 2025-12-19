<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <title>Readmeify – AI README Generator</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = { darkMode: 'class' }
    </script>
</head>

<body class="bg-gradient-to-br from-gray-50 via-white to-gray-100
             dark:from-gray-900 dark:via-gray-950 dark:to-black
             text-gray-800 dark:text-gray-200 min-h-screen transition">

<!-- ================= NAVBAR ================= -->
<nav class="bg-white/80 dark:bg-gray-900/80 backdrop-blur border-b
            border-gray-200 dark:border-gray-800 sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 h-16 flex justify-between items-center">
        <div class="flex items-center gap-3">
            <img src="{{ asset('assets/logo.png') }}" class="w-7 h-7" alt="Readmeify">
            <span class="font-extrabold text-lg">Readmeify</span>
        </div>

        <div class="flex items-center gap-3">
            <button id="themeToggle"
                class="w-9 h-9 rounded-full flex items-center justify-center
                       hover:bg-gray-200 dark:hover:bg-gray-800 transition">
                🌙
            </button>

            <a href="{{ route('auth.github') }}"
               class="bg-gray-900 dark:bg-white dark:text-gray-900
                      text-white px-4 py-2 rounded-lg font-semibold">
                Login
            </a>
        </div>
    </div>
</nav>

<!-- ================= HERO ================= -->
<section class="relative overflow-hidden">
    <div class="absolute inset-0 bg-gradient-to-r from-indigo-500/10 to-purple-500/10"></div>

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 py-20
                grid md:grid-cols-2 gap-14 items-center">

        <div>
            <span class="inline-block mb-4 bg-indigo-100 dark:bg-indigo-900/40
                         text-indigo-700 dark:text-indigo-300
                         px-4 py-1 rounded-full text-sm font-semibold">
                🚀 AI for Developers
            </span>

            <h1 class="text-4xl md:text-5xl font-extrabold leading-tight">
                Generate Professional <br>
                <span class="text-indigo-600">README.md Automatically</span>
            </h1>

            <p class="mt-6 text-lg text-gray-600 dark:text-gray-400 max-w-xl">
                Readmeify adalah tool AI yang menganalisis repository GitHub Anda
                dan menghasilkan dokumentasi README.md yang rapi, informatif,
                dan siap dipublikasikan.
            </p>

            <div class="mt-8 flex flex-col sm:flex-row gap-4">
                <a href="{{ route('auth.github') }}"
                   class="bg-indigo-600 hover:bg-indigo-700 text-white
                          font-semibold px-6 py-3 rounded-xl text-center">
                    🔐 Login with GitHub
                </a>

                <a href="https://github.com/USERNAME/readmeify"
                   target="_blank"
                   class="border border-gray-300 dark:border-gray-700
                          px-6 py-3 rounded-xl font-semibold text-center">
                    ⭐ View on GitHub
                </a>
            </div>

            <p class="mt-4 text-sm text-gray-500">
                Gratis • Open-source friendly • Secure OAuth
            </p>
        </div>

        <!-- MOCKUP -->
        <div class="bg-gray-900 rounded-2xl shadow-2xl text-gray-100
                    text-sm font-mono overflow-hidden">
            <div class="flex gap-2 px-4 py-2 bg-gray-800">
                <span class="w-3 h-3 bg-red-400 rounded-full"></span>
                <span class="w-3 h-3 bg-yellow-400 rounded-full"></span>
                <span class="w-3 h-3 bg-green-400 rounded-full"></span>
            </div>
            <pre class="p-4 leading-relaxed">
# My Awesome Project 🚀

Auto-generated README
by Readmeify AI.

## ✨ Features
- Smart analyzer
- Clean structure
- Ready for GitHub

## ⚙️ Install
```bash
npm install
npm run dev
```</pre>
        </div>

    </div>
</section>

<!-- ================= FEATURES ================= -->
<section class="max-w-7xl mx-auto px-4 sm:px-6 py-20">
    <h2 class="text-3xl font-extrabold text-center mb-14">
        Why Developers Use Readmeify
    </h2>

    <div class="grid md:grid-cols-3 gap-8">
        <div class="feature-card">
            <h4 class="font-bold mb-2">🧠 Smart Analyzer</h4>
            <p>Mendeteksi bahasa, framework, dependency, dan struktur otomatis.</p>
        </div>

        <div class="feature-card">
            <h4 class="font-bold mb-2">📄 Markdown Ready</h4>
            <p>README sesuai standar GitHub, mudah dibaca & dipelihara.</p>
        </div>

        <div class="feature-card">
            <h4 class="font-bold mb-2">🚀 One-Click Commit</h4>
            <p>Preview lalu commit langsung ke repository GitHub.</p>
        </div>
    </div>
</section>

<!-- ================= FAQ ================= -->
<section class="bg-white dark:bg-gray-950 border-t border-gray-200 dark:border-gray-800">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 py-20">
        <h2 class="text-3xl font-extrabold text-center mb-12">
            ❓ Frequently Asked Questions
        </h2>

        <div class="space-y-6">
            <details class="faq">
                <summary>Apakah Readmeify aman?</summary>
                <p>Ya. Readmeify hanya menggunakan OAuth GitHub dan tidak menyimpan password.</p>
            </details>

            <details class="faq">
                <summary>Apakah repository private bisa digunakan?</summary>
                <p>Bisa, selama Anda memberi izin akses repository saat login GitHub.</p>
            </details>

            <details class="faq">
                <summary>Apakah README bisa diedit sebelum commit?</summary>
                <p>Bisa. Anda dapat mengedit markdown di halaman preview sebelum commit.</p>
            </details>

            <details class="faq">
                <summary>Apakah ini open source?</summary>
                <p>Ya. Readmeify dirancang sebagai tool open-source dan personal utility.</p>
            </details>
        </div>
    </div>
</section>

<!-- ================= OPEN SOURCE CTA ================= -->
<section class="max-w-7xl mx-auto px-4 sm:px-6 py-20 text-center">
    <h2 class="text-3xl font-extrabold mb-4">
        Built as an Open-Source Friendly Tool
    </h2>
    <p class="text-gray-600 dark:text-gray-400 max-w-2xl mx-auto mb-8">
        Readmeify dikembangkan sebagai tool personal dan open-source friendly.
        Kontribusi sangat dipersilakan.
    </p>

    <a href="https://github.com/USERNAME/readmeify"
       target="_blank"
       class="inline-flex items-center gap-2 bg-gray-900 dark:bg-white
              dark:text-gray-900 text-white px-6 py-3 rounded-xl font-semibold">
        ⭐ Star on GitHub
    </a>
</section>

<!-- ================= FOOTER ================= -->
<footer class="border-t border-gray-200 dark:border-gray-800">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 py-6
                text-sm text-gray-500 text-center">
        © {{ date('Y') }} Readmeify · Built for Developers
    </div>
</footer>

<!-- ================= SCRIPT ================= -->
<script>
    const toggle = document.getElementById('themeToggle');
    const html = document.documentElement;

    if (localStorage.theme === 'dark' ||
        (!('theme' in localStorage) &&
         window.matchMedia('(prefers-color-scheme: dark)').matches)) {
        html.classList.add('dark');
    }

    toggle.onclick = () => {
        html.classList.toggle('dark');
        localStorage.theme = html.classList.contains('dark') ? 'dark' : 'light';
    };
</script>

<style>
.feature-card {
    background: white;
    border-radius: 1rem;
    padding: 1.5rem;
    box-shadow: 0 10px 25px rgba(0,0,0,.05);
    transition: all .3s;
}
.dark .feature-card { background: #111827; }
.feature-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 20px 40px rgba(0,0,0,.15);
}
.faq {
    background: white;
    padding: 1.25rem;
    border-radius: 1rem;
    cursor: pointer;
}
.dark .faq { background: #111827; }
.faq summary {
    font-weight: 600;
}
.faq p {
    margin-top: .75rem;
    color: #6b7280;
}
.dark .faq p { color: #9ca3af; }
</style>

</body>
</html>
