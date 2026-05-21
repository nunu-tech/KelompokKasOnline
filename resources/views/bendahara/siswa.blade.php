<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Siswa — ClassLedger Premium Interface</title>
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Google Fonts & Icons -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'brand-rose': '#E57C70',
                        'brand-nude': '#F6E6E4',
                        'brand-cream': '#FDFBF9',
                        'brand-slate': '#1A2130',
                        'brand-grey': '#5A6578',
                    }
                }
            }
        }
    </script>

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #FDFBF9;
            color: #5A6578;
            letter-spacing: -0.2px;
        }

        /* Bento-Style Container Card Custom Elements */
        .bento-card {
            background: #FFFFFF;
            border: 1px solid #F1ECE8;
            border-radius: 24px;
            box-shadow: 0 16px 40px rgba(142, 127, 122, 0.04);
            transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
        }

        .bento-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 24px 48px rgba(142, 127, 122, 0.06);
            border-color: rgba(229, 124, 112, 0.2);
        }

        /* Nav Link Styling — Matched 100% with Dashboard active state */
        .sidebar-active {
            background: linear-gradient(135deg, #FAF4F2 0%, #F6E6E4 100%) !important;
            color: #E57C70 !important;
            font-weight: 700 !important;
            border: 1px solid rgba(229, 124, 112, 0.15) !important;
        }

        .input-premium {
            background: #FDFDFD;
            border: 1.5px solid #F1ECE8;
            transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
        }

        .input-premium:focus {
            background: #FFFFFF;
            border-color: #E57C70;
            box-shadow: 0 0 0 4px rgba(229, 124, 112, 0.12);
            outline: none;
        }

        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-track { background: #FDFBF9; }
        ::-webkit-scrollbar-thumb { background: #E57C70; border-radius: 10px; }
    </style>
</head>
<body class="flex min-h-screen">

    <!-- SIDEBAR ARCHITECTURE — 100% MATCHED WITH DASHBOARD WORKSPACE -->
    <aside class="w-[290px] bg-white p-6 hidden lg:flex flex-col sticky top-0 h-screen justify-between z-50 border-r border-[#F1ECE8]">
        <div>
            <!-- Workspace Logo Branding -->
            <div class="flex items-center gap-3 mb-12 mt-2 px-2">
                <div class="w-[42px] h-[42px] rounded-2xl flex items-center justify-center shadow-sm bg-[#F6E6E4] text-[#E57C70]">
                    <i class="bi bi-intersect text-[1.25rem]"></i>
                </div>
                <div>
                    <h1 class="text-base m-0 tracking-tight text-[#1A2130]" style="font-weight: 800; font-size: 1.25rem; letter-spacing: -0.5px;">
                        Class<span class="text-[#E57C70]">Ledger.</span>
                    </h1>
                    <p class="text-[8px] uppercase tracking-widest text-[#A0AEC0] font-extrabold m-0 mt-0.5" style="letter-spacing: 1.8px;">FINANCIAL ECOSYSTEM</p>
                </div>
            </div>

            <!-- Navigation Links -->
            <nav class="space-y-2 flex flex-col">
                <a href="{{ route('bendahara.index') }}" class="flex items-center py-3.5 px-5 text-[#5A6578] hover:text-[#E57C70] hover:bg-[#F6E6E4] rounded-2xl font-semibold text-[0.92rem] transition-all group">
                    <i class="bi bi-columns-gap text-[1.1rem] mr-3 transition-transform group-hover:translate-x-1"></i> 
                    Dashboard
                </a>
                <a href="{{ route('bendahara.siswa') }}" class="sidebar-active flex items-center py-3.5 px-5 rounded-2xl text-[0.92rem] transition-all">
                    <i class="bi bi-person-lines-fill text-[1.1rem] mr-3"></i> 
                    Data Siswa
                </a>
                <a href="{{ route('bendahara.laporan') }}" class="flex items-center py-3.5 px-5 text-[#5A6578] hover:text-[#E57C70] hover:bg-[#F6E6E4] rounded-2xl font-semibold text-[0.92rem] transition-all group">
                    <i class="bi bi-bar-chart-line text-[1.1rem] mr-3 transition-transform group-hover:translate-x-1"></i> 
                    Analytics & Laporan
                </a>
            </nav>
        </div>

        <!-- Session User Identity Card -->
        <div class="p-3 rounded-2xl bg-[#FDFBF9] border border-[#F1ECE8]">
            <div class="flex items-center gap-3 mb-3">
                <img src="https://ui-avatars.com/api/?name=Bendahara+Kelas&background=F6E6E4&color=E57C70&bold=true" class="w-10 h-10 rounded-xl">
                <div class="overflow-hidden">
                    <p class="text-xs font-bold text-[#1A2130] truncate m-0">Bendahara Kelas</p>
                    <p class="text-gray-400 m-0 text-[11px]" style="font-size: 11px;">Administrator Mode</p>
                </div>
            </div>
            <button class="w-full bg-white text-[11px] font-bold py-2 rounded-xl border border-[#F1ECE8] text-red-500 hover:bg-red-50 transition-all shadow-none">
                Logout Session
            </button>
        </div>
    </aside>

    <!-- MAIN WORKSPACE CONTENT -->
    <main class="flex-1 p-6 lg:p-14 overflow-y-auto w-full">
        
        <!-- Header Panel -->
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-10 gap-4">
            <div>
                <h2 class="text-3xl font-extrabold text-[#1A2130] tracking-tight" style="font-size: 1.85rem; letter-spacing: -0.5px;">Student Directory</h2>
                <p class="text-[#5A6578] text-sm mt-1">Manajemen daftar anggota resmi dan pemantauan akumulasi iuran kelas.</p>
            </div>
            
            <!-- Dynamic Counter Badge Component -->
            <div class="flex items-center gap-3 bg-white px-4 py-2.5 rounded-2xl border border-[#F1ECE8] shadow-sm">
                <div class="w-10 h-10 bg-[#F6E6E4] rounded-xl flex items-center justify-center text-[#E57C70]">
                    <i class="bi bi-people-fill text-lg"></i>
                </div>
                <div class="pr-2">
                    <p class="text-[9px] font-extrabold text-[#A0AEC0] uppercase tracking-wider">Total Anggota</p>
                    <p class="text-xs font-bold text-[#1A2130] mt-0.5">{{ count($daftar_siswa) }} Siswa Terdaftar</p>
                </div>
            </div>
        </div>

        <!-- RE-DESIGNED PREMIUM INSIGHT BENTO (Lebih Bersih & Berkelas) -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
            
            <!-- Card 1: Akumulasi Tertinggi -->
            <div class="bento-card p-6 bg-white flex items-center gap-4">
                <div class="w-12 h-12 rounded-2xl bg-[#F6E6E4] text-[#E57C70] flex items-center justify-center text-xl flex-shrink-0">
                    <i class="bi bi-trophy-fill"></i>
                </div>
                <div class="overflow-hidden">
                    <p class="text-[#A0AEC0] font-extrabold text-[9px] uppercase tracking-wider m-0">Tabungan Tertinggi</p>
                    <h3 class="text-[15px] font-bold text-[#1A2130] truncate mt-0.5" style="letter-spacing: -0.2px;">
                        {{ $siswa_terajin->name ?? 'Belum ada data' }}
                    </h3>
                </div>
            </div>

            <!-- Card 2: Tingkat Partisipasi (DIUBAH MENJADI DINAMIS DENGAN VARIABEL RASIO KONTRIBUSI) -->
            <div class="bento-card p-6 bg-white flex items-center gap-4">
                <div class="w-12 h-12 rounded-2xl bg-emerald-50 text-emerald-600 flex items-center justify-center text-xl flex-shrink-0">
                    <i class="bi bi-check-circle-fill"></i>
                </div>
                <div>
                    <p class="text-[#A0AEC0] font-extrabold text-[9px] uppercase tracking-wider m-0">Rasio Kontribusi</p>
                    <h3 class="text-[15px] font-bold text-[#1A2130] mt-0.5" style="letter-spacing: -0.2px;">
                        {{ $rasio_kontribusi }}% Aktif Berpartisipasi
                    </h3>
                </div>
            </div>

            <!-- Card 3: Rata-rata Tabungan -->
            <div class="bento-card p-6 bg-white flex items-center gap-4">
                <div class="w-12 h-12 rounded-2xl bg-amber-50 text-amber-600 flex items-center justify-center text-xl flex-shrink-0">
                    <i class="bi bi-wallet2"></i>
                </div>
                <div>
                    <p class="text-[#A0AEC0] font-extrabold text-[9px] uppercase tracking-wider m-0">Rata-Rata Simpanan</p>
                    <h3 class="text-[15px] font-bold text-[#1A2130] mt-0.5" style="letter-spacing: -0.2px;">
                        <span class="text-xs font-semibold text-gray-400 mr-0.5">Rp</span>{{ number_format($daftar_siswa->avg('total_bayar'), 0, ',', '.') }}
                    </h3>
                </div>
            </div>
            
        </div>

        <!-- CORE DATA DIRECTORY TABLE CONTAINER -->
        <section class="bento-card p-6 sm:p-8">
            
            <!-- Table Header Control Filters -->
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4">
                <div class="flex items-center gap-2.5">
                    <div class="w-1 h-6 bg-[#E57C70] rounded-full"></div>
                    <h3 class="font-extrabold text-base text-[#1A2130]" style="font-weight: 700; letter-spacing: -0.2px;">Daftar Anggota Kelas</h3>
                </div>
                
                <!-- Modern Search Bar Integration -->
                <div class="relative w-full md:w-80 flex items-center">
                    <div class="absolute left-5 text-gray-400 flex items-center justify-center">
                        <i class="bi bi-search text-sm"></i>
                    </div>
                    <input type="text" id="searchSiswa" placeholder="Cari nama anggota..." 
                        class="input-premium w-full pl-12 pr-4 py-3.5 rounded-2xl text-xs font-bold text-[#1A2130] outline-none">
                </div>
            </div>

            <!-- Responsive Table Engine -->
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse" id="siswaTable">
                    <thead>
                        <tr class="text-[#A0AEC0] text-[10px] uppercase font-extrabold border-b border-[#F1ECE8] tracking-wider">
                            <th class="pb-4 pl-4 w-24">Profil</th>
                            <th class="pb-4">Nama Lengkap Siswa</th>
                            <th class="pb-4 text-center">Status Keanggotaan</th>
                            <th class="pb-4 text-right pr-6">Akumulasi Iuran (Riil)</th>
                        </tr>
                    </thead>
                    <tbody class="text-[13.5px]">
                        @foreach($daftar_siswa as $siswa)
                        <tr class="hover:bg-[#FDFBF9] transition-all border-b border-[#F1ECE8]/60 group">
                            <!-- Avatar Column -->
                            <td class="py-4 pl-4">
                                <img src="https://ui-avatars.com/api/?name={{ urlencode($siswa->name) }}&background=F6E6E4&color=E57C70&bold=true" 
                                     class="w-11 h-11 rounded-2xl border border-[#F1ECE8] group-hover:scale-105 transition-transform duration-300">
                            </td>
                            <!-- Student Identity -->
                            <td class="nama-siswa py-4 font-bold text-[#1A2130] group-hover:text-[#E57C70] transition-colors">
                                {{ $siswa->name }}
                            </td>
                            <!-- Status Pill (Aesthetic Outline Minimalist) -->
                            <td class="py-4 text-center">
                                <span class="px-3 py-1 bg-[#F4FBF7] text-emerald-600 border border-emerald-100/60 rounded-full text-[9px] font-extrabold uppercase tracking-widest">
                                    Aktif
                                </span>
                            </td>
                            <!-- Total Contributions Accumulator -->
                            <td class="py-4 text-right pr-6">
                                <p class="font-bold text-[#1A2130] text-[14.5px]">
                                    <span class="text-xs font-bold text-[#A0AEC0] mr-0.5">Rp</span>{{ number_format($siswa->total_bayar ?? 0, 0, ',', '.') }}
                                </p>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            <!-- Structural Blank/Empty State Vector Area -->
            @if($daftar_siswa->isEmpty())
                <div class="text-center py-20">
                    <div class="text-gray-300 text-3xl mb-3"><i class="bi bi-people"></i></div>
                    <p class="text-[#5A6578] text-xs italic font-medium">Data log siswa tidak ditemukan atau belum di-input.</p>
                </div>
            @endif
        </section>
    </main>

    <!-- LIVE SEARCH DOM SCRIPT -->
    <script>
        document.getElementById('searchSiswa').addEventListener('keyup', function() {
            let filter = this.value.toLowerCase().trim();
            let rows = document.querySelectorAll('#siswaTable tbody tr');
            
            rows.forEach(row => {
                let nameElement = row.querySelector('.nama-siswa');
                if (nameElement) {
                    let name = nameElement.innerText.toLowerCase();
                    row.style.display = name.includes(filter) ? '' : 'none';
                }
            });
        });
    </script>
</body>
</html>