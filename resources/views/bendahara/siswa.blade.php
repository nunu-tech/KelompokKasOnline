<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Siswa - Kas Management</title>
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

        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-track { background: #FDF8F7; }
        ::-webkit-scrollbar-thumb { background: #E88D82; border-radius: 10px; }
    </style>
</head>

<body class="flex min-h-screen">

    <aside class="w-80 bg-white/60 p-8 hidden lg:flex flex-col border-r border-pink-50 sticky top-0 h-screen">
        <div class="mb-12 px-4">
            <h1 class="text-3xl font-extrabold text-[#E88D82] italic tracking-tighter">Kas</h1>
            <p class="text-[10px] uppercase tracking-[0.2em] text-gray-400 font-bold mt-1">Management System</p>
        </div>

        <nav class="flex-1 space-y-2">
            <a href="{{ route('bendahara.index') }}" class="flex items-center gap-4 py-4 px-6 text-gray-400 hover:text-[#E88D82] hover:bg-pink-50 rounded-2xl font-bold transition-all">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/></svg>
                Dashboard
            </a>
            
            <a href="{{ route('bendahara.siswa') }}" class="sidebar-active flex items-center gap-4 py-4 px-6 rounded-2xl font-bold transition-all">
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
                <h2 class="text-3xl font-bold text-gray-800 italic">Student Directory</h2>
                <p class="text-gray-400 text-sm">Manajemen daftar anggota dan akumulasi iuran kelas.</p>
            </div>
            <div class="flex items-center gap-3 bg-white p-2 rounded-2xl shadow-sm border border-gray-50">
                <div class="w-10 h-10 bg-pink-100 rounded-xl flex items-center justify-center text-[#E88D82]">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                </div>
                <div class="pr-4">
                    <p class="text-[10px] font-bold text-gray-400 uppercase tracking-wider">Total Anggota</p>
                    <p class="text-xs font-bold text-gray-700">{{ count($daftar_siswa) }} Siswa</p>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-10">
            <div class="glass-card p-8 border-l-8 border-teal-400">
                <p class="text-gray-400 font-bold text-[10px] uppercase tracking-widest mb-1">Siswa Terajin</p>
                <h3 class="text-xl font-bold text-gray-800 italic uppercase tracking-tighter">
                    {{ $siswa_terajin->name ?? 'Belum ada data' }}
                </h3>
            </div>
            <div class="glass-card p-8 border-l-8 border-orange-400">
                <p class="text-gray-400 font-bold text-[10px] uppercase tracking-widest mb-1">Status Keaktifan</p>
                <h3 class="text-xl font-bold text-gray-800 italic uppercase tracking-tighter">
                    100% Berpartisipasi
                </h3>
            </div>
            <div class="glass-card p-8 border-l-8 border-[#E88D82]">
                <p class="text-gray-400 font-bold text-[10px] uppercase tracking-widest mb-1">Rata-rata Iuran</p>
                <h3 class="text-xl font-bold text-gray-800 italic uppercase tracking-tighter">
                    Rp {{ number_format($daftar_siswa->avg('total_bayar'), 0, ',', '.') }}
                </h3>
            </div>
        </div>

        <section class="glass-card p-10">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-10 gap-4">
                <div class="flex items-center gap-3">
                    <div class="w-2 h-8 bg-[#E88D82] rounded-full"></div>
                    <h3 class="font-bold text-xl text-gray-800 italic">Daftar Anggota Kelas</h3>
                </div>
                
                <div class="relative w-full md:w-80 flex items-center">
                    <div class="absolute left-5 flex items-center justify-center text-gray-300">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                    </div>
                    <input type="text" id="searchSiswa" placeholder="Cari nama anggota..." 
                        class="input-field w-full pl-14 pr-4 py-4 rounded-2xl text-xs font-bold outline-none transition-all">
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left" id="siswaTable">
                    <thead>
                        <tr class="text-gray-400 text-[10px] uppercase font-bold border-b border-gray-50 tracking-[0.15em]">
                            <th class="pb-6 pl-4">Profil</th>
                            <th class="pb-6">Nama Lengkap</th>
                            <th class="pb-6 text-center">Status</th>
                            <th class="pb-6 text-right pr-6">Akumulasi Iuran</th>
                        </tr>
                    </thead>
                    <tbody class="text-sm">
                        @foreach($daftar_siswa as $siswa)
                        <tr class="hover:bg-pink-50/30 transition-all border-b border-gray-50/50 group">
                            <td class="py-5 pl-4">
                                <img src="https://ui-avatars.com/api/?name={{ urlencode($siswa->name) }}&background=FDE7E4&color=E88D82" class="w-12 h-12 rounded-2xl shadow-sm border-2 border-white group-hover:scale-110 transition-transform">
                            </td>
                            <td class="nama-siswa py-5 font-bold text-gray-700 italic uppercase tracking-tighter">
                                {{ $siswa->name }}
                            </td>
                            <td class="py-5 text-center">
                                <span class="px-3 py-1 bg-teal-50 text-teal-500 rounded-full text-[9px] font-black uppercase tracking-widest">
                                    Aktif
                                </span>
                            </td>
                            <td class="py-5 text-right pr-6">
                                <p class="font-black text-[#E88D82] text-base tracking-tighter">
                                    Rp {{ number_format($siswa->total_bayar ?? 0, 0, ',', '.') }}
                                </p>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            @if($daftar_siswa->isEmpty())
                <div class="text-center py-20">
                    <p class="text-gray-300 text-sm italic">Data siswa tidak ditemukan...</p>
                </div>
            @endif
        </section>
    </main>

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