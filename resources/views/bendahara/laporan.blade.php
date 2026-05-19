<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Keuangan - Kas Management</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #FDF8F7;
            color: #1A1A1A;
        }

        .glass-card {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(10px);
            border-radius: 32px;
            border: 1px solid rgba(255, 255, 255, 0.4);
            box-shadow: 0 20px 40px rgba(232, 141, 130, 0.05);
        }

        .sidebar-active {
            background: #E88D82;
            color: white !important;
            box-shadow: 0 10px 20px rgba(232, 141, 130, 0.2);
        }

        .input-field {
            background: #F9FAFB;
            border: 1.5px solid transparent;
            transition: all 0.3s;
        }

        .input-field:focus {
            background: white;
            border-color: #E88D82;
            box-shadow: 0 0 0 4px rgba(232, 141, 130, 0.1);
            outline: none;
        }

        /* Utility untuk cetak agar tidak berantakan */
        @media print {
            .no-print { display: none !important; }
            body { background: white; }
            .glass-card { box-shadow: none; border: 1px solid #eee; backdrop-filter: none; }
            main { padding: 0 !important; }
        }

        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-track { background: #FDF8F7; }
        ::-webkit-scrollbar-thumb { background: #E88D82; border-radius: 10px; }
    </style>
</head>

<body class="flex min-h-screen">

    <aside class="no-print w-80 bg-white/60 p-8 hidden lg:flex flex-col border-r border-pink-50 sticky top-0 h-screen">
        <div class="mb-12 px-4">
            <h1 class="text-3xl font-extrabold text-[#E88D82] italic tracking-tighter">Kas</h1>
            <p class="text-[10px] uppercase tracking-[0.2em] text-gray-400 font-bold mt-1">Management System</p>
        </div>

        <nav class="flex-1 space-y-2">
            <a href="{{ route('bendahara.index') }}" class="flex items-center gap-4 py-4 px-6 text-gray-400 hover:text-[#E88D82] hover:bg-pink-50 rounded-2xl font-bold transition-all">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/></svg>
                Dashboard
            </a>
            <a href="{{ route('bendahara.siswa') }}" class="flex items-center gap-4 py-4 px-6 text-gray-400 hover:text-[#E88D82] hover:bg-pink-50 rounded-2xl font-bold transition-all">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                Data Siswa
            </a>
            <a href="{{ route('bendahara.laporan') }}" class="sidebar-active flex items-center gap-4 py-4 px-6 rounded-2xl font-bold transition-all">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                Laporan
            </a>
        </nav>

        <div class="bg-gradient-to-br from-pink-50 to-white rounded-[2rem] p-6 border border-pink-100">
            <div class="flex items-center gap-3 mb-4">
                <img src="https://ui-avatars.com/api/?name=Bendahara&background=E88D82&color=fff" class="w-10 h-10 rounded-xl shadow-md">
                <div>
                    <p class="text-xs font-bold text-gray-800">Bendahara</p>
                    <p class="text-[10px] text-gray-400">Online</p>
                </div>
            </div>
            <button class="w-full bg-white text-[#E88D82] border border-pink-100 py-3 rounded-xl text-xs font-bold hover:bg-red-50 hover:text-red-500 transition-all">
                Logout
            </button>
        </div>
    </aside>

    <main class="flex-1 p-6 lg:p-12 overflow-y-auto">
        
        <div class="flex flex-col md:flex-row md:items-center justify-between mb-10 gap-4">
            <div>
                <h2 class="text-3xl font-bold text-gray-800 italic">Financial Report</h2>
                <p class="text-gray-400 text-sm">Rekapitulasi riwayat transaksi masuk dan keluar.</p>
            </div>
            <div class="no-print flex items-center gap-3">
                 <button onclick="window.print()" class="flex items-center gap-2 bg-[#E88D82] text-white px-6 py-4 rounded-2xl font-bold text-xs hover:bg-[#d67d72] transition-all shadow-lg shadow-pink-100">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/></svg>
                    CETAK LAPORAN
                </button>
            </div>
        </div>

        <section class="no-print glass-card p-8 mb-10 border-t-8 border-pink-200">
            <form action="{{ route('bendahara.laporan') }}" method="GET" class="flex flex-col md:flex-row items-end gap-6">
                <div class="w-full md:w-1/3">
                    <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-3 block">Pilih Bulan</label>
                    <select name="bulan" class="input-field w-full p-4 rounded-2xl text-xs font-bold">
                        @foreach(range(1, 12) as $m)
                            <option value="{{ sprintf('%02d', $m) }}" {{ $bulan == $m ? 'selected' : '' }}>
                                {{ date('F', mktime(0, 0, 0, $m, 1)) }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="w-full md:w-1/3">
                    <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-3 block">Pilih Tahun</label>
                    <select name="tahun" class="input-field w-full p-4 rounded-2xl text-xs font-bold">
                        @foreach(range(date('Y')-2, date('Y')) as $y)
                            <option value="{{ $y }}" {{ $tahun == $y ? 'selected' : '' }}>{{ $y }}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="w-full md:w-auto bg-gray-800 text-white px-10 py-4 rounded-2xl font-bold text-xs hover:bg-black transition-all">
                    FILTER DATA
                </button>
            </form>
        </section>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-10">
            <div class="glass-card p-8 border-l-8 border-teal-400">
                <p class="text-gray-400 font-bold text-[10px] uppercase tracking-widest mb-1">Pemasukan Periode Ini</p>
                <h3 class="text-xl font-bold text-teal-500 italic tracking-tighter">
                    Rp {{ number_format($total_masuk, 0, ',', '.') }}
                </h3>
            </div>
            <div class="glass-card p-8 border-l-8 border-red-400">
                <p class="text-gray-400 font-bold text-[10px] uppercase tracking-widest mb-1">Pengeluaran Periode Ini</p>
                <h3 class="text-xl font-bold text-red-500 italic tracking-tighter">
                    Rp {{ number_format($total_keluar, 0, ',', '.') }}
                </h3>
            </div>
            <div class="glass-card p-8 border-l-8 border-[#E88D82]">
                <p class="text-gray-400 font-bold text-[10px] uppercase tracking-widest mb-1">Saldo Bersih Periode</p>
                <h3 class="text-xl font-bold text-[#E88D82] italic tracking-tighter">
                    Rp {{ number_format($saldo_periode, 0, ',', '.') }}
                </h3>
            </div>
        </div>

        <section class="glass-card p-10">
            <div class="flex items-center gap-3 mb-10">
                <div class="w-2 h-8 bg-[#E88D82] rounded-full"></div>
                <h3 class="font-bold text-xl text-gray-800 italic">Riwayat Transaksi: {{ date('F', mktime(0, 0, 0, $bulan, 1)) }} {{ $tahun }}</h3>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead>
                        <tr class="text-gray-400 text-[10px] uppercase font-bold border-b border-gray-50 tracking-[0.15em]">
                            <th class="pb-6 pl-4">Tanggal</th>
                            <th class="pb-6">Keterangan</th>
                            <th class="pb-6">Oleh/Anggota</th>
                            <th class="pb-6 text-right pr-6">Nominal</th>
                        </tr>
                    </thead>
                    <tbody class="text-sm">
                        @forelse($laporan as $t)
                        <tr class="hover:bg-pink-50/30 transition-all border-b border-gray-50/50 group">
                            <td class="py-5 pl-4 text-gray-400 font-medium">
                                {{ date('d M Y', strtotime($t->tanggal)) }}
                            </td>
                            <td class="py-5 font-bold text-gray-700 italic uppercase tracking-tighter">
                                {{ $t->keterangan }}
                            </td>
                            <td class="py-5 text-gray-500">
                                {{ $t->user->name ?? 'Kas Umum' }}
                            </td>
                            <td class="py-5 text-right pr-6">
                                <p class="font-black {{ $t->jenis == 'Masuk' ? 'text-teal-500' : 'text-red-400' }} text-base tracking-tighter">
                                    {{ $t->jenis == 'Masuk' ? '+' : '-' }} Rp {{ number_format($t->nominal, 0, ',', '.') }}
                                </p>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center py-20">
                                <p class="text-gray-300 text-sm italic">Tidak ada transaksi pada periode ini...</p>
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