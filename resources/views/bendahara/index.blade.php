<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bendahara Dashboard - Kas</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #FDF8F7;
            color: #1A1A1A;
        }

        /* Glassmorphism Effect */
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

        .btn-gradient {
            background: linear-gradient(135deg, #E88D82 0%, #D67A6F 100%);
            transition: all 0.3s;
        }

        .btn-gradient:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 15px rgba(232, 141, 130, 0.3);
        }

        /* Custom Scrollbar */
        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-track { background: #FDF8F7; }
        ::-webkit-scrollbar-thumb { background: #E88D82; border-radius: 10px; }
    </style>
</head>

<body class="flex min-h-screen">

    <aside class="w-80 bg-white/60 p-8 hidden lg:flex flex-col border-r border-pink-50 sticky top-0 h-screen">
        <div class="mb-12 px-4">
            <h1 class="text-3xl font-extrabold text-[#E88D82] italic tracking-tighter">
                Kas
            </h1>
            <p class="text-[10px] uppercase tracking-[0.2em] text-gray-400 font-bold mt-1">Management System</p>
        </div>

        <nav class="flex-1 space-y-2">
            <a href="{{ route('bendahara.index') }}" class="sidebar-active flex items-center gap-4 py-4 px-6 rounded-2xl font-bold transition-all">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/></svg>
                Dashboard
            </a>
            
            <a href="{{ route('bendahara.siswa') }}" class="flex items-center gap-4 py-4 px-6 text-gray-400 hover:text-[#E88D82] hover:bg-pink-50 rounded-2xl font-bold transition-all">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                Data Siswa
            </a>
            
            <a href="{{ route('bendahara.laporan') }}" class="flex items-center gap-4 py-4 px-6 text-gray-400 hover:text-[#E88D82] hover:bg-pink-50 rounded-2xl font-bold transition-all">
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
                <h2 class="text-3xl font-bold text-gray-800 italic">Financial Overview</h2>
                <p class="text-gray-400 text-sm">Selamat datang kembali di dashboard bendahara.</p>
            </div>
            <div class="flex items-center gap-3 bg-white p-2 rounded-2xl shadow-sm border border-gray-50">
                <div class="w-10 h-10 bg-pink-100 rounded-xl flex items-center justify-center text-[#E88D82]">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                </div>
                <div class="pr-4">
                    <p class="text-[10px] font-bold text-gray-400 uppercase tracking-wider">Tanggal Hari Ini</p>
                    <p class="text-xs font-bold text-gray-700">{{ date('d M Y') }}</p>
                </div>
            </div>
        </div>

        @if(session('sukses'))
            <div class="mb-8 p-4 bg-teal-50 border border-teal-100 text-teal-600 rounded-2xl flex items-center gap-3 animate-bounce">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                <span class="font-bold text-sm">{{ session('sukses') }}</span>
            </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            <div class="lg:col-span-2 space-y-8">
                <div class="glass-card p-10 relative overflow-hidden group">
                    <div class="absolute top-0 right-0 p-8 opacity-10 group-hover:scale-110 transition-transform">
                        <svg class="w-32 h-32 text-[#E88D82]" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 14h-2v-2h2v2zm0-4h-2V7h2v5z"/></svg>
                    </div>
                    <p class="text-gray-400 font-bold text-xs uppercase tracking-[0.2em] mb-2">Current Balance</p>
                    <h2 class="text-5xl font-black text-gray-800 tracking-tighter">
                        <span class="text-[#E88D82] text-2xl mr-1 font-bold">Rp</span>{{ number_format($saldo_akhir, 0, ',', '.') }}
                    </h2>
                    <div class="mt-6 flex gap-2">
                        <span class="px-3 py-1 bg-teal-50 text-teal-500 rounded-full text-[10px] font-bold uppercase tracking-widest">Safe Budget</span>
                    </div>
                </div>

                <div class="glass-card p-8">
                    <div class="flex items-center gap-3 mb-8">
                        <div class="w-2 h-8 bg-[#E88D82] rounded-full"></div>
                        <h3 class="font-bold text-xl text-gray-800 italic">Quick Transaction</h3>
                    </div>

                    <form action="{{ route('bendahara.store') }}" method="POST" class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        @csrf
                        <div class="space-y-2">
                            <label class="text-[10px] font-bold text-gray-400 uppercase ml-2">Pilih Anggota</label>
                            <select name="id_user" class="input-field w-full p-4 rounded-2xl text-sm font-semibold text-gray-700">
                                <option value="">-- Pengeluaran Umum --</option>
                                @foreach($daftar_siswa as $siswa)
                                    <option value="{{ $siswa->id_user }}">{{ $siswa->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="space-y-2">
                            <label class="text-[10px] font-bold text-gray-400 uppercase ml-2">Nominal</label>
                            <input type="number" name="nominal" placeholder="Ex: 50000" class="input-field w-full p-4 rounded-2xl text-sm font-semibold" required>
                        </div>

                        <div class="space-y-2">
                            <label class="text-[10px] font-bold text-gray-400 uppercase ml-2">Jenis Kas</label>
                            <select name="jenis" class="input-field w-full p-4 rounded-2xl text-sm font-semibold">
                                <option value="Masuk">Pemasukan (Income)</option>
                                <option value="Keluar">Pengeluaran (Expense)</option>
                            </select>
                        </div>

                        <div class="space-y-2">
                            <label class="text-[10px] font-bold text-gray-400 uppercase ml-2">Tanggal</label>
                            <input type="date" name="tanggal" value="{{ date('Y-m-d') }}" class="input-field w-full p-4 rounded-2xl text-sm font-semibold" required>
                        </div>

                        <div class="sm:col-span-2 space-y-2">
                            <label class="text-[10px] font-bold text-gray-400 uppercase ml-2">Catatan Tambahan</label>
                            <input type="text" name="keterangan" placeholder="Misal: Bayar Kas Bulan Mei" class="input-field w-full p-4 rounded-2xl text-sm font-semibold" required>
                        </div>

                        <button type="submit" class="sm:col-span-2 btn-gradient p-5 rounded-2xl font-bold uppercase text-xs tracking-widest text-white">
                            Simpan Data Transaksi
                        </button>
                    </form>
                </div>
            </div>

            <div class="lg:col-span-1">
                <div class="glass-card p-8 h-full">
                    <div class="flex justify-between items-center mb-8">
                        <h3 class="font-bold text-xl text-gray-800 italic">History</h3>
                        <a href="{{ route('bendahara.laporan') }}" class="text-[10px] font-bold text-[#E88D82] uppercase hover:underline">See All</a>
                    </div>

                    <div class="space-y-6">
                        @foreach($semua_transaksi->take(6) as $item)
                        <div class="flex items-center justify-between group">
                            <div class="flex items-center gap-4">
                                <div class="w-12 h-12 rounded-2xl bg-gray-50 flex items-center justify-center border border-gray-100 group-hover:scale-110 transition-transform">
                                    @if($item->jenis == 'Masuk')
                                        <svg class="w-6 h-6 text-teal-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                                    @else
                                        <svg class="w-6 h-6 text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"/></svg>
                                    @endif
                                </div>
                                <div>
                                    <p class="text-sm font-bold text-gray-800 tracking-tight">{{ $item->user ? $item->user->name : 'Umum' }}</p>
                                    <p class="text-[10px] text-gray-400 font-medium">{{ $item->keterangan }}</p>
                                </div>
                            </div>
                            <div class="text-right">
                                <p class="text-sm font-black {{ $item->jenis == 'Masuk' ? 'text-teal-500' : 'text-orange-500' }}">
                                    {{ $item->jenis == 'Masuk' ? '+' : '-' }} {{ number_format($item->nominal, 0, ',', '.') }}
                                </p>
                                <p class="text-[9px] text-gray-300 font-bold uppercase">{{ date('d M', strtotime($item->tanggal)) }}</p>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    @if($semua_transaksi->isEmpty())
                        <div class="text-center py-20">
                            <p class="text-gray-300 text-sm italic">Belum ada transaksi</p>
                        </div>
                    @endif
                </div>
            </div>

        </div>
    </main>

</body>
</html>