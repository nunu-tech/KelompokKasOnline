<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Keuangan — ClassLedger Premium</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
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

        .glass-card {
            background: #FFFFFF;
            border: 1px solid #F1ECE8;
            border-radius: 24px;
            box-shadow: 0 16px 40px rgba(142, 127, 122, 0.04);
            transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
        }

        .glass-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 24px 48px rgba(142, 127, 122, 0.07);
        }

        /* Nav Link Styling - Matched 100% with Dashboard active state */
        .sidebar-active {
            background: linear-gradient(135deg, #FAF4F2 0%, #F6E6E4 100%) !important;
            color: #E57C70 !important;
            font-weight: 700 !important;
            border: 1px solid rgba(229, 124, 112, 0.15) !important;
        }

        .input-premium {
            background: #FDFDFD;
            border: 1.5px solid #F1ECE8;
            transition: all 0.3s ease;
        }

        .input-premium:focus {
            background: #FFFFFF;
            border-color: #E57C70;
            box-shadow: 0 0 0 4px rgba(229, 124, 112, 0.12);
            outline: none;
        }

        /* Optimasi cetak laporan resmi sekolah */
        @media print {
            .no-print { display: none !important; }
            body { background: #FFFFFF; color: #000000; }
            .glass-card { border: 1px solid #E2E8F0; box-shadow: none !important; transform: none !important; background: #FFF; }
            .print-layout { width: 100% !important; padding: 0 !important; margin: 0 !important; }
            .print-header { display: block !important; }
            .print-footer { display: flex !important; }
        }
    </style>
</head>
<body class="flex min-h-screen">

    <aside class="no-print w-[290px] bg-white p-6 hidden lg:flex flex-col sticky top-0 h-screen justify-between z-50 border-r border-[#F1ECE8]">
        <div>
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

            <nav class="space-y-2 flex flex-col">
                <a href="{{ route('bendahara.index') }}" class="flex items-center py-3.5 px-5 text-[#5A6578] hover:text-[#E57C70] hover:bg-[#F6E6E4] rounded-2xl font-semibold text-[0.92rem] transition-all group">
                    <i class="bi bi-columns-gap text-[1.1rem] mr-3 transition-transform group-hover:translate-x-1"></i> 
                    Dashboard
                </a>
                <a href="{{ route('bendahara.siswa') }}" class="flex items-center py-3.5 px-5 text-[#5A6578] hover:text-[#E57C70] hover:bg-[#F6E6E4] rounded-2xl font-semibold text-[0.92rem] transition-all group">
                    <i class="bi bi-person-lines-fill text-[1.1rem] mr-3 transition-transform group-hover:translate-x-1"></i> 
                    Data Siswa
                </a>
                <a href="{{ route('bendahara.laporan') }}" class="sidebar-active flex items-center py-3.5 px-5 rounded-2xl text-[0.92rem] transition-all">
                    <i class="bi bi-bar-chart-line text-[1.1rem] mr-3"></i> 
                    Analytics & Laporan
                </a>
                <a href="{{ route('bendahara.verifikasi') }}" class="flex items-center py-3.5 px-5 text-[#5A6578] hover:text-[#E57C70] hover:bg-[#F6E6E4] rounded-2xl font-semibold text-[0.92rem] transition-all group">
                    <i class="bi bi-shield-check text-[1.1rem] mr-3 transition-transform group-hover:translate-x-1"></i> 
                    Verifikasi Kas
                </a>
            </nav>
        </div>

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

    <main class="print-layout flex-1 p-6 lg:p-14 overflow-y-auto w-full">
        
        <div class="flex flex-col sm:flex-row sm:items-center justify-between mb-10 gap-4">
            <div>
                <h2 class="text-3xl font-extrabold text-[#1A2130] tracking-tight" style="font-size: 1.85rem; letter-spacing: -0.5px;">Financial Analytics</h2>
                <p class="text-[#5A6578] text-sm mt-1">Audit berkas rekapitulasi riwayat arus kas periode berjalan.</p>
            </div>
            <div class="no-print flex items-center">
                 <button onclick="window.print()" class="flex items-center gap-2.5 bg-gradient-to-br from-[#EA9389] to-[#E57C70] text-white px-6 py-3.5 rounded-2xl font-bold text-xs hover:opacity-95 transition-all shadow-md shadow-[#E57C70]/20">
                    <i class="bi bi-printer text-sm"></i>
                    CETAK LAPORAN
                </button>
            </div>
        </div>

        <div class="print-header hidden mb-8 pb-4 border-b-2 border-gray-800">
            <div class="text-center">
                <h1 class="text-2xl font-black uppercase tracking-wide text-black">LAPORAN PERTANGGUNGJAWABAN KAS KELAS</h1>
                <p class="text-xs font-semibold text-gray-600 uppercase mt-1">Sistem Keuangan Digital ClassLedger Platform</p>
                <p class="text-[11px] text-gray-500 mt-0.5">Periode Buku: {{ date('F', mktime(0, 0, 0, $bulan, 1)) }} {{ $tahun }}</p>
            </div>
        </div>

        <section class="no-print glass-card p-6 sm:p-8 mb-8">
            <form action="{{ route('bendahara.laporan') }}" method="GET" class="flex flex-col md:flex-row items-end gap-5">
                <div class="w-full md:w-1/3">
                    <label class="text-[10px] font-extrabold text-[#A0AEC0] uppercase tracking-widest mb-2.5 block px-1" style="letter-spacing: 0.5px;">Matriks Bulan</label>
                    <select name="bulan" class="input-premium w-full p-3.5 rounded-2xl text-xs font-bold text-[#1A2130]">
                        @foreach(range(1, 12) as $m)
                            <option value="{{ sprintf('%02d', $m) }}" {{ $bulan == $m ? 'selected' : '' }}>
                                {{ date('F', mktime(0, 0, 0, $m, 1)) }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="w-full md:w-1/3">
                    <label class="text-[10px] font-extrabold text-[#A0AEC0] uppercase tracking-widest mb-2.5 block px-1" style="letter-spacing: 0.5px;">Matriks Tahun</label>
                    <select name="tahun" class="input-premium w-full p-3.5 rounded-2xl text-xs font-bold text-[#1A2130]">
                        @foreach(range(date('Y')-2, date('Y')) as $y)
                            <option value="{{ $y }}" {{ $tahun == $y ? 'selected' : '' }}>{{ $y }}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="w-full md:w-auto bg-[#1A2130] text-white px-8 py-4 rounded-2xl font-bold text-xs hover:bg-black transition-all">
                    PROPAGASI FILTER
                </button>
            </form>
        </section>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
            
            <div class="glass-card p-6 relative overflow-hidden bg-gradient-to-br from-white to-[#F4FBF7]">
                <div class="absolute -top-10 -right-10 w-24 h-24 rounded-full bg-emerald-100/40 blur-xl"></div>
                <div class="relative z-10 flex flex-col justify-between h-full">
                    <div class="flex items-center justify-between mb-4">
                        <p class="text-[#A0AEC0] font-extrabold text-[10px] uppercase tracking-widest" style="letter-spacing: 2px;">Total Arus Masuk</p>
                        <div class="w-8 h-8 rounded-xl bg-emerald-50 text-emerald-500 flex items-center justify-center border border-emerald-100/60 shadow-sm">
                            <i class="bi bi-graph-up-arrow text-xs"></i>
                        </div>
                    </div>
                    <div>
                        <h3 class="text-2xl font-black text-emerald-600 tracking-tight" style="font-weight: 800; tracking-spacing: -1.5px;">
                            <span class="text-sm font-bold mr-0.5 text-emerald-500/70">Rp</span>{{ number_format($total_masuk, 0, ',', '.') }}
                        </h3>
                        <p class="text-[10px] text-emerald-600/60 font-semibold mt-1">Akumulasi dana masuk</p>
                    </div>
                </div>
            </div>

            <div class="glass-card p-6 relative overflow-hidden bg-gradient-to-br from-white to-[#FFF5F5]">
                <div class="absolute -top-10 -right-10 w-24 h-24 rounded-full bg-rose-100/40 blur-xl"></div>
                <div class="relative z-10 flex flex-col justify-between h-full">
                    <div class="flex items-center justify-between mb-4">
                        <p class="text-[#A0AEC0] font-extrabold text-[10px] uppercase tracking-widest" style="letter-spacing: 2px;">Total Pengeluaran</p>
                        <div class="w-8 h-8 rounded-xl bg-rose-50 text-rose-500 flex items-center justify-center border border-rose-100/60 shadow-sm">
                            <i class="bi bi-graph-down-arrow text-xs"></i>
                        </div>
                    </div>
                    <div>
                        <h3 class="text-2xl font-black text-rose-500 tracking-tight" style="font-weight: 800; tracking-spacing: -1.5px;">
                            <span class="text-sm font-bold mr-0.5 text-rose-400/70">Rp</span>{{ number_format($total_keluar, 0, ',', '.') }}
                        </h3>
                        <p class="text-[10px] text-rose-500/60 font-semibold mt-1">Alokasi pemakaian dana</p>
                    </div>
                </div>
            </div>

            <div class="glass-card p-6 relative overflow-hidden bg-gradient-to-br from-white to-[#FAF4F2] border border-[#E57C70]/10">
                <div class="absolute -top-10 -right-10 w-24 h-24 rounded-full bg-[#E57C70]/15 blur-xl"></div>
                <div class="relative z-10 flex flex-col justify-between h-full">
                    <div class="flex items-center justify-between mb-4">
                        <p class="text-[#A0AEC0] font-extrabold text-[10px] uppercase tracking-widest" style="letter-spacing: 2px;">Kas Bersih Riil</p>
                        <div class="w-8 h-8 rounded-xl bg-[#F6E6E4] text-[#E57C70] flex items-center justify-center border border-[#E57C70]/20 shadow-sm">
                            <i class="bi bi-wallet2 text-xs"></i>
                        </div>
                    </div>
                    <div>
                        <h3 class="text-2xl font-black text-[#E57C70] tracking-tight" style="font-weight: 800; tracking-spacing: -1.5px;">
                            <span class="text-sm font-bold mr-0.5 text-[#E57C70]/70">Rp</span>{{ number_format($saldo_periode, 0, ',', '.') }}
                        </h3>
                        <p class="text-[10px] text-[#E57C70]/60 font-semibold mt-1">Sisa saldo siap pakai</p>
                    </div>
                </div>
            </div>

        </div>

        <section class="glass-card p-6 sm:p-8">
            <div class="flex items-center gap-2.5 mb-8">
                <div class="w-1 h-6 bg-[#E57C70] rounded-full"></div>
                <h3 class="font-extrabold text-base text-[#1A2130]" style="font-weight: 700; letter-spacing: -0.2px;">Buku Kas: {{ date('F', mktime(0, 0, 0, $bulan, 1)) }} {{ $tahun }}</h3>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="text-[#A0AEC0] text-[10px] uppercase font-extrabold border-b border-[#F1ECE8] tracking-wider">
                            <th class="pb-4 pl-2">Tanggal</th>
                            <th class="pb-4">Keterangan Komoditas</th>
                            <th class="pb-4">Penanggung Jawab / Subjek</th>
                            <th class="pb-4 text-right pr-4">Nominal</th>
                            <th class="pb-4 text-center pr-2 no-print w-32">Tindakan Berkas</th>
                        </tr>
                    </thead>
                    <tbody class="text-[13.5px]">
                        @forelse($laporan as $t)
                        <tr class="hover:bg-[#FDFBF9] transition-all border-b border-[#F1ECE8]/60 group">
                            <td class="py-4 pl-2 text-[#5A6578] font-medium">
                                {{ date('d M Y', strtotime($t->tanggal)) }}
                            </td>
                            <td class="py-4 font-bold text-[#1A2130]">
                                {{ $t->keterangan }}
                            </td>
                            <td class="py-4 text-[#5A6578]">
                                {{ $t->user->name ?? 'Kas Umum (Internal Kelas)' }}
                            </td>
                            <td class="py-4 text-right pr-4">
                                <span class="font-bold {{ $t->jenis == 'Masuk' ? 'text-emerald-600' : 'text-rose-500' }} text-[14.5px]">
                                    {{ $t->jenis == 'Masuk' ? '+' : '-' }} Rp{{ number_format($t->nominal, 0, ',', '.') }}
                                </span>
                            </td>
                            <td class="py-4 text-center pr-2 no-print">
                                <div class="flex items-center justify-center gap-2">
                                    <a href="{{ route('bendahara.transaksi.edit', $t->id_transaksi) }}" class="w-8 h-8 rounded-lg bg-gray-50 text-gray-500 border border-gray-100 hover:text-[#E57C70] hover:bg-[#FAF4F2] hover:border-[#E57C70]/30 flex items-center justify-center transition-all shadow-sm" title="Ubah Data Log">
                                        <i class="bi bi-pencil-square text-xs"></i>
                                    </a>
                                    
                                    <form action="{{ route('bendahara.transaksi.destroy', $t->id_transaksi) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data rekap kas ini secara permanen?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="w-8 h-8 rounded-lg bg-gray-50 text-gray-400 border border-gray-100 hover:text-red-500 hover:bg-red-50 hover:border-red-200 flex items-center justify-center transition-all shadow-sm" title="Hapus Data Log">
                                            <i class="bi bi-trash3 text-xs"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center py-24">
                                <div class="text-gray-300 text-2xl mb-2"><i class="bi bi-folder-x"></i></div>
                                <p class="text-gray-400 text-xs italic font-medium">Arsip data log kosong untuk periode filter ini.</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </section>

        <div class="print-footer hidden justify-between mt-20 text-xs font-semibold text-black px-10">
            <div class="text-center">
                <p class="mb-20">Mengetahui,<br>Wali Kelas</p>
                <p class="border-b border-black w-40 mx-auto"></p>
                <p class="text-[10px] text-gray-500 mt-1">NIP. ....................................</p>
            </div>
            <div class="text-center">
                <p class="mb-20">Cirebon, {{ date('d F Y') }}<br>Bendahara Kelas</p>
                <p class="border-b border-black w-40 mx-auto"></p>
                <p class="text-[10px] text-gray-500 mt-1">Penanggung Jawab Kas</p>
            </div>
        </div>

    </main>

</body>
</html>