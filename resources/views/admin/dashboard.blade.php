<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - Kas Kelas</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>

<body class="bg-slate-50 h-screen overflow-hidden text-slate-800 selection:bg-indigo-100 selection:text-indigo-900">

    <div class="flex h-full">
        
        @include('admin.navigasi.sidebar')

        <main class="flex-1 overflow-y-auto p-6 md:p-10 relative">
            
            <div class="absolute top-0 left-0 w-full h-64 bg-gradient-to-b from-indigo-50/50 to-transparent -z-10"></div>

            <header class="flex flex-col md:flex-row justify-between items-start md:items-center mb-10 gap-5">
                <div>
                    <h2 class="text-3xl font-extrabold tracking-tight bg-clip-text text-transparent bg-gradient-to-r from-slate-900 to-slate-600">
                        Selamat Datang, Admin! 👋
                    </h2>
                    <p class="text-slate-500 mt-1.5 font-medium">Ringkasan aktivitas kas kelas hari ini.</p>
                </div>
                
                <button class="bg-indigo-600 hover:bg-indigo-700 text-white px-5 py-2.5 rounded-xl font-medium transition-all shadow-lg shadow-indigo-600/30 hover:shadow-indigo-600/50 hover:-translate-y-0.5 flex items-center gap-2 active:scale-95">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    Catat Pemasukan
                </button>
            </header>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
                
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-200/60 flex flex-col gap-4 transition-all hover:shadow-md hover:border-emerald-200 group">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 flex items-center justify-center rounded-xl bg-emerald-50 text-emerald-600 group-hover:bg-emerald-100 group-hover:scale-110 transition-all">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm text-slate-500 font-medium">Total Saldo Kas</p>
                            <p class="text-2xl font-bold text-slate-800 mt-0.5">Rp 1.500.000</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-200/60 flex flex-col gap-4 transition-all hover:shadow-md hover:border-indigo-200 group">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 flex items-center justify-center rounded-xl bg-indigo-50 text-indigo-600 group-hover:bg-indigo-100 group-hover:scale-110 transition-all">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm text-slate-500 font-medium">Pemasukan (Mei)</p>
                            <p class="text-2xl font-bold text-slate-800 mt-0.5">Rp 250.000</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-1.5 text-xs font-medium text-emerald-600 bg-emerald-50 px-2 py-1 rounded-md w-fit mt-1">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>
                        <span>+12% dari bulan lalu</span>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-200/60 flex flex-col gap-4 transition-all hover:shadow-md hover:border-rose-200 group">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 flex items-center justify-center rounded-xl bg-rose-50 text-rose-600 group-hover:bg-rose-100 group-hover:scale-110 transition-all">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm text-slate-500 font-medium">Tunggakan</p>
                            <p class="text-2xl font-bold text-slate-800 mt-0.5">12 Orang</p>
                        </div>
                    </div>
                    <div class="w-full bg-slate-100 h-1.5 rounded-full mt-2 overflow-hidden">
                        <div class="bg-rose-500 h-1.5 rounded-full" style="width: 30%"></div>
                    </div>
                </div>

            </div>

            <div class="bg-white rounded-2xl shadow-sm border border-slate-200/60 overflow-hidden">
                <div class="px-6 py-5 border-b border-slate-100 flex justify-between items-center bg-white/50 backdrop-blur-sm">
                    <h3 class="font-bold text-lg text-slate-800">Riwayat Transaksi Terakhir</h3>
                    <a href="#" class="text-sm font-medium text-indigo-600 hover:text-indigo-700 flex items-center gap-1 group">
                        Lihat Semua 
                        <span class="transform group-hover:translate-x-1 transition-transform">&rarr;</span>
                    </a>
                </div>
                
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-slate-50 text-slate-500 text-xs uppercase tracking-wider font-semibold border-b border-slate-100">
                                <th class="px-6 py-4">Siswa</th>
                                <th class="px-6 py-4">Tanggal</th>
                                <th class="px-6 py-4">Nominal</th>
                                <th class="px-6 py-4">Status</th>
                                <th class="px-6 py-4 text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="text-sm divide-y divide-slate-100">
                            
                            <tr class="hover:bg-slate-50/80 transition-colors group">
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <img src="https://ui-avatars.com/api/?name=Ahmad+Dani&background=e0e7ff&color=4f46e5&rounded=true&bold=true" alt="Avatar" class="w-9 h-9 rounded-full ring-2 ring-white shadow-sm">
                                        <div>
                                            <span class="block font-semibold text-slate-800">Ahmad Dani</span>
                                            <span class="block text-xs text-slate-400 mt-0.5">NIS: 102938</span>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-slate-500">07 Mei 2026</td>
                                <td class="px-6 py-4 font-bold text-emerald-600">+ Rp 5.000</td>
                                <td class="px-6 py-4">
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-semibold bg-emerald-50 text-emerald-700 ring-1 ring-inset ring-emerald-600/20">
                                        Lunas
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <button class="text-slate-400 hover:text-indigo-600 transition-colors p-1.5 rounded-lg hover:bg-indigo-50">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                                    </button>
                                </td>
                            </tr>

                            <tr class="hover:bg-slate-50/80 transition-colors group">
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <img src="https://ui-avatars.com/api/?name=Siti+Aminah&background=fce7f3&color=db2777&rounded=true&bold=true" alt="Avatar" class="w-9 h-9 rounded-full ring-2 ring-white shadow-sm">
                                        <div>
                                            <span class="block font-semibold text-slate-800">Siti Aminah</span>
                                            <span class="block text-xs text-slate-400 mt-0.5">NIS: 102939</span>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-slate-500">06 Mei 2026</td>
                                <td class="px-6 py-4 font-bold text-emerald-600">+ Rp 5.000</td>
                                <td class="px-6 py-4">
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-semibold bg-emerald-50 text-emerald-700 ring-1 ring-inset ring-emerald-600/20">
                                        Lunas
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <button class="text-slate-400 hover:text-indigo-600 transition-colors p-1.5 rounded-lg hover:bg-indigo-50">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                                    </button>
                                </td>
                            </tr>

                            <tr class="hover:bg-slate-50/80 transition-colors group">
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <img src="https://ui-avatars.com/api/?name=Budi+Santoso&background=fef3c7&color=d97706&rounded=true&bold=true" alt="Avatar" class="w-9 h-9 rounded-full ring-2 ring-white shadow-sm">
                                        <div>
                                            <span class="block font-semibold text-slate-800">Budi Santoso</span>
                                            <span class="block text-xs text-slate-400 mt-0.5">NIS: 102940</span>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-slate-500">-</td>
                                <td class="px-6 py-4 font-bold text-slate-400">Rp 0</td>
                                <td class="px-6 py-4">
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-semibold bg-rose-50 text-rose-700 ring-1 ring-inset ring-rose-600/20">
                                        Belum Bayar
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <button class="text-slate-400 hover:text-indigo-600 transition-colors p-1.5 rounded-lg hover:bg-indigo-50">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                                    </button>
                                </td>
                            </tr>
                            </tbody>
                    </table>
                </div>
            </div>

        </main>
    </div>

</body>
</html>