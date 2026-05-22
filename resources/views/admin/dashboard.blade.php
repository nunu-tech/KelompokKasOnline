<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - Kas Kelas</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Memanggil Font Inter -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>

<!-- Pastikan background menggunakan slate-50 dan overflow-hidden agar rapi -->
<body class="bg-slate-50 h-screen overflow-hidden text-slate-800">

    <div class="flex h-full">
        
        <!-- PEMANGGILAN SIDEBAR HARUS DI SINI (DI DALAM DIV FLEX) -->
        @include('admin.navigasi.sidebar')

        <!-- MAIN CONTENT AREA -->
        <!-- Gunakan overflow-y-auto agar bagian konten bisa di-scroll jika panjang, sementara sidebar tetap diam -->
        <main class="flex-1 overflow-y-auto p-8 md:p-10">
            
            <!-- Header -->
            <header class="flex flex-col md:flex-row justify-between items-start md:items-center mb-10 gap-4">
                <div>
                    <h2 class="text-3xl font-bold tracking-tight text-slate-900">Selamat Datang, Admin! 👋</h2>
                    <p class="text-slate-500 mt-1">Jumat, 22 Mei 2026 • Ringkasan aktivitas kas kelas hari ini.</p>
                </div>
                <!-- Tombol Aksi Cepat -->
                <button class="bg-indigo-600 hover:bg-indigo-700 text-white px-5 py-2.5 rounded-xl font-medium transition-all shadow-lg shadow-indigo-200 flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                    Catat Pemasukan
                </button>
            </header>

            <!-- Ringkasan Statistik -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
                
                <!-- Card 1: Total Saldo -->
                <div class="bg-white p-6 rounded-3xl shadow-sm border border-slate-100 flex items-center gap-5 transition-transform hover:-translate-y-1 duration-300">
                    <div class="w-14 h-14 flex items-center justify-center rounded-2xl bg-emerald-100 text-emerald-600">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <div>
                        <p class="text-sm text-slate-500 font-medium mb-1">Total Saldo Kas</p>
                        <p class="text-2xl font-bold text-slate-800">Rp 1.500.000</p>
                    </div>
                </div>

                <!-- Card 2: Pemasukan Bulan Ini -->
                <div class="bg-white p-6 rounded-3xl shadow-sm border border-slate-100 flex items-center gap-5 transition-transform hover:-translate-y-1 duration-300">
                    <div class="w-14 h-14 flex items-center justify-center rounded-2xl bg-indigo-100 text-indigo-600">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>
                    </div>
                    <div>
                        <p class="text-sm text-slate-500 font-medium mb-1">Pemasukan (Mei)</p>
                        <p class="text-2xl font-bold text-slate-800">Rp 250.000</p>
                    </div>
                </div>

                <!-- Card 3: Siswa Belum Bayar -->
                <div class="bg-white p-6 rounded-3xl shadow-sm border border-slate-100 flex items-center gap-5 transition-transform hover:-translate-y-1 duration-300">
                    <div class="w-14 h-14 flex items-center justify-center rounded-2xl bg-rose-100 text-rose-600">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                    </div>
                    <div>
                        <p class="text-sm text-slate-500 font-medium mb-1">Belum Bayar (Minggu Ini)</p>
                        <p class="text-2xl font-bold text-slate-800">12 Orang</p>
                    </div>
                </div>

            </div>

            <!-- Bagian Tabel -->
            <div class="bg-white rounded-3xl shadow-sm border border-slate-100 overflow-hidden">
                <div class="px-6 py-5 border-b border-slate-100 flex justify-between items-center bg-white">
                    <h3 class="font-bold text-lg text-slate-800">Riwayat Transaksi Terakhir</h3>
                    <a href="#" class="text-sm font-medium text-indigo-600 hover:text-indigo-700">Lihat Semua &rarr;</a>
                </div>
                
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-slate-50/50 text-slate-500 text-xs uppercase tracking-wider">
                                <th class="px-6 py-4 font-medium">Siswa</th>
                                <th class="px-6 py-4 font-medium">Tanggal</th>
                                <th class="px-6 py-4 font-medium">Nominal</th>
                                <th class="px-6 py-4 font-medium">Status</th>
                            </tr>
                        </thead>
                        <tbody class="text-sm divide-y divide-slate-100">
                            <!-- Baris 1 -->
                            <tr class="hover:bg-slate-50/50 transition-colors">
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <img src="https://ui-avatars.com/api/?name=Ahmad+Dani&background=e2e8f0&color=475569&rounded=true" alt="Avatar" class="w-8 h-8 rounded-full">
                                        <span class="font-semibold text-slate-800">Ahmad Dani</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-slate-500">07 Mei 2026</td>
                                <td class="px-6 py-4 font-bold text-emerald-600">+ Rp 5.000</td>
                                <td class="px-6 py-4">
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-emerald-100 text-emerald-700">
                                        Lunas
                                    </span>
                                </td>
                            </tr>
                            <!-- Baris 2 -->
                            <tr class="hover:bg-slate-50/50 transition-colors">
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <img src="https://ui-avatars.com/api/?name=Siti+Aminah&background=e2e8f0&color=475569&rounded=true" alt="Avatar" class="w-8 h-8 rounded-full">
                                        <span class="font-semibold text-slate-800">Siti Aminah</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-slate-500">06 Mei 2026</td>
                                <td class="px-6 py-4 font-bold text-emerald-600">+ Rp 5.000</td>
                                <td class="px-6 py-4">
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-emerald-100 text-emerald-700">
                                        Lunas
                                    </span>
                                </td>
                            </tr>
                            <!-- Baris 3 (Contoh Tunggakan) -->
                            <tr class="hover:bg-slate-50/50 transition-colors">
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <img src="https://ui-avatars.com/api/?name=Budi+Santoso&background=e2e8f0&color=475569&rounded=true" alt="Avatar" class="w-8 h-8 rounded-full">
                                        <span class="font-semibold text-slate-800">Budi Santoso</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-slate-500">-</td>
                                <td class="px-6 py-4 font-bold text-slate-400">Rp 0</td>
                                <td class="px-6 py-4">
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-rose-100 text-rose-700">
                                        Belum Bayar
                                    </span>
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