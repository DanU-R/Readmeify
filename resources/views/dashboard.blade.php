<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard – Readmeify</title>

    <!-- Tailwind -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Tailwind Dark Mode Config -->
    <script>
        tailwind.config = {
            darkMode: 'class',
        }
    </script>

    <!-- SweetAlert -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body class="bg-gradient-to-br from-gray-50 via-white to-gray-100
             dark:from-gray-900 dark:via-gray-950 dark:to-gray-900
             text-gray-800 dark:text-gray-200 min-h-screen transition-colors">

<!-- ================= NAVBAR ================= -->
<nav class="bg-white/80 dark:bg-gray-900/80 backdrop-blur border-b
            border-gray-200 dark:border-gray-800 sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-6 h-16 flex justify-between items-center">

        <!-- Logo -->
        <div class="flex items-center gap-3">
            <img src="{{ asset('assets/logo.png') }}"
                 alt="Readmeify Logo"
                 class="w-9 h-9 object-contain">
            <span class="text-xl font-extrabold tracking-tight">
                Readmeify
            </span>
        </div>

        <!-- Right -->
        <div class="flex items-center gap-5">
            <span class="text-sm text-gray-600 dark:text-gray-400">
                Halo, <strong>{{ $user->name }}</strong>
            </span>

            <!-- Dark Mode Toggle -->
            <button id="themeToggle"
                class="w-9 h-9 flex items-center justify-center rounded-lg
                       bg-gray-100 dark:bg-gray-800 hover:scale-105 transition">
                🌙
            </button>

            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button class="text-sm text-red-500 hover:text-red-600 font-semibold">
                    Logout
                </button>
            </form>
        </div>
    </div>
</nav>

<!-- ================= HERO ================= -->
<section class="relative overflow-hidden">
    <div class="absolute inset-0 bg-gradient-to-r
                from-indigo-500/10 to-purple-500/10"></div>

    <div class="relative max-w-7xl mx-auto px-6 py-14">
        <h1 class="text-4xl font-extrabold leading-tight">
            README Profesional <br>
            <span class="text-indigo-600">dalam Sekejap</span>
        </h1>

        <p class="mt-4 text-gray-600 dark:text-gray-400 max-w-2xl text-lg">
            Readmeify menganalisis repository GitHub Anda dan menghasilkan
            README.md yang rapi, modern, dan siap dipublikasikan.
        </p>

        <div class="mt-6 flex flex-wrap gap-3">
            <span class="px-4 py-2 rounded-full text-sm font-semibold
                         bg-indigo-100 text-indigo-700
                         dark:bg-indigo-900/40 dark:text-indigo-300">
                ⚡ AI Analyzer
            </span>
            <span class="px-4 py-2 rounded-full text-sm font-semibold
                         bg-green-100 text-green-700
                         dark:bg-green-900/40 dark:text-green-300">
                📄 Markdown Ready
            </span>
            <span class="px-4 py-2 rounded-full text-sm font-semibold
                         bg-gray-200 text-gray-700
                         dark:bg-gray-800 dark:text-gray-300">
                🚀 GitHub Integrated
            </span>
        </div>
    </div>
</section>

<!-- ================= CONTENT ================= -->
<section class="max-w-7xl mx-auto px-6 py-12">

    <!-- Header -->
    <div class="flex flex-col md:flex-row md:items-center
                md:justify-between gap-4 mb-8">
        <h2 class="text-2xl font-bold">
            📦 Repository Anda
        </h2>

        <input id="repoSearch"
            type="text"
            placeholder="🔍 Cari repository..."
            class="w-full md:w-80 px-4 py-2 rounded-xl border
                   border-gray-300 dark:border-gray-700
                   bg-white dark:bg-gray-900
                   focus:ring-2 focus:ring-indigo-500 outline-none transition">
    </div>

    <!-- Skeleton Loader -->
    <div id="repo-skeleton" class="grid sm:grid-cols-2 lg:grid-cols-3 gap-8">
        @for ($i = 0; $i < 6; $i++)
            <div class="animate-pulse bg-white dark:bg-gray-900
                        border border-gray-200 dark:border-gray-800
                        rounded-2xl p-6 h-[220px]">
                <div class="h-4 bg-gray-200 dark:bg-gray-700 rounded w-1/3 mb-4"></div>
                <div class="h-5 bg-gray-200 dark:bg-gray-700 rounded w-2/3 mb-3"></div>
                <div class="h-3 bg-gray-200 dark:bg-gray-700 rounded w-full mb-2"></div>
                <div class="h-3 bg-gray-200 dark:bg-gray-700 rounded w-5/6"></div>
            </div>
        @endfor
    </div>

    <!-- Repo Grid -->
    <div id="repo-grid"
         class="hidden grid sm:grid-cols-2 lg:grid-cols-3 gap-8">

        @forelse($repos as $repo)
            <div class="repo-card bg-white dark:bg-gray-900
                        border border-gray-200 dark:border-gray-800
                        rounded-2xl p-6 shadow-sm
                        hover:shadow-xl hover:-translate-y-1
                        transition-all duration-300 flex flex-col justify-between"
                 data-name="{{ strtolower($repo['name']) }}">

                <div>
                    <div class="flex justify-between items-center mb-3">
                        <span class="text-xs font-bold uppercase px-3 py-1 rounded-full
                            {{ ($repo['visibility'] ?? 'public') === 'private'
                                ? 'bg-red-100 text-red-700 dark:bg-red-900/40 dark:text-red-300'
                                : 'bg-blue-100 text-blue-700 dark:bg-blue-900/40 dark:text-blue-300' }}">
                            {{ $repo['visibility'] ?? 'Public' }}
                        </span>

                        <div class="text-xs text-gray-400 flex gap-2">
                            ⭐ {{ $repo['stargazers_count'] }}
                            🍴 {{ $repo['forks_count'] }}
                        </div>
                    </div>

                    <h3 class="text-lg font-bold mb-2 truncate">
                        {{ $repo['name'] }}
                    </h3>

                    <p class="text-sm text-gray-600 dark:text-gray-400 min-h-[48px]">
                        {{ $repo['description'] ?? 'Tidak ada deskripsi repository.' }}
                    </p>

                    @if(!empty($repo['language']))
                        <span class="inline-block mt-3 px-3 py-1 text-xs font-semibold
                                     bg-gray-100 text-gray-700
                                     dark:bg-gray-800 dark:text-gray-300
                                     rounded-full">
                            💻 {{ $repo['language'] }}
                        </span>
                    @endif
                </div>

                <a href="{{ route('generate.readme', ['owner' => $repo['owner']['login'], 'repo' => $repo['name']]) }}"
                   class="mt-6 block text-center bg-indigo-600 hover:bg-indigo-700
                          text-white font-semibold py-2.5 rounded-xl
                          shadow-md transition active:scale-95">
                    ✨ Generate README
                </a>
            </div>
        @empty
            <div class="col-span-full text-center py-20">
                <div class="text-6xl mb-4">📭</div>
                <h3 class="text-xl font-bold">Tidak ada repository</h3>
                <p class="text-gray-500 mt-2">
                    Pastikan GitHub Anda memiliki repository.
                </p>
            </div>
        @endforelse
    </div>
</section>

<!-- ================= SCRIPT ================= -->
<script>
    /* Skeleton */
    window.addEventListener('load', () => {
        document.getElementById('repo-skeleton').classList.add('hidden');
        document.getElementById('repo-grid').classList.remove('hidden');
    });

    /* Search */
    document.getElementById('repoSearch').addEventListener('input', e => {
        const q = e.target.value.toLowerCase();
        document.querySelectorAll('.repo-card').forEach(card => {
            card.style.display = card.dataset.name.includes(q) ? '' : 'none';
        });
    });

    /* Dark Mode */
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

    /* Alerts */
    @if(session('success'))
        Swal.fire({ icon:'success', title:'Berhasil 🎉', text:"{!! session('success') !!}", timer:4000, showConfirmButton:false });
    @endif
    @if(session('error'))
        Swal.fire({ icon:'error', title:'Gagal 😔', text:"{!! session('error') !!}" });
    @endif
</script>

</body>
</html>
