<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <title>Readmeify – Generator README AI</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <link rel="icon" href="{{ asset('assets/logo.png') }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['"Plus Jakarta Sans"', 'sans-serif'],
                    },
                    colors: {
                        brand: {
                            50: '#eef2ff',
                            100: '#e0e7ff',
                            500: '#6366f1', // Indigo utama
                            600: '#4f46e5',
                            700: '#4338ca',
                            900: '#312e81',
                        }
                    }
                }
            }
        }
    </script>

    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    
    <style>
        .bg-grid {
            background-size: 40px 40px;
            background-image: linear-gradient(to right, rgba(99, 102, 241, 0.05) 1px, transparent 1px),
                              linear-gradient(to bottom, rgba(99, 102, 241, 0.05) 1px, transparent 1px);
        }
        .dark .bg-grid {
            background-image: linear-gradient(to right, rgba(255, 255, 255, 0.05) 1px, transparent 1px),
                              linear-gradient(to bottom, rgba(255, 255, 255, 0.05) 1px, transparent 1px);
        }
        .glass-nav {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
        }
        .dark .glass-nav {
            background: rgba(17, 24, 39, 0.8);
        }
    </style>
</head>

<body class="bg-gray-50 dark:bg-gray-950 text-gray-800 dark:text-gray-200 min-h-screen transition-colors font-sans overflow-x-hidden">

<nav class="glass-nav border-b border-gray-200 dark:border-gray-800 sticky top-0 z-50 transition-all duration-300">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 h-20 flex justify-between items-center">
        <a href="/" class="flex items-center gap-3 group">
            
            <img src="{{ asset('assets/logo.png') }}" 
                 alt="Logo Readmeify" 
                 class="w-10 h-10 object-contain group-hover:scale-110 transition-transform">

            <span class="font-bold text-xl tracking-tight text-gray-900 dark:text-white">
                Readmeify
            </span>
        </a>

        <div class="hidden md:flex gap-8 text-sm font-medium text-gray-600 dark:text-gray-400">
            <a href="#fitur" class="hover:text-brand-600 dark:hover:text-brand-400 transition">Fitur</a>
            <a href="#cara-kerja" class="hover:text-brand-600 dark:hover:text-brand-400 transition">Cara Kerja</a>
            <a href="#faq" class="hover:text-brand-600 dark:hover:text-brand-400 transition">FAQ</a>
        </div>

        <div class="flex items-center gap-4">
            <button id="themeToggle"
                class="w-10 h-10 rounded-full flex items-center justify-center
                       bg-gray-100 dark:bg-gray-800 hover:bg-gray-200 dark:hover:bg-gray-700 transition text-lg">
                <span id="themeIcon">🌙</span>
            </button>

            <a href="{{ route('auth.github') }}"
               class="hidden sm:flex items-center gap-2 bg-gray-900 dark:bg-white dark:text-gray-900
                      text-white px-6 py-2.5 rounded-full font-bold hover:shadow-lg
                      hover:-translate-y-0.5 transition-all duration-300">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z"/></svg>
                Masuk
            </a>
        </div>
    </div>
</nav>

<section class="relative pt-20 pb-32 overflow-hidden bg-grid">
    <div class="absolute top-0 left-1/2 -translate-x-1/2 w-[800px] h-[500px] bg-brand-500/20 rounded-full blur-[100px] -z-10"></div>
    
    <div class="max-w-7xl mx-auto px-4 sm:px-6 relative z-10 text-center">
        
        <div data-aos="fade-up" class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-white dark:bg-gray-800 border border-brand-100 dark:border-gray-700 shadow-sm mb-8">
            <span class="relative flex h-3 w-3">
              <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-brand-400 opacity-75"></span>
              <span class="relative inline-flex rounded-full h-3 w-3 bg-brand-500"></span>
            </span>
            <span class="text-sm font-medium text-gray-600 dark:text-gray-300">v1.0 Kini Tersedia untuk Publik</span>
        </div>

        <h1 data-aos="fade-up" data-aos-delay="100" class="text-5xl md:text-7xl font-extrabold tracking-tight leading-tight mb-6">
            Buat README.md <br class="hidden md:block" />
            <span class="text-transparent bg-clip-text bg-gradient-to-r from-brand-600 to-purple-600">Profesional dalam Detik</span>
        </h1>

        <p data-aos="fade-up" data-aos-delay="200" class="mt-6 text-xl text-gray-600 dark:text-gray-400 max-w-2xl mx-auto leading-relaxed">
            Berhenti membuang waktu menulis dokumentasi manual. Biarkan AI kami menganalisis kode Anda dan membuat README yang sempurna untuk repository GitHub Anda.
        </p>

        <div data-aos="fade-up" data-aos-delay="300" class="mt-10 flex flex-col sm:flex-row justify-center gap-4">
            <a href="{{ route('auth.github') }}"
               class="bg-brand-600 hover:bg-brand-700 text-white text-lg font-bold px-8 py-4 rounded-xl shadow-xl shadow-brand-500/30 hover:-translate-y-1 transition-all duration-300 flex items-center justify-center gap-3">
                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z"/></svg>
                Mulai Gratis Sekarang
            </a>
            <a href="https://github.com/DanU-R?tab=repositories" target="_blank"
               class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 text-gray-700 dark:text-gray-200 text-lg font-bold px-8 py-4 rounded-xl hover:bg-gray-50 dark:hover:bg-gray-700 transition-all flex items-center justify-center gap-2">
                ⭐ Beri Bintang di GitHub
            </a>
        </div>

        <div data-aos="fade-up" data-aos-delay="500" class="mt-20 relative mx-auto max-w-4xl">
            <div class="absolute -inset-1 bg-gradient-to-r from-brand-600 to-purple-600 rounded-2xl blur opacity-30"></div>
            <div class="relative bg-gray-900 rounded-2xl shadow-2xl border border-gray-800 overflow-hidden text-left">
                <div class="bg-gray-800 px-4 py-3 flex items-center gap-2 border-b border-gray-700">
                    <div class="flex gap-2">
                        <div class="w-3 h-3 rounded-full bg-red-500"></div>
                        <div class="w-3 h-3 rounded-full bg-yellow-500"></div>
                        <div class="w-3 h-3 rounded-full bg-green-500"></div>
                    </div>
                    <div class="mx-auto text-xs text-gray-400 font-mono">README.md — Preview</div>
                </div>
                <div class="p-6 font-mono text-sm md:text-base text-gray-300 overflow-x-auto">
                    <div class="text-brand-400 font-bold text-xl mb-4"># My Awesome Project 🚀</div>
                    <p class="mb-4">Dokumentasi otomatis oleh <span class="text-white bg-brand-600/50 px-1 rounded">Readmeify AI</span>.</p>
                    
                    <div class="text-lg font-bold text-white mt-6 mb-2">## ✨ Fitur Utama</div>
                    <ul class="list-disc list-inside space-y-1 text-gray-400">
                        <li><span class="text-green-400">Analisis Pintar</span>: Mendeteksi Laravel, Node.js, Python otomatis.</li>
                        <li><span class="text-green-400">Desain Bersih</span>: Menggunakan badges Shields.io dan tata letak rapi.</li>
                    </ul>

                    <div class="text-lg font-bold text-white mt-6 mb-2">## ⚙️ Instalasi</div>
                    <div class="bg-black/50 p-4 rounded-lg border border-gray-700">
                        <span class="text-gray-500"># Install dependencies</span><br>
                        <span class="text-purple-400">npm</span> install<br>
                        <span class="text-purple-400">npm</span> run dev
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="py-10 border-y border-gray-200 dark:border-gray-800 bg-white dark:bg-gray-900">
    <div class="max-w-7xl mx-auto px-6 grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
        <div data-aos="fade-up">
            <div class="text-4xl font-extrabold text-gray-900 dark:text-white">100+</div>
            <div class="text-sm text-gray-500 mt-1">Repo Dianalisis</div>
        </div>
        <div data-aos="fade-up" data-aos-delay="100">
            <div class="text-4xl font-extrabold text-brand-600">3dtk</div>
            <div class="text-sm text-gray-500 mt-1">Rata-rata Waktu Generate</div>
        </div>
        <div data-aos="fade-up" data-aos-delay="200">
            <div class="text-4xl font-extrabold text-gray-900 dark:text-white">Gratis</div>
            <div class="text-sm text-gray-500 mt-1">Selamanya untuk Devs</div>
        </div>
        <div data-aos="fade-up" data-aos-delay="300">
            <div class="text-4xl font-extrabold text-green-500">100%</div>
            <div class="text-sm text-gray-500 mt-1">Open Source</div>
        </div>
    </div>
</section>

<section id="cara-kerja" class="py-24 relative scroll-mt-20">
    <div class="max-w-7xl mx-auto px-6">
        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-4xl font-extrabold mb-4">Cara Kerja</h2>
            <p class="text-gray-600 dark:text-gray-400 max-w-2xl mx-auto">Buat dokumentasi cantik dalam tiga langkah mudah.</p>
        </div>

        <div class="grid md:grid-cols-3 gap-10">
            <div data-aos="fade-up" class="relative group">
                <div class="absolute inset-0 bg-brand-100 dark:bg-brand-900/20 rounded-3xl transform rotate-3 transition-transform group-hover:rotate-0"></div>
                <div class="relative bg-white dark:bg-gray-800 p-8 rounded-3xl border border-gray-100 dark:border-gray-700 shadow-xl h-full">
                    <div class="w-12 h-12 bg-brand-100 dark:bg-brand-900/50 rounded-xl flex items-center justify-center text-2xl mb-6">🔐</div>
                    <h3 class="text-xl font-bold mb-3">1. Login dengan GitHub</h3>
                    <p class="text-gray-500 dark:text-gray-400">Masuk dengan aman. Kami hanya meminta akses baca (read-access) untuk menganalisis kode Anda.</p>
                </div>
            </div>

            <div data-aos="fade-up" data-aos-delay="100" class="relative group">
                <div class="absolute inset-0 bg-purple-100 dark:bg-purple-900/20 rounded-3xl transform -rotate-3 transition-transform group-hover:rotate-0"></div>
                <div class="relative bg-white dark:bg-gray-800 p-8 rounded-3xl border border-gray-100 dark:border-gray-700 shadow-xl h-full">
                    <div class="w-12 h-12 bg-purple-100 dark:bg-purple-900/50 rounded-xl flex items-center justify-center text-2xl mb-6">🧠</div>
                    <h3 class="text-xl font-bold mb-3">2. Analisis AI</h3>
                    <p class="text-gray-500 dark:text-gray-400">AI kami memindai `package.json`, `composer.json`, atau `requirements.txt` untuk memahami teknologi Anda.</p>
                </div>
            </div>

            <div data-aos="fade-up" data-aos-delay="200" class="relative group">
                <div class="absolute inset-0 bg-green-100 dark:bg-green-900/20 rounded-3xl transform rotate-3 transition-transform group-hover:rotate-0"></div>
                <div class="relative bg-white dark:bg-gray-800 p-8 rounded-3xl border border-gray-100 dark:border-gray-700 shadow-xl h-full">
                    <div class="w-12 h-12 bg-green-100 dark:bg-green-900/50 rounded-xl flex items-center justify-center text-2xl mb-6">🚀</div>
                    <h3 class="text-xl font-bold mb-3">3. Generate & Commit</h3>
                    <p class="text-gray-500 dark:text-gray-400">Lihat preview markdown, edit jika perlu, dan push langsung ke repository Anda.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="fitur" class="py-24 bg-gray-50 dark:bg-gray-900/50 border-t border-gray-200 dark:border-gray-800 scroll-mt-20">
    <div class="max-w-7xl mx-auto px-6">
        <h2 class="text-3xl font-extrabold text-center mb-14">Fitur Unggulan</h2>

        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
            <div data-aos="zoom-in" class="feature-card group">
                <div class="icon-box bg-blue-100 text-blue-600">⚡</div>
                <h4 class="font-bold text-lg mb-2">Generasi Instan</h4>
                <p class="text-sm text-gray-500">Tidak perlu menulis dari nol. Dapatkan README lengkap dalam hitungan detik.</p>
            </div>
            
            <div data-aos="zoom-in" data-aos-delay="100" class="feature-card group">
                <div class="icon-box bg-green-100 text-green-600">🛡️</div>
                <h4 class="font-bold text-lg mb-2">Badges Shields.io</h4>
                <p class="text-sm text-gray-500">Menambahkan lencana profesional untuk status build, lisensi, dan versi secara otomatis.</p>
            </div>

            <div data-aos="zoom-in" data-aos-delay="200" class="feature-card group">
                <div class="icon-box bg-purple-100 text-purple-600">📝</div>
                <h4 class="font-bold text-lg mb-2">Deteksi Bahasa</h4>
                <p class="text-sm text-gray-500">Mendeteksi Laravel, React, Python, Go, dan menyesuaikan langkah instalasi yang relevan.</p>
            </div>

            <div data-aos="zoom-in" class="feature-card group">
                <div class="icon-box bg-orange-100 text-orange-600">🌐</div>
                <h4 class="font-bold text-lg mb-2">Multi-Bahasa</h4>
                <p class="text-sm text-gray-500">Generate dokumentasi dalam Bahasa Inggris atau Indonesia dengan satu tombol switch.</p>
            </div>

            <div data-aos="zoom-in" data-aos-delay="100" class="feature-card group">
                <div class="icon-box bg-pink-100 text-pink-600">🎨</div>
                <h4 class="font-bold text-lg mb-2">Live Preview</h4>
                <p class="text-sm text-gray-500">Lihat perubahan secara real-time sebelum Anda melakukan commit ke repository.</p>
            </div>

            <div data-aos="zoom-in" data-aos-delay="200" class="feature-card group">
                <div class="icon-box bg-teal-100 text-teal-600">🔒</div>
                <h4 class="font-bold text-lg mb-2">Privasi Utama</h4>
                <p class="text-sm text-gray-500">Kami tidak menyimpan kode Anda. Kami hanya menganalisis struktur untuk membuat teks.</p>
            </div>
        </div>
    </div>
</section>

<section id="faq" class="py-24 bg-white dark:bg-gray-950 scroll-mt-20">
    <div class="max-w-3xl mx-auto px-6">
        <h2 class="text-3xl font-extrabold text-center mb-12">Pertanyaan Umum</h2>

        <div class="space-y-4">
            <details class="group bg-gray-50 dark:bg-gray-900 p-6 rounded-2xl cursor-pointer transition-all duration-300 open:bg-white open:shadow-lg dark:open:bg-gray-800">
                <summary class="flex justify-between items-center font-bold list-none">
                    <span>Apakah Readmeify aman digunakan?</span>
                    <span class="transition group-open:rotate-180">
                        <svg fill="none" height="24" shape-rendering="geometricPrecision" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" viewBox="0 0 24 24" width="24"><path d="M6 9l6 6 6-6"></path></svg>
                    </span>
                </summary>
                <p class="text-gray-600 dark:text-gray-400 mt-4 leading-relaxed group-open:animate-fadeIn">
                    Ya, sangat aman. Kami menggunakan OAuth resmi GitHub untuk autentikasi. Kami tidak menyimpan password atau kode repository Anda. Kami hanya menganalisis struktur file.
                </p>
            </details>

            <details class="group bg-gray-50 dark:bg-gray-900 p-6 rounded-2xl cursor-pointer transition-all duration-300 open:bg-white open:shadow-lg dark:open:bg-gray-800">
                <summary class="flex justify-between items-center font-bold list-none">
                    <span>Apakah bisa untuk Repository Private?</span>
                    <span class="transition group-open:rotate-180">
                        <svg fill="none" height="24" shape-rendering="geometricPrecision" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" viewBox="0 0 24 24" width="24"><path d="M6 9l6 6 6-6"></path></svg>
                    </span>
                </summary>
                <p class="text-gray-600 dark:text-gray-400 mt-4 leading-relaxed group-open:animate-fadeIn">
                    Bisa! Selama Anda memberikan izin akses repository saat login GitHub, aplikasi dapat menganalisis dan membuat README untuk repo private sekalipun.
                </p>
            </details>

            <details class="group bg-gray-50 dark:bg-gray-900 p-6 rounded-2xl cursor-pointer transition-all duration-300 open:bg-white open:shadow-lg dark:open:bg-gray-800">
                <summary class="flex justify-between items-center font-bold list-none">
                    <span>Apakah ini berbayar?</span>
                    <span class="transition group-open:rotate-180">
                        <svg fill="none" height="24" shape-rendering="geometricPrecision" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" viewBox="0 0 24 24" width="24"><path d="M6 9l6 6 6-6"></path></svg>
                    </span>
                </summary>
                <p class="text-gray-600 dark:text-gray-400 mt-4 leading-relaxed group-open:animate-fadeIn">
                    Tidak. Ini adalah proyek portofolio pribadi dan alat bantu yang gratis untuk digunakan oleh siapa saja.
                </p>
            </details>
        </div>
    </div>
</section>

<footer class="bg-gray-50 dark:bg-gray-900 border-t border-gray-200 dark:border-gray-800 pt-16 pb-8">
    <div class="max-w-7xl mx-auto px-6">
        <div class="grid md:grid-cols-4 gap-8 mb-12">
            <div class="col-span-1 md:col-span-2">
                <div class="flex items-center gap-2 mb-4">
                    <img src="{{ asset('assets/logo.png') }}" alt="Logo Readmeify" class="w-8 h-8 object-contain">
                    <span class="font-bold text-xl">Readmeify</span>
                </div>
                <p class="text-gray-500 max-w-sm">
                    Otomatisasi dokumentasi untuk developer. Hemat waktu, tulis lebih sedikit, koding lebih banyak.
                </p>
            </div>
            <div>
                <h4 class="font-bold mb-4">Produk</h4>
                <ul class="space-y-2 text-gray-500 text-sm">
                    <li><a href="#fitur" class="hover:text-brand-600 transition">Fitur Utama</a></li>
                    <li><a href="#cara-kerja" class="hover:text-brand-600 transition">Cara Kerja</a></li>
                    <li><a href="#faq" class="hover:text-brand-600 transition">FAQ</a></li>
                </ul>
            </div>
            <div>
                <h4 class="font-bold mb-4">Kontak</h4>
                <ul class="space-y-2 text-gray-500 text-sm">
                    <li><a href="https://github.com/DanU-R" target="_blank" class="hover:text-brand-600 transition">GitHub</a></li>
                    <li><a href="www.linkedin.com/in/danuranggana" class="hover:text-brand-600 transition">LinkedIn</a></li>
                </ul>
            </div>
        </div>
        <div class="border-t border-gray-200 dark:border-gray-800 pt-8 flex flex-col md:flex-row justify-between items-center text-sm text-gray-500">
            <p>&copy; {{ date('Y') }} Readmeify.</p>
            <p>Dibuat dengan ❤️ dan Mecut Ai</p>
        </div>
    </div>
</footer>

<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    // Inisialisasi Animate On Scroll
    AOS.init({
        duration: 800,
        once: true,
        offset: 50
    });

    // Logika Dark Mode
    const toggle = document.getElementById('themeToggle');
    const html = document.documentElement;
    const themeIcon = document.getElementById('themeIcon');

    function updateIcon() {
        themeIcon.innerText = html.classList.contains('dark') ? '☀️' : '🌙';
    }

    if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
        html.classList.add('dark');
    }
    updateIcon();

    toggle.onclick = () => {
        html.classList.toggle('dark');
        localStorage.theme = html.classList.contains('dark') ? 'dark' : 'light';
        updateIcon();
    };
</script>

<style>
    .feature-card {
        background: white;
        padding: 2rem;
        border-radius: 1.5rem;
        border: 1px solid #e5e7eb;
        transition: all 0.3s ease;
    }
    .dark .feature-card {
        background: #111827;
        border-color: #374151;
    }
    .feature-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        border-color: #6366f1;
    }
    .icon-box {
        width: 3rem;
        height: 3rem;
        border-radius: 0.75rem;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        margin-bottom: 1rem;
    }
</style>

</body>
</html>