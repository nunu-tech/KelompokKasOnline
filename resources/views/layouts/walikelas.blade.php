<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KasKelas - Modern Classroom Financial</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #FAFAFA;
        }
    </style>
</head>
<body class="text-gray-800 antialiased">

    <div class="flex min-h-screen">

        <aside class="w-64 bg-[#111111] text-gray-400 p-5 flex flex-col justify-between hidden md:flex">
            <div>
                <div class="flex items-center gap-3 mb-8 px-2">
                    <div class="bg-[#E6C6A2] text-[#111111] font-bold w-8 h-8 rounded-lg flex items-center justify-center text-lg">
                        K
                    </div>
                    <span class="text-white font-bold text-xl tracking-wide">Kas<span class="text-[#E6C6A2]">Kelas</span></span>
                </div>

                <nav class="space-y-1">

    <!-- Dashboard -->
    <a href="{{ route('walikelas.dashboard') }}"
       class="flex items-center gap-3 px-4 py-3 text-white bg-[#222222] rounded-xl font-medium transition-all">
        <i class="fa-solid fa-table-columns text-[#E6C6A2]"></i>
        Dashboard
    </a>

    <!-- Data Siswa -->
    <a href="{{ route('walikelas.siswa.index') }}"
       class="flex items-center gap-3 px-4 py-3 hover:text-white hover:bg-[#1A1A1A] rounded-xl font-medium transition-all">
        <i class="fa-solid fa-user-group text-sm"></i>
        Data Siswa
    </a>

    <!-- Pembayaran Kas -->
    <a href="{{ route('walikelas.kas.index') }}"
       class="flex items-center gap-3 px-4 py-3 hover:text-white hover:bg-[#1A1A1A] rounded-xl font-medium transition-all">
        <i class="fa-solid fa-wallet text-sm"></i>
        Pembayaran Kas
    </a>

    <!-- Laporan -->
    <a href="{{ route('walikelas.laporan') }}"
       class="flex items-center gap-3 px-4 py-3 hover:text-white hover:bg-[#1A1A1A] rounded-xl font-medium transition-all">
        <i class="fa-solid fa-file-invoice-dollar text-sm"></i>
        Laporan Keuangan
    </a>

    <!-- Izin & Tunggakan -->
    <a href="#"
       class="flex items-center gap-3 px-4 py-3 hover:text-white hover:bg-[#1A1A1A] rounded-xl font-medium transition-all">
        <i class="fa-solid fa-circle-exclamation text-sm"></i>
        Izin & Tunggakan
    </a>

    <!-- Pengumuman -->
    <a href="#"
       class="flex items-center gap-3 px-4 py-3 hover:text-white hover:bg-[#1A1A1A] rounded-xl font-medium transition-all">
        <i class="fa-solid fa-bullhorn text-sm"></i>
        Pengumuman
    </a>

</nav>
            </div>

            <div class="border-t border-gray-800 pt-4 space-y-3">
                <div class="flex items-center justify-between px-4 py-2">
                    <span class="text-sm">Dark Mode</span>
                    <button class="w-10 h-5 bg-gray-700 rounded-full p-0.5 transition-all relative flex items-center">
                        <span class="w-4 h-4 bg-gray-400 rounded-full shadow-md transform translate-x-0"></span>
                    </button>
                </div>
                <a href="#" class="flex items-center gap-3 px-4 py-3 text-red-400 hover:bg-red-950/20 rounded-xl font-medium transition-all">
                    <i class="fa-solid fa-right-from-bracket"></i> Keluar
                </a>
            </div>
        </aside>

        <main class="flex-1 flex flex-col min-w-0">
            
            <header class="bg-white border-b border-gray-100 px-8 py-4 flex items-center justify-between">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900">Dashboard Utama</h1>
                    <p class="text-xs text-gray-400 font-medium mt-0.5">Selasa, 19 Mei 2026</p>
                </div>

                <div class="flex items-center gap-6">
                    <div class="relative w-64 hidden sm:block">
                        <i class="fa-solid fa-magnifying-glass absolute left-3.5 top-1/2 -translate-y-1/2 text-gray-400 text-sm"></i>
                        <input type="text" placeholder="Cari siswa atau laporan..." class="w-full pl-10 pr-4 py-2 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#E6C6A2]/50 focus:border-[#E6C6A2]">
                    </div>

                    <button class="w-10 h-10 bg-gray-50 text-gray-600 rounded-xl flex items-center justify-center hover:bg-gray-100 transition-all relative">
                        <i class="fa-regular fa-bell"></i>
                        <span class="absolute top-2.5 right-2.5 w-2 h-2 bg-amber-500 rounded-full"></span>
                    </button>

                    <div class="flex items-center gap-3 border-l pl-6 border-gray-200">
                        <img src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?q=80&w=100&auto=format&fit=crop" alt="Profile" class="w-10 h-10 rounded-full object-cover ring-2 ring-[#E6C6A2]/20">
                        <div class="text-left hidden lg:block">
                            <h4 class="text-sm font-semibold text-gray-900 leading-none">Siti Rahma, S.Pd.</h4>
                            <span class="text-xs text-gray-400 font-medium mt-1 inline-block">Wali Kelas 12-MIPA 1</span>
                        </div>
                    </div>
                </div>
            </header>

            <div class="p-8 space-y-6 overflow-y-auto flex-1">
                
                <div class="bg-[#FDF6ED] border border-[#F5E6D3] rounded-3xl p-6 md:p-8 flex flex-col md:flex-row justify-between items-start md:items-center gap-6 relative overflow-hidden">
                    <div class="space-y-2 max-w-xl z-10">
                        <h2 class="text-xl md:text-2xl font-bold text-[#5C4033]">Selamat Datang, Wali Kelas ✨</h2>
                        <p class="text-sm text-[#7F604E] leading-relaxed">
                            Pantau perputaran kas kelas 12-MIPA 1 dengan mudah hari ini. Semua data pembayaran, tunggakan, dan laporan keuangan telah tersinkronisasi secara otomatis.
                        </p>
                        <div class="pt-2">
                            <button class="px-5 py-2.5 bg-white border border-[#E6C6A2] text-[#5C4033] font-semibold text-sm rounded-xl shadow-sm hover:bg-amber-50/50 transition-all">
                                Lihat Laporan
                            </button>
                        </div>
                    </div>
                    <div class="hidden md:flex w-24 h-24 bg-[#F5E6D3]/50 rounded-2xl items-center justify-center text-[#A47C5C] text-4xl">
                        <i class="fa-solid fa-chalkboard-user"></i>
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
                    
                    <div class="bg-white p-5 rounded-2xl border border-gray-100 flex justify-between items-start">
                        <div class="space-y-3">
                            <span class="text-xs font-semibold text-gray-400 tracking-wider uppercase">Total Siswa</span>
                            <h3 class="text-3xl font-bold text-gray-900">1</h3>
                            <p class="text-xs text-gray-400 font-medium">Siswa aktif semester ini</p>
                        </div>
                        <div class="w-10 h-10 bg-gray-50 rounded-xl flex items-center justify-center text-gray-700">
                            <i class="fa-solid fa-user-graduate"></i>
                        </div>
                    </div>

                    <div class="bg-white p-5 rounded-2xl border border-gray-100 flex justify-between items-start">
                        <div class="space-y-3 w-full">
                            <span class="text-xs font-semibold text-gray-400 tracking-wider uppercase">Siswa Sudah Bayar</span>
                            <h3 class="text-3xl font-bold text-gray-900">1 <span class="text-sm text-gray-400 font-normal">/1</span></h3>
                            <div class="w-full bg-gray-100 h-1.5 rounded-full overflow-hidden">
                                <div class="bg-[#C29B74] h-full rounded-full" style="width: 100%"></div>
                            </div>
                        </div>
                        <div class="w-10 h-10 bg-amber-50 text-[#C29B74] rounded-xl flex items-center justify-center ml-2 shrink-0">
                            <i class="fa-solid fa-circle-check"></i>
                        </div>
                    </div>

                    <div class="bg-white p-5 rounded-2xl border border-gray-100 flex justify-between items-start">
                        <div class="space-y-3">
                            <span class="text-xs font-semibold text-gray-400 tracking-wider uppercase">Siswa Menunggak</span>
                            <h3 class="text-3xl font-bold text-red-500">0</h3>
                            <p class="text-xs text-red-400 font-medium flex items-center gap-1">
                                <i class="fa-solid fa-triangle-exclamation"></i> Butuh tindakan pengingat
                            </p>
                        </div>
                        <div class="w-10 h-10 bg-red-50 text-red-500 rounded-xl flex items-center justify-center">
                            <i class="fa-solid fa-circle-exclamation"></i>
                        </div>
                    </div>

                    <div class="bg-white p-5 rounded-2xl border border-gray-100 flex justify-between items-start">
                        <div class="space-y-3">
                            <span class="text-xs font-semibold text-gray-400 tracking-wider uppercase">Total Uang Kas</span>
                            <h3 class="text-2xl font-bold text-gray-900">Rp 1.000</h3>
                            <p class="text-xs text-emerald-500 font-semibold flex items-center gap-1">
                                <i class="fa-solid fa-arrow-trend-up"></i> +12% bulan ini
                            </p>
                        </div>
                        <div class="w-10 h-10 bg-emerald-50 text-emerald-600 rounded-xl flex items-center justify-center">
                            <i class="fa-solid fa-money-bill-wave"></i>
                        </div>
                    </div>

                </div>

                </div>
        </main>

    </div>

</body>
</html>