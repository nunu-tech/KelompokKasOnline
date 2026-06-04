<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KasKelas - Modern Classroom Finance Dashboard</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        darkJet: '#111111',
                        softCream: '#F5E6C8',
                        luxuryGold: '#D4A373',
                    },
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                        poppins: ['Poppins', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    <script src="https://unpkg.com/lucide@latest"></script>
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #FAFAFA;
        }

        .font-poppins {
            font-family: 'Poppins', sans-serif;
        }
    </style>
</head>

<body class="bg-[#FAFAFA] text-darkJet antialiased flex h-screen overflow-hidden">

    <aside class="w-64 bg-darkJet text-white flex flex-col justify-between p-6 border-r border-luxuryGold/10 z-10">
        <div>
            <div class="flex items-center gap-3 mb-10 px-2">
                <div class="w-8 h-8 rounded-lg bg-luxuryGold flex items-center justify-center text-darkJet font-bold text-lg font-poppins">K</div>
                <h1 class="text-xl font-bold font-poppins tracking-wide">Kas<span class="text-luxuryGold">Kelas</span></h1>
            </div>

            <nav class="space-y-2">

                {{-- Dashboard / Pengeluaran --}}
                <a href="{{ route('walikelas.dashboard') }}"
                    class="flex items-center gap-4 px-4 py-3 rounded-xl font-medium
{{ request()->routeIs('walikelas.dashboard') ? 'text-luxuryGold bg-luxuryGold/10' : 'text-gray-400 hover:text-luxuryGold' }}">
                    <i data-lucide="layout-dashboard" class="w-5 h-5"></i>
                    Dashboard
                </a>

                {{-- Data Siswa --}}
                <a href="#" class="flex items-center gap-4 px-4 py-3 rounded-xl font-medium transition-all duration-300 text-gray-400">

                    <i data-lucide="users" class="w-5 h-5 group-hover:scale-110 transition-transform"></i>
                    Data Siswa
                </a>

                {{-- Pembayaran Kas --}}
                <a href="{{ route('walikelas.kas.index') }}"
                    class="flex items-center gap-4 px-4 py-3 rounded-xl font-medium transition-all duration-300
{{ request()->routeIs('walikelas.kas.*')
    ? 'text-luxuryGold bg-luxuryGold/10'
    : 'text-gray-400 hover:text-luxuryGold hover:bg-luxuryGold/5' }}">

                    <i data-lucide="wallet" class="w-5 h-5 group-hover:scale-110 transition-transform"></i>
                    Pembayaran Kas
                </a>

                {{-- Laporan --}}
                <a href="{{ route('walikelas.laporan') }}"
                    class="flex items-center gap-4 px-4 py-3 rounded-xl font-medium transition-all duration-300 group
       {{ request()->routeIs('walikelas.laporan')
            ? 'text-luxuryGold bg-luxuryGold/10'
            : 'text-gray-400 hover:text-luxuryGold hover:bg-luxuryGold/5' }}">

                    <i data-lucide="file-text" class="w-5 h-5 group-hover:scale-110 transition-transform"></i>
                    Laporan Keuangan
                </a>

                {{-- Izin & Tunggakan --}}
                <a href="#"
                    class="flex items-center gap-4 px-4 py-3 rounded-xl text-gray-400 hover:text-luxuryGold hover:bg-luxuryGold/5 font-medium transition-all duration-300 group">

                    <i data-lucide="alert-circle" class="w-5 h-5 group-hover:scale-110 transition-transform"></i>
                    Izin & Tunggakan
                </a>

                {{-- Pengumuman --}}
                <a href="#"
                    class="flex items-center gap-4 px-4 py-3 rounded-xl text-gray-400 hover:text-luxuryGold hover:bg-luxuryGold/5 font-medium transition-all duration-300 group">

                    <i data-lucide="megaphone" class="w-5 h-5 group-hover:scale-110 transition-transform"></i>
                    Pengumuman
                </a>

            </nav>
        </div>

        <div class="border-t border-gray-800 pt-4 space-y-4">
            <div class="flex items-center justify-between px-2 text-gray-400 text-sm">
                <span>Dark Mode</span>
                <button class="w-10 h-6 bg-gray-800 rounded-full p-1 transition-all duration-300 flex items-center justify-start" id="darkModeToggle">
                    <div class="w-4 h-4 bg-luxuryGold rounded-full"></div>
                </button>
            </div>
            <a href="#" class="flex items-center gap-4 px-4 py-3 rounded-xl text-red-400 hover:bg-red-500/10 font-medium transition-all duration-300">
                <i data-lucide="log-out" class="w-5 h-5"></i> Keluar
            </a>
        </div>
    </aside>

    <div class="flex-1 flex flex-col overflow-y-auto bg-[#FAFAFA]">
        <header class="flex items-center justify-between px-10 py-6 bg-white/80 backdrop-blur-md sticky top-0 border-b border-gray-100 z-50">
            <div>
                <h2 class="text-2xl font-bold font-poppins text-darkJet">Dashboard Utama</h2>
                <p class="text-sm text-gray-400">Selasa, 19 Mei 2026</p>
            </div>

            <div class="flex items-center gap-6">
                <div class="relative w-64">
                    <i data-lucide="search" class="w-4 h-4 absolute left-4 top-3.5 text-gray-400"></i>
                    <input type="text" placeholder="Cari siswa atau laporan..." class="w-full bg-[#F5F5F5] pl-11 pr-4 py-2.5 rounded-full text-sm focus:outline-none focus:ring-2 focus:ring-luxuryGold/50 transition-all">
                </div>
                <button class="relative p-2.5 bg-[#F5F5F5] rounded-full hover:bg-gray-200 transition-colors">
                    <i data-lucide="bell" class="w-5 h-5 text-darkJet"></i>
                    <span class="absolute top-2 right-2 w-2.5 h-2.5 bg-luxuryGold rounded-full border-2 border-white"></span>
                </button>
                <div class="flex items-center gap-3 border-l border-gray-200 pl-6">
                    <img src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?auto=format&fit=crop&q=80&w=120" alt="Wali Kelas" class="w-10 h-10 rounded-full object-cover border-2 border-luxuryGold">
                    <div>
                        <p class="text-sm font-semibold text-darkJet">Siti Rahma, S.Pd.</p>
                        <p class="text-xs text-gray-400">Wali Kelas 12-MIPA 1</p>
                    </div>
                </div>
            </div>
        </header>

        <main class="p-10 space-y-8">
            @yield('content')
        </main>
    </div>

    <script>
        lucide.createIcons();
    </script>
</body>

</html>