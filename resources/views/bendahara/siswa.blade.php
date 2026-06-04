<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Siswa</title>
    
    <!-- BOOTSTRAP 5 CORE (Untuk Layouting & Sidebar Presisi) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- TAILWIND CSS (Untuk Render Tampilan Konten & Bento Card) -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Google Fonts & Icons -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

    <script>
        // Re-aktivasi Konfigurasi Warna Estetik Tailwind Anda
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
        :root {
            --bg-base: #FDFBF9;
            --bg-sidebar: #FFFFFF;
            --surface: #FFFFFF;
            --accent-primary: #E57C70;
            --accent-secondary: #F6E6E4;
            --text-heading: #1A2130;
            --text-body: #5A6578;
            --border-color: #F1ECE8;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: var(--bg-base);
            color: var(--text-body);
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

        /* SIDEBAR ARCHITECTURE STYLE — 100% MATCH DENGAN INDEX/DASHBOARD */
        .sidebar-container {
            background: var(--bg-sidebar);
            border-right: 1px solid var(--border-color);
            width: 290px;
            height: 100vh;
            position: fixed;
            top: 0; left: 0;
            z-index: 100;
        }

        .nav-aesthetic .nav-link {
            color: var(--text-body);
            font-weight: 600;
            font-size: 0.92rem;
            padding: 14px 20px;
            border-radius: 16px;
            margin-bottom: 8px;
            transition: all 0.25s ease;
            display: flex;
            align-items: center;
            text-decoration: none;
        }

        .nav-aesthetic .nav-link i {
            font-size: 1.1rem;
            transition: transform 0.25s ease;
        }

        .nav-aesthetic .nav-link:hover {
            color: var(--accent-primary);
            background: var(--accent-secondary);
        }

        .nav-aesthetic .nav-link:hover i {
            transform: translateX(4px);
        }

        .nav-aesthetic .nav-link.active {
            background: linear-gradient(135deg, #FAF4F2 0%, var(--accent-secondary) 100%);
            color: var(--accent-primary);
            font-weight: 700;
            border: 1px solid rgba(229, 124, 112, 0.15);
        }

        /* WORKSPACE COPIED SIZE */
        .workspace {
            margin-left: 290px;
            padding: 56px;
            width: calc(100% - 290px);
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

        @media (max-width: 991.98px) {
            .sidebar-container { display: none !important; }
            .workspace { margin-left: 0; width: 100%; padding: 24px; }
        }
    </style>
</head>
<body class="min-h-screen">

    <!-- SIDEBAR ARCHITECTURE — BOOTSTRAP FIXED STRUCTURE (100% SAMA) -->
    <div class="sidebar-container d-flex flex-column justify-content-between p-4">
        <div>
            <!-- Branding Header -->
            <div class="d-flex align-items-center gap-3 mb-5 mt-2 px-2">
                <div class="rounded-4 d-flex align-items-center justify-content-center shadow-sm" style="width: 42px; height: 42px; background: var(--accent-secondary); color: var(--accent-primary);">
                    <i class="bi bi-intersect fs-5"></i>
                </div>
                <div>
                    <h1 class="h5 m-0 fw-bold tracking-tight" style="color: var(--text-heading); font-weight: 800; font-size: 1.25rem; letter-spacing: -0.5px;">
                        Class<span style="color: var(--accent-primary)">Ledger.</span>
                    </h1>
                    <p class="m-0 text-uppercase tracking-widest" style="font-size: 8px; font-weight: 800; color: #A0AEC0; letter-spacing: 1.8px;">FINANCIAL ECOSYSTEM</p>
                </div>
            </div>

            <!-- Navigation Links -->
            <nav class="nav nav-pills flex-column nav-aesthetic">
                <a class="nav-link" href="{{ route('bendahara.index') }}">
                    <i class="bi bi-columns-gap me-3"></i> Dashboard
                </a>
                <a class="nav-link active" href="{{ route('bendahara.siswa') }}">
                    <i class="bi bi-person-lines-fill me-3"></i> Data Siswa
                </a>
                <a class="nav-link" href="{{ route('bendahara.laporan') }}">
                    <i class="bi bi-bar-chart-line me-3"></i> Analytics & Laporan
                </a>
                <a class="nav-link" href="{{ route('bendahara.verifikasi') }}">
                    <i class="bi bi-shield-check me-3"></i> Verifikasi Kas
                </a>
            </nav>
        </div>

        <!-- Session User Identity Card -->
        <div class="p-3 rounded-4" style="background: var(--bg-base); border: 1px solid var(--border-color)">
            <div class="d-flex align-items-center gap-3 mb-3">
                <img src="https://ui-avatars.com/api/?name=Bendahara+Kelas&background=F6E6E4&color=E57C70&bold=true" class="rounded-4" style="width: 40px; height: 40px;">
                <div class="overflow-hidden">
                    <p class="m-0 fw-bold small text-truncate" style="color: var(--text-heading);">Bendahara Kelas</p>
                    <p class="m-0 text-muted" style="font-size: 11px;">Administrator Mode</p>
                </div>
            </div>
            <button class="btn btn-sm w-100 btn-light rounded-3 py-2 fw-bold shadow-none" style="font-size: 11px; color: #E53E3E; background: #FFF; border: 1px solid var(--border-color);">
                Logout Session
            </button>
        </div>
    </div>

    <!-- WORKSPACE WRAPPER — KONTEN SEKARANG MUNBUL SEMPURNA DENGAN RENDER TAILWIND -->
    <div class="workspace">
        
        <!-- Header Panel -->
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-10 gap-4">
            <div>
                <h2 class="text-3xl font-extrabold text-[#1A2130] tracking-tight" style="font-size: 1.85rem; letter-spacing: -0.5px;">Student Directory</h2>
                <p class="text-[#5A6578] text-sm mt-1">Manajemen daftar anggota resmi dan pemantauan akumulasi iuran kelas.</p>
            </div>
            
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

        <!-- INSIGHT BENTO PANELS -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
            
            <!-- Card 1: Tabungan Tertinggi -->
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

            <!-- Card 2: Rasio Kontribusi -->
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

            <!-- Card 3: Rata-Rata Simpanan -->
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
            
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4">
                <div class="flex items-center gap-2.5">
                    <div class="w-1 h-6 bg-[#E57C70] rounded-full"></div>
                    <h3 class="font-extrabold text-base text-[#1A2130]" style="font-weight: 700; letter-spacing: -0.2px;">Daftar Anggota Kelas</h3>
                </div>
                
                <div class="relative w-full md:w-80 flex items-center">
                    <div class="absolute left-5 text-gray-400 flex items-center justify-center" style="height: 100%; top: 0;">
                        <i class="bi bi-search text-sm"></i>
                    </div>
                    <input type="text" id="searchSiswa" placeholder="Cari nama anggota..." 
                        class="input-premium w-full pl-12 pr-4 py-3.5 rounded-2xl text-xs font-bold text-[#1A2130] outline-none">
                </div>
            </div>

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
                            <td class="py-4 pl-4">
                                <img src="https://ui-avatars.com/api/?name={{ urlencode($siswa->name) }}&background=F6E6E4&color=E57C70&bold=true" 
                                     class="w-11 h-11 rounded-2xl border border-[#F1ECE8] group-hover:scale-105 transition-transform duration-300">
                            </td>
                            <td class="nama-siswa py-4 font-bold text-[#1A2130] group-hover:text-[#E57C70] transition-colors">
                                {{ $siswa->name }}
                            </td>
                            <td class="py-4 text-center">
                                <span class="px-3 py-1 bg-[#F4FBF7] text-emerald-600 border border-emerald-100/60 rounded-full text-[9px] font-extrabold uppercase tracking-widest">
                                    Aktif
                                </span>
                            </td>
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
            
            @if($daftar_siswa->isEmpty())
                <div class="text-center py-20">
                    <div class="text-gray-300 text-3xl mb-3"><i class="bi bi-people"></i></div>
                    <p class="text-[#5A6578] text-xs italic font-medium">Data log siswa tidak ditemukan atau belum di-input.</p>
                </div>
            @endif
        </section>
    </div>

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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>