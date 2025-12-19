<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Preview README - {{ $repo }}</title>

    <!-- Tailwind -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class'
        }
    </script>

    <!-- Markdown & Highlight -->
    <script src="https://cdn.jsdelivr.net/npm/marked/marked.min.js"></script>

    <!-- Highlight.js (Dark friendly) -->
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/styles/github-dark.min.css">

    <!-- GitHub Markdown -->
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/github-markdown-css/5.2.0/github-markdown.min.css">

    <!-- SweetAlert -->
    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

    <!-- ================= FIX CODE BLOCK ================= -->
    <style>
        /* Markdown container */
        .markdown-body {
            font-size: 16px;
        }

        /* LIGHT MODE */
        .markdown-body pre {
            background-color: #f6f8fa !important;
            color: #24292f !important;
            border-radius: 12px;
            padding: 1rem;
            overflow-x: auto;
        }

        .markdown-body pre code {
            background: transparent !important;
            color: inherit !important;
            font-size: 0.9rem;
        }

        /* DARK MODE */
        .dark .markdown-body {
            color: #e6edf3;
        }

        .dark .markdown-body pre {
            background-color: #0d1117 !important;
            color: #e6edf3 !important;
            border: 1px solid #30363d;
        }

        .dark .markdown-body pre code {
            color: #e6edf3 !important;
        }

        /* Inline code */
        .markdown-body :not(pre) > code {
            background-color: rgba(175,184,193,0.2);
            padding: 0.2em 0.4em;
            border-radius: 6px;
            font-size: 0.85em;
        }

        .dark .markdown-body :not(pre) > code {
            background-color: rgba(110,118,129,0.4);
        }
    </style>
</head>

<body class="bg-gray-100 dark:bg-gray-900 text-gray-800 dark:text-gray-200 min-h-screen pb-28 transition-colors">

<!-- ================= HEADER ================= -->
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="flex flex-col md:flex-row justify-between items-center gap-4 mb-6">

        <div>
            <h1 class="text-3xl font-bold">Preview README 📝</h1>
            <p class="text-sm text-gray-500 dark:text-gray-400">
                Repository:
                <span class="font-mono text-indigo-600 dark:text-indigo-400">
                    {{ $owner }}/{{ $repo }}
                </span>
            </p>
        </div>

        <div class="flex items-center gap-4">
            <!-- Language Switch -->
            <div class="flex gap-2">
                <a href="{{ route('generate.readme', ['owner'=>$owner,'repo'=>$repo,'lang'=>'en']) }}"
                   class="px-3 py-1 rounded-lg text-sm font-semibold
                   {{ request('lang','en')==='en'
                        ? 'bg-indigo-600 text-white'
                        : 'bg-gray-200 dark:bg-gray-700' }}">
                    EN
                </a>
                <a href="{{ route('generate.readme', ['owner'=>$owner,'repo'=>$repo,'lang'=>'id']) }}"
                   class="px-3 py-1 rounded-lg text-sm font-semibold
                   {{ request('lang')==='id'
                        ? 'bg-indigo-600 text-white'
                        : 'bg-gray-200 dark:bg-gray-700' }}">
                    ID
                </a>
            </div>

            <!-- Dark Mode Toggle -->
            <button id="darkToggle"
                class="px-3 py-1 rounded-lg bg-gray-200 dark:bg-gray-700 text-sm font-bold">
                🌙
            </button>

            <a href="{{ route('dashboard') }}"
               class="text-sm text-gray-500 hover:text-gray-700 dark:hover:text-gray-300">
                ← Dashboard
            </a>
        </div>
    </div>

    <!-- ================= MAIN ================= -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 h-[calc(100vh-240px)]">

        <!-- Editor -->
        <div class="flex flex-col h-full">
            <label class="text-sm font-bold mb-2">Markdown Source</label>
            <textarea id="source"
                class="flex-1 w-full p-4 rounded-xl font-mono text-sm
                       bg-gray-900 text-green-400 resize-none
                       focus:outline-none focus:ring-2 focus:ring-indigo-500">
{{ $readme }}
            </textarea>
        </div>

        <!-- Preview -->
        <div class="flex flex-col h-full">
            <label class="text-sm font-bold mb-2">Live Preview</label>
            <div id="preview"
                 class="flex-1 p-8 rounded-xl bg-white dark:bg-gray-800
                        overflow-y-auto markdown-body shadow">
            </div>
        </div>
    </div>
</div>

<!-- ================= FOOTER ================= -->
<div class="fixed bottom-0 left-0 w-full bg-white dark:bg-gray-800 border-t p-4 shadow z-50">
    <div class="max-w-7xl mx-auto flex justify-end gap-4">

        <button onclick="copyText()"
            class="px-6 py-2 rounded-lg bg-gray-200 dark:bg-gray-700 font-semibold">
            📋 Copy
        </button>

        <form action="{{ route('commit.readme') }}" method="POST" id="commitForm">
            @csrf
            <input type="hidden" name="owner" value="{{ $owner }}">
            <input type="hidden" name="repo" value="{{ $repo }}">
            <input type="hidden" name="readme_content" id="hiddenContent">

            <button onclick="commitReadme(event)"
                class="px-6 py-2 rounded-lg bg-indigo-600 text-white font-bold">
                🚀 Commit
            </button>
        </form>
    </div>
</div>

<!-- ================= SCRIPTS ================= -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/highlight.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    // Markdown render
    marked.setOptions({
        highlight: function(code, lang) {
            if (lang && hljs.getLanguage(lang)) {
                return hljs.highlight(code, { language: lang }).value;
            }
            return hljs.highlightAuto(code).value;
        }
    });

    const source = document.getElementById('source');
    const preview = document.getElementById('preview');

    function render() {
        preview.innerHTML = marked.parse(source.value);
        preview.querySelectorAll('pre code').forEach(block => {
            hljs.highlightElement(block);
        });
    }

    source.addEventListener('input', render);
    render();

    // Copy
    function copyText() {
        navigator.clipboard.writeText(source.value);
        Swal.fire({ icon:'success', title:'Copied', timer:1000, showConfirmButton:false });
    }

    // Commit
    function commitReadme(e) {
        e.preventDefault();
        document.getElementById('hiddenContent').value = source.value;
        Swal.fire({ title:'Committing...', allowOutsideClick:false, didOpen:()=>Swal.showLoading() });
        document.getElementById('commitForm').submit();
    }

    // Dark mode
    const toggle = document.getElementById('darkToggle');
    toggle.onclick = () => {
        document.documentElement.classList.toggle('dark');
        localStorage.theme = document.documentElement.classList.contains('dark') ? 'dark' : 'light';
    };

    if (localStorage.theme === 'dark') {
        document.documentElement.classList.add('dark');
    }
</script>

</body>
</html>
