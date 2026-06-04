<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi Setoran Kas</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: { 'brand-rose': '#E57C70', 'brand-slate': '#1A2130', 'brand-grey': '#5A6578' }
                }
            }
        }
    </script>
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #FDFBF9; color: #5A6578; }
        .glass-card { background: #FFFFFF; border: 1px solid #F1ECE8; border-radius: 24px; box-shadow: 0 16px 40px rgba(142, 127, 122, 0.04); }
        .sidebar-active { background: linear-gradient(135deg, #FAF4F2 0%, #F6E6E4 100%) !important; color: #E57C70 !important; font-weight: 700 !important; border: 1px solid rgba(229, 124, 112, 0.15) !important; }
    </style>
</head>
<body class="flex min-h-screen">

    <aside class="w-[290px] bg-white p-6 hidden lg:flex flex-col sticky top-0 h-screen justify-between border-r border-[#F1ECE8]">
        <div>
            <div class="flex items-center gap-3 mb-12 mt-2 px-2">
                <div class="w-[42px] h-[42px] rounded-2xl flex items-center justify-center bg-[#F6E6E4] text-[#E57C70] shadow-sm">
                    <i class="bi bi-intersect text-xl"></i>
                </div>
                <div>
                    <h1 class="text-xl font-black text-[#1A2130] tracking-tight">Class<span class="text-[#E57C70]">Ledger.</span></h1>
                    <p class="text-[8px] uppercase tracking-widest text-[#A0AEC0] font-extrabold mt-0.5">FINANCIAL ECOSYSTEM</p>
                </div>
            </div>

            <nav class="space-y-2 flex flex-col">
                <a href="{{ route('bendahara.index') }}" class="flex items-center py-3.5 px-5 text-[#5A6578] hover:text-[#E57C70] hover:bg-[#F6E6E4] rounded-2xl font-semibold text-[0.92rem] transition-all">
                    <i class="bi bi-columns-gap mr-3"></i> Dashboard
                </a>
                <a href="{{ route('bendahara.siswa') }}" class="flex items-center py-3.5 px-5 text-[#5A6578] hover:text-[#E57C70] hover:bg-[#F6E6E4] rounded-2xl font-semibold text-[0.92rem] transition-all">
                    <i class="bi bi-person-lines-fill mr-3"></i> Data Siswa
                </a>
                <a href="{{ route('bendahara.laporan') }}" class="flex items-center py-3.5 px-5 text-[#5A6578] hover:text-[#E57C70] hover:bg-[#F6E6E4] rounded-2xl font-semibold text-[0.92rem] transition-all">
                    <i class="bi bi-bar-chart-line mr-3"></i> Analytics & Laporan
                </a>
                <a href="{{ route('bendahara.verifikasi') }}" class="sidebar-active flex items-center py-3.5 px-5 rounded-2xl text-[0.92rem] transition-all">
                    <i class="bi bi-shield-check mr-3"></i> Verifikasi Kas
                </a>
            </nav>
        </div>

        <div class="p-4 rounded-2xl bg-[#FDFBF9] border border-[#F1ECE8]">
            <div class="flex items-center gap-3 mb-3">
                <img src="https://ui-avatars.com/api/?name=Bendahara+Kelas&background=F6E6E4&color=E57C70&bold=true" class="w-10 h-10 rounded-xl">
                <div class="overflow-hidden">
                    <p class="font-bold text-xs text-[#1A2130] truncate">Bendahara Kelas</p>
                    <p class="text-[11px] text-gray-400">Administrator Mode</p>
                </div>
            </div>
            <button class="text-[11px] w-full bg-white text-rose-600 border border-[#F1ECE8] rounded-xl py-2 font-bold transition-all hover:bg-rose-50 shadow-none">
                Logout Session
            </button>
        </div>
    </aside>

    <main class="flex-1 p-6 lg:p-14 overflow-y-auto w-full">
        <div class="mb-10">
            <h2 class="text-3xl font-extrabold text-[#1A2130] tracking-tight">Verifikasi Pembayaran</h2>
            <p class="text-[#5A6578] text-sm mt-1">Periksa dan setujui bukti transfer iuran kas yang dikirimkan oleh siswa.</p>
        </div>

        @if(session('sukses'))
            <div class="mb-6 p-4 bg-emerald-50 border border-emerald-200 text-emerald-700 rounded-2xl text-xs font-bold">
                {{ session('sukses') }}
            </div>
        @endif

        <section class="glass-card p-6 sm:p-8">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="text-[#A0AEC0] text-[10px] uppercase font-extrabold border-b border-[#F1ECE8] tracking-wider">
                            <th class="pb-4 pl-2">Siswa</th>
                            <th class="pb-4">Tanggal Setor</th>
                            <th class="pb-4">Keterangan</th>
                            <th class="pb-4">Nominal</th>
                            <th class="pb-4 text-center">Bukti</th>
                            <th class="pb-4 text-center w-48">Tindakan</th>
                        </tr>
                    </thead>
                    <tbody class="text-[13.5px]">
                        @forelse($antrean as $item)
                        <tr class="hover:bg-[#FDFBF9] border-b border-[#F1ECE8]/60">
                            <td class="py-4 pl-2 font-bold text-[#1A2130]">{{ $item->user->name ?? 'Siswa' }}</td>
                            <td class="py-4 text-[#5A6578]">{{ date('d M Y', strtotime($item->tanggal)) }}</td>
                            <td class="py-4 text-[#5A6578] italic">"{{ $item->keterangan }}"</td>
                            <td class="py-4 font-bold text-emerald-600">Rp{{ number_format($item->nominal, 0, ',', '.') }}</td>
                            <td class="py-4 text-center">
                                @if($item->bukti_transfer)
                                    <a href="{{ asset('storage/' . $item->bukti_transfer) }}" target="_blank" class="text-[#E57C70] hover:underline font-bold text-xs">
                                        <i class="bi bi-image mr-1"></i> Lihat Foto
                                    </a>
                                @else
                                    <span class="text-gray-400 text-xs italic">Tanpa Bukti</span>
                                @endif
                            </td>
                            <td class="py-4 text-center">
                                <div class="flex items-center justify-center gap-2">
                                    <form action="{{ route('bendahara.setujui', $item->id_transaksi) }}" method="POST">
                                        @csrf @method('PATCH')
                                        <button type="submit" class="bg-emerald-500 text-white px-3 py-1.5 rounded-xl text-xs font-bold hover:bg-emerald-600 transition-all">
                                            Setujui
                                        </button>
                                    </form>
                                    <form action="{{ route('bendahara.tolak', $item->id_transaksi) }}" method="POST">
                                        @csrf @method('PATCH')
                                        <button type="submit" class="bg-rose-50 text-rose-600 border border-rose-200 px-3 py-1.5 rounded-xl text-xs font-bold hover:bg-rose-100 transition-all">
                                            Tolak
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center py-20">
                                <div class="text-gray-300 text-2xl mb-2"><i class="bi bi-check2-circle"></i></div>
                                <p class="text-gray-400 text-xs italic">Semua antrean bersih. Tidak ada setoran kas yang tertunda!</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </section>
    </main>
</body>
</html>