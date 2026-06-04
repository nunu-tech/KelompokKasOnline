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
    </style>
</head>

<body class="bg-gray-50 flex h-screen overflow-hidden">

    <!-- SIDEBAR -->
    <aside class="w-72 shrink-0 min-h-screen bg-[#0f172a] flex flex-col justify-between">

        <div>

            <!-- LOGO -->
            <div class="h-20 flex items-center px-8 border-b border-slate-800/60">
                <div class="flex items-center gap-3">

                    <div class="w-8 h-8 rounded-lg bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center shadow-lg shadow-indigo-500/30">

                        <svg class="w-5 h-5 text-white"
                             fill="none"
                             stroke="currentColor"
                             viewBox="0 0 24 24">

                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  stroke-width="2"
                                  d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3">
                            </path>
                        </svg>

                    </div>

                    <span class="text-xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-white to-slate-400">
                        KasKelasOnline
                    </span>

                </div>
            </div>

            <!-- MENU -->
            <nav class="p-4 mt-2 space-y-2">

                <!-- DASHBOARD -->
                <a href="{{ route('admin.dashboard') }}"
                   class="flex items-center gap-3 px-4 py-3 rounded-xl group transition-all
                   {{ request()->routeIs('admin.dashboard')
                        ? 'bg-indigo-600 text-white shadow-md shadow-indigo-600/20'
                        : 'text-slate-400 hover:text-white hover:bg-slate-800' }}">

                    <svg class="w-5 h-5 group-hover:scale-110 transition-transform"
                         fill="none"
                         stroke="currentColor"
                         viewBox="0 0 24 24">

                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z">
                        </path>

                    </svg>

                    <span class="font-medium">Dashboard</span>
                </a>

                <!-- DATA SISWA -->
                <a href="{{ route('admin.user.tampiluser') }}"
                   class="flex items-center gap-3 px-4 py-3 rounded-xl group transition-all
                   {{ request()->routeIs('admin.user.tampiluser')
                        ? 'bg-indigo-600 text-white shadow-md shadow-indigo-600/20'
                        : 'text-slate-400 hover:text-white hover:bg-slate-800' }}">

                    <svg class="w-5 h-5 group-hover:scale-110 transition-transform"
                         fill="none"
                         stroke="currentColor"
                         viewBox="0 0 24 24">

                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z">
                        </path>

                    </svg>

                    <span class="font-medium">Data User</span>
                </a>

                <!-- PEMASUKAN -->
                <a href="#"
                   class="flex items-center gap-3 px-4 py-3 rounded-xl group transition-all
                   {{ request()->routeIs('pemasukan.*')
                        ? 'bg-indigo-600 text-white shadow-md shadow-indigo-600/20'
                        : 'text-slate-400 hover:text-white hover:bg-slate-800' }}">

                    <svg class="w-5 h-5 group-hover:scale-110 transition-transform"
                         fill="none"
                         stroke="currentColor"
                         viewBox="0 0 24 24">

                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z">
                        </path>

                    </svg>

                    <span class="font-medium">Pemasukan</span>
                </a>

                <!-- PENGELUARAN -->
                <a href="#"
                   class="flex items-center gap-3 px-4 py-3 rounded-xl group transition-all
                   {{ request()->routeIs('pengeluaran.*')
                        ? 'bg-indigo-600 text-white shadow-md shadow-indigo-600/20'
                        : 'text-slate-400 hover:text-white hover:bg-slate-800' }}">

                    <svg class="w-5 h-5 group-hover:scale-110 transition-transform"
                         fill="none"
                         stroke="currentColor"
                         viewBox="0 0 24 24">

                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                        </path>

                    </svg>

                    <span class="font-medium">Pengeluaran</span>
                </a>

            </nav>
        </div>

        <!-- BAWAH -->
        <div class="p-4 border-t border-slate-800/60">

            <!-- PROFILE -->
            <div class="flex items-center gap-3 p-3 bg-slate-800/50 rounded-2xl mb-3 border border-slate-700/50">

                <img src="https://ui-avatars.com/api/?name=Admin+Kelas&background=6366f1&color=fff&rounded=true"
                     alt="Admin"
                     class="w-10 h-10 rounded-full shadow-sm">

                <div class="flex-1 overflow-hidden">
                    <p class="text-sm font-semibold text-white truncate">
                        Admin Kelas
                    </p>

                    <p class="text-xs text-slate-400 truncate">
                        Bendahara
                    </p>
                </div>

            </div>

            <!-- LOGOUT -->
            <a href="#"
               class="flex items-center gap-3 px-4 py-3 rounded-xl text-slate-400 hover:text-rose-400 hover:bg-rose-500/10 group transition-all">

                <svg class="w-5 h-5 group-hover:-translate-x-1 transition-transform"
                     fill="none"
                     stroke="currentColor"
                     viewBox="0 0 24 24">

                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          stroke-width="2"
                          d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                    </path>

                </svg>

                <span class="font-medium">Keluar Akun</span>
            </a>

        </div>

    </aside>

</body>
</html>