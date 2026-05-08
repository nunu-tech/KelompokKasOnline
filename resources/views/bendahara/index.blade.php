bendahara <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bendahara Dashboard - Kas.</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #FDF8F7; }
        .glass-card { background: white; border-radius: 28px; border: 1px solid rgba(255, 255, 255, 0.7); box-shadow: 0 10px 30px rgba(0,0,0,0.02); }
        .sidebar-active { background: #FDE7E4; color: #E88D82; border-radius: 16px; }
        .btn-pink { background: #E88D82; color: white; transition: all 0.3s; }
        .btn-pink:hover { background: #d67a6f; transform: translateY(-2px); box-shadow: 0 5px 15px rgba(232, 141, 130, 0.3); }
        .badge-lunas { background: #E0F9F4; color: #4FD1C5; }
        .badge-tertunda { background: #FFF5F0; color: #FFB08E; }
    </style>
</head>
<body class="flex min-h-screen">

   

    <main class="flex-1 p-6 lg:p-12">
        @if(session('sukses'))
        <div class="mb-6 p-4 bg-green-100 text-green-700 rounded-2xl border border-green-200 animate-pulse">
            {{ session('sukses') }}
        </div>
        @endif

        <header class="flex justify-between items-center mb-12">
            <div>
                <h1 class="text-3xl font-bold text-gray-800 italic">Dashboard Kas</h1>
                <p class="text-gray-400 mt-1">Sistem Manajemen Keuangan Digital</p>
            </div>
            <div class="flex items-center gap-6 bg-white p-2 pr-6 rounded-full shadow-sm">
                <div class="text-right hidden sm:block">
                    <p class="text-sm font-bold text-gray-800 italic uppercase">Bendahara</p>
                </div>
                <img src="https://ui-avatars.com/api/?name=Bendahara&background=FDE7E4&color=E88D82" class="w-12 h-12 rounded-full border-2 border-white shadow-md" alt="User">
            </div>
        </header>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-12">
            <div class="glass-card p-8 relative overflow-hidden bg-gradient-to-br from-white to-pink-50">
                <p class="text-gray-400 font-bold text-sm mb-4">Total Saldo</p>
                <h2 class="text-4xl font-bold text-gray-800 tracking-tight">Rp {{ number_format($saldo_akhir, 0, ',', '.') }}</h2>
                <div class="mt-8">
                    <svg viewBox="0 0 100 30" class="w-full h-12 text-teal-400 fill-none stroke-current stroke-2">
                        <path d="M0 25C20 25 30 5 50 15C70 25 80 5 100 10" stroke-linecap="round"/>
                    </svg>
                </div>
            </div>

            <div class="glass-card p-8 lg:col-span-2">
                <h3 class="font-bold text-gray-800 mb-6 italic">Input Transaksi Baru</h3>
                <form action="{{ route('bendahara.store') }}" method="POST" class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    @csrf
                    <div class="space-y-1">
                        <label class="text-[10px] font-bold text-gray-400 uppercase ml-2">Pilih Siswa</label>
                        <select name="id_user" class="w-full p-4 bg-gray-50 rounded-2xl outline-none border-none focus:ring-2 focus:ring-pink-100 transition">
                            <option value="">-- Pengeluaran Umum --</option>
                            @foreach($daftar_siswa as $siswa)
                                <option value="{{ $siswa->id_user }}">{{ $siswa->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="space-y-1">
                        <label class="text-[10px] font-bold text-gray-400 uppercase ml-2">Nominal Rp</label>
                        <input type="number" name="nominal" placeholder="5.000" class="w-full p-4 bg-gray-50 rounded-2xl outline-none border-none focus:ring-2 focus:ring-pink-100" required>
                    </div>
                    <div class="space-y-1">
                        <label class="text-[10px] font-bold text-gray-400 uppercase ml-2">Kategori</label>
                        <select name="jenis" class="w-full p-4 bg-gray-50 rounded-2xl outline-none border-none focus:ring-2 focus:ring-pink-100">
                            <option value="Masuk">Uang Masuk</option>
                            <option value="Keluar">Uang Keluar</option>
                        </select>
                    </div>
                    <div class="space-y-1">
                        <label class="text-[10px] font-bold text-gray-400 uppercase ml-2">Keterangan & Tanggal</label>
                        <div class="flex gap-2">
                            <input type="text" name="keterangan" placeholder="Bayar Kas" class="w-2/3 p-4 bg-gray-50 rounded-2xl outline-none border-none focus:ring-2 focus:ring-pink-100" required>
                            <input type="date" name="tanggal" value="{{ date('Y-m-d') }}" class="w-1/3 p-4 bg-gray-50 rounded-2xl outline-none border-none text-xs" required>
                        </div>
                    </div>
                    <button type="submit" class="sm:col-span-2 btn-pink p-4 rounded-2xl font-bold text-sm tracking-widest uppercase mt-2">Simpan Transaksi</button>
                </form>
            </div>
        </div>

        <section class="glass-card p-8 overflow-x-auto">
            <div class="flex justify-between items-center mb-8">
                <h3 class="text-xl font-bold text-gray-800 italic">Transaksi Terkini</h3>
                <div class="bg-gray-50 px-6 py-2 rounded-full border border-gray-100 flex items-center gap-2">
                    <span class="text-xs text-gray-300 italic">Daftar semua riwayat kas</span>
                </div>
            </div>

            <table class="w-full text-left">
                <thead>
                    <tr class="text-gray-400 text-[12px] border-b border-gray-50">
                        <th class="pb-6 font-medium pl-4">NAMA SISWA</th>
                        <th class="pb-6 font-medium">KETERANGAN</th>
                        <th class="pb-6 font-medium">STATUS</th>
                        <th class="pb-6 font-medium">TANGGAL</th>
                        <th class="pb-6 font-medium">JUMLAH</th>
                        <th class="pb-6 text-right pr-4 font-medium">AKSI</th>
                    </tr>
                </thead>
                <tbody class="text-sm">
                    @foreach($semua_transaksi as $item)
                    <tr class="group hover:bg-gray-50/50 transition-colors">
                        <td class="py-6 border-b border-gray-50/50 pl-4">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-full bg-gray-200 flex items-center justify-center overflow-hidden shadow-sm">
                                    <img src="https://ui-avatars.com/api/?name={{ $item->user ? $item->user->name : 'Umum' }}&background=E88D82&color=fff" alt="">
                                </div>
                                <p class="font-bold text-gray-700 capitalize">{{ $item->user ? $item->user->name : 'Umum' }}</p>
                            </div>
                        </td>
                        <td class="py-6 border-b border-gray-50/50 text-gray-400 italic">
                            {{ $item->keterangan }}
                        </td>
                        <td class="py-6 border-b border-gray-50/50">
                            <span class="px-4 py-1 rounded-full text-[10px] font-bold uppercase {{ $item->jenis == 'Masuk' ? 'badge-lunas' : 'badge-tertunda' }}">
                                {{ $item->jenis == 'Masuk' ? 'Masuk' : 'Keluar' }}
                            </span>
                        </td>
                        <td class="py-6 border-b border-gray-50/50 text-gray-400">
                            {{ date('d M Y', strtotime($item->tanggal)) }}
                        </td>
                        <td class="py-6 border-b border-gray-50/50 font-bold text-gray-800">
                            {{ number_format($item->nominal, 0, ',', '.') }}
                        </td>
                        <td class="py-6 border-b border-gray-50/50 text-right pr-4">
                            <div class="flex justify-end gap-3">
                                <a href="{{ route('bendahara.show', $item->id_transaksi) }}" class="bg-gray-100 text-gray-500 px-4 py-1 rounded-lg text-[10px] font-bold hover:bg-pink-100 hover:text-[#E88D82] transition shadow-sm uppercase">Detail</a>
                                
                                <form action="{{ route('bendahara.destroy', $item->id_transaksi) }}" method="POST" onsubmit="return confirm('Hapus data transaksi ini?')">
                                    @csrf 
                                    @method('DELETE')
                                    <button type="submit" class="w-6 h-6 flex items-center justify-center text-gray-300 hover:text-red-500 transition-colors">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </section>
    </main>
</body>
</html>