<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Kas Kelas - Wali Kelas')</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: { sans: ['Inter', 'sans-serif'] },
                    colors: { navy: '#0f172a', emerald: '#10b981' }
                }
            }
        }
    </script>

    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        ::-webkit-scrollbar { width: 6px; height: 6px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 10px; }
        ::-webkit-scrollbar-thumb:hover { background: #94a3b8; }
    </style>
</head>
<body class="bg-slate-50 font-sans text-slate-800 h-screen flex overflow-hidden selection:bg-emerald-200 selection:text-emerald-900">

    <aside class="w-72 bg-navy text-slate-300 hidden lg:flex flex-col h-full transition-all duration-300">
        <div class="p-6 flex items-center gap-3 border-b border-slate-700/50">
            <div class="w-10 h-10 bg-emerald rounded-xl flex items-center justify-center text-white shadow-lg shadow-emerald/20">
                <i class="ph ph-wallet text-2xl"></i>
            </div>
            <div>
                <h1 class="text-white font-bold text-lg tracking-wide">KasKelas.</h1>
                <p class="text-xs text-slate-400">Panel Wali Kelas</p>
            </div>
        </div>
        </aside>

    <main class="flex-1 flex flex-col h-full overflow-hidden relative">
        
        <header class="h-20 bg-white/80 backdrop-blur-md border-b border-slate-200 flex items-center justify-between px-6 lg:px-10 z-10 sticky top-0">
            <div class="flex items-center gap-6">
                <div class="hidden md:block text-sm font-medium text-slate-500 flex items-center gap-2">
                    <i class="ph ph-calendar-blank"></i> {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}
                </div>
                </div>
        </header>

        <div class="flex-1 overflow-y-auto p-6 lg:p-10">
            @yield('content')
        </div>
    </main>

    @stack('scripts')
</body>
</html>