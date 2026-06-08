<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Kas Kelas</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
        /* Menghilangkan panah default bawaan browser pada summary */
        details > summary {
            list-style: none;
        }
        details > summary::-webkit-details-marker {
            display: none;
        }
    </style>
</head>

<body class="bg-gray-50 flex min-h-screen">

    <aside class="w-72 shrink-0 sticky top-0 h-screen bg-[#0f172a] flex flex-col overflow-y-auto">

        <div class="flex-1 overflow-y-auto flex flex-col">

            <div class="h-20 flex items-center px-8 border-b border-slate-800/60 shrink-0">
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 rounded-lg bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center shadow-lg shadow-indigo-500/30">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3"></path>
                        </svg>
                    </div>
                    <span class="text-xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-white to-slate-400">
                        KasKelasOnline
                    </span>
                </div>
            </div>

            <nav class="p-4 mt-2 space-y-6">

                <div>
                    <p class="px-4 text-xs font-semibold text-slate-500 uppercase tracking-wider mb-2">Menu Utama</p>
                    <a href="{{ route('admin.dashboard') }}"
                        class="flex items-center gap-3 px-4 py-3 rounded-xl group transition-all
                       {{ request()->routeIs('admin.dashboard')
                            ? 'bg-indigo-600 text-white shadow-md shadow-indigo-600/20'
                            : 'text-slate-400 hover:text-white hover:bg-slate-800' }}">
                        <svg class="w-5 h-5 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path>
                        </svg>
                        <span class="font-medium">Dashboard</span>
                    </a>
                </div>

                <div>
                    <p class="px-4 text-xs font-semibold text-slate-500 uppercase tracking-wider mb-2">Administrator</p>
                    
                    <details class="group" {{ request()->routeIs('admin.kelas.*', 'admin.user.*', 'admin.peran.*') ? 'open' : '' }}>
                        <summary class="flex items-center justify-between px-4 py-3 rounded-xl cursor-pointer transition-all
                            {{ request()->routeIs('admin.kelas.*', 'admin.user.*', 'admin.peran.*') ? 'text-white' : 'text-slate-400 hover:text-white hover:bg-slate-800' }}">
                            <div class="flex items-center gap-3">
                                <svg class="w-5 h-5 group-hover:scale-110 transition-transform {{ request()->routeIs('admin.kelas.*', 'admin.user.*', 'admin.peran.*') ? 'text-indigo-400' : '' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 19a2 2 0 01-2-2V7a2 2 0 012-2h4l2 2h4a2 2 0 012 2v1M5 19h14a2 2 0 002-2v-5a2 2 0 00-2-2H9a2 2 0 00-2 2v5a2 2 0 01-2 2z"></path>
                                </svg>
                                <span class="font-medium">Data Master</span>
                            </div>
                            <svg class="w-4 h-4 transition-transform duration-200 group-open:rotate-180 {{ request()->routeIs('admin.kelas.*', 'admin.user.*', 'admin.peran.*') ? 'text-indigo-400' : '' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </summary>
                        
                        <div class="mt-1 pl-12 pr-4 space-y-1">
                            <a href="{{ route('admin.kelas.index') }}" 
                               class="block px-3 py-2 rounded-lg text-sm transition-all
                               {{ request()->routeIs('admin.kelas.*') ? 'bg-indigo-600 text-white shadow-md shadow-indigo-600/20' : 'text-slate-400 hover:text-white hover:bg-slate-800' }}">
                               Data Kelas
                            </a>
                            <a href="{{ route('admin.user.tampiluser') }}" 
                               class="block px-3 py-2 rounded-lg text-sm transition-all
                               {{ request()->routeIs('admin.user.*') ? 'bg-indigo-600 text-white shadow-md shadow-indigo-600/20' : 'text-slate-400 hover:text-white hover:bg-slate-800' }}">
                               Data User
                            </a>
                            <a href="{{ route('admin.peran.index') }}" 
                               class="block px-3 py-2 rounded-lg text-sm transition-all
                               {{ request()->routeIs('admin.peran.index') ? 'bg-indigo-600 text-white shadow-md shadow-indigo-600/20' : 'text-slate-400 hover:text-white hover:bg-slate-800' }}">
                               Pengaturan Peran
                            </a>
                        </div>
                    </details>
                </div>

                <div>
                    <p class="px-4 text-xs font-semibold text-slate-500 uppercase tracking-wider mb-2">Bendahara</p>
                    
                    <details class="group" {{ request()->routeIs('admin.tagihan.*', 'admin.pemasukan.*', 'admin.pengeluaran.*') ? 'open' : '' }}>
                        <summary class="flex items-center justify-between px-4 py-3 rounded-xl cursor-pointer transition-all
                            {{ request()->routeIs('admin.tagihan.*', 'admin.pemasukan.*', 'admin.pengeluaran.*') ? 'text-white' : 'text-slate-400 hover:text-white hover:bg-slate-800' }}">
                            <div class="flex items-center gap-3">
                                <svg class="w-5 h-5 group-hover:scale-110 transition-transform {{ request()->routeIs('admin.tagihan.*', 'admin.pemasukan.*', 'admin.pengeluaran.*') ? 'text-indigo-400' : '' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <span class="font-medium">Manajemen Kas</span>
                            </div>
                            <svg class="w-4 h-4 transition-transform duration-200 group-open:rotate-180 {{ request()->routeIs('admin.tagihan.*', 'admin.pemasukan.*', 'admin.pengeluaran.*') ? 'text-indigo-400' : '' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </summary>
                        
                        <div class="mt-1 pl-12 pr-4 space-y-1">
                            <a href="#" 
                               class="block px-3 py-2 rounded-lg text-sm transition-all
                               {{ request()->routeIs('admin.tagihan.*') ? 'bg-indigo-600 text-white shadow-md shadow-indigo-600/20' : 'text-slate-400 hover:text-white hover:bg-slate-800' }}">
                               Buat Tagihan Kas
                            </a>
                            <a href="#" 
                               class="block px-3 py-2 rounded-lg text-sm transition-all
                               {{ request()->routeIs('admin.pemasukan.*') ? 'bg-indigo-600 text-white shadow-md shadow-indigo-600/20' : 'text-slate-400 hover:text-white hover:bg-slate-800' }}">
                               Kas Masuk (Pemasukan)
                            </a>
                            <a href="#" 
                               class="block px-3 py-2 rounded-lg text-sm transition-all
                               {{ request()->routeIs('admin.pengeluaran.*') ? 'bg-indigo-600 text-white shadow-md shadow-indigo-600/20' : 'text-slate-400 hover:text-white hover:bg-slate-800' }}">
                               Kas Keluar (Pengeluaran)
                            </a>
                        </div>
                    </details>
                </div>

                <div>
                    <p class="px-4 text-xs font-semibold text-slate-500 uppercase tracking-wider mb-2">Umum</p>
                    
                    <details class="group" {{ request()->routeIs('admin.riwayat.*', 'admin.bukukas.*') ? 'open' : '' }}>
                        <summary class="flex items-center justify-between px-4 py-3 rounded-xl cursor-pointer transition-all
                            {{ request()->routeIs('admin.riwayat.*', 'admin.bukukas.*') ? 'text-white' : 'text-slate-400 hover:text-white hover:bg-slate-800' }}">
                            <div class="flex items-center gap-3">
                                <svg class="w-5 h-5 group-hover:scale-110 transition-transform {{ request()->routeIs('admin.riwayat.*', 'admin.bukukas.*') ? 'text-indigo-400' : '' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-6m4 6V7m4 10v-3M5 21h14"></path>
                                </svg>
                                <span class="font-medium">Laporan & Histori</span>
                            </div>
                            <svg class="w-4 h-4 transition-transform duration-200 group-open:rotate-180 {{ request()->routeIs('admin.riwayat.*', 'admin.bukukas.*') ? 'text-indigo-400' : '' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </summary>
                        
                        <div class="mt-1 pl-12 pr-4 space-y-1">
                            <a href="#" 
                               class="block px-3 py-2 rounded-lg text-sm transition-all
                               {{ request()->routeIs('admin.riwayat.*') ? 'bg-indigo-600 text-white shadow-md shadow-indigo-600/20' : 'text-slate-400 hover:text-white hover:bg-slate-800' }}">
                               Riwayat Transaksi
                            </a>
                            <a href="#" 
                               class="block px-3 py-2 rounded-lg text-sm transition-all
                               {{ request()->routeIs('admin.bukukas.*') ? 'bg-indigo-600 text-white shadow-md shadow-indigo-600/20' : 'text-slate-400 hover:text-white hover:bg-slate-800' }}">
                               Buku Kas (Rekapitulasi)
                            </a>
                        </div>
                    </details>

                    <a href="#" 
                       class="flex items-center gap-3 px-4 py-3 mt-1 rounded-xl group transition-all
                       {{ request()->routeIs('admin.pengumuman.*') ? 'bg-indigo-600 text-white shadow-md shadow-indigo-600/20' : 'text-slate-400 hover:text-white hover:bg-slate-800' }}">
                        <svg class="w-5 h-5 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5L6 9H3v6h3l5 4V5z"></path>
                        </svg>
                        <span class="font-medium">Pengumuman</span>
                    </a>
                </div>

            </nav>

            <div class="p-4 border-t border-slate-800/60 mt-auto shrink-0">

                <div class="flex items-center gap-3 p-3 bg-slate-800/50 rounded-2xl mb-3 border border-slate-700/50">
                    <img src="https://ui-avatars.com/api/?name=Admin+Sistem&background=6366f1&color=fff&rounded=true" alt="Admin" class="w-10 h-10 rounded-full shadow-sm">
                    <div class="flex-1 overflow-hidden">
                        <p class="text-sm font-semibold text-white truncate">
                            Admin Sistem
                        </p>
                        <p class="text-xs text-slate-400 truncate">
                            Administrator
                        </p>
                    </div>
                </div>

                <form action="#" method="POST">
                    <button type="submit" class="w-full flex items-center gap-3 px-4 py-3 rounded-xl text-slate-400 hover:text-rose-400 hover:bg-rose-500/10 group transition-all">
                        <svg class="w-5 h-5 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                        </svg>
                        <span class="font-medium">Keluar Akun</span>
                    </button>
                </form>

            </div>
        </div>

    </aside>

</body>

</html>