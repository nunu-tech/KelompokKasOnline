@extends('layouts.walikelas')

@section('content')
<div class="space-y-8 p-2">

    <!-- HEADER -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h1 class="text-3xl font-extrabold tracking-tight text-darkJet font-poppins">
                Pembayaran Kas
            </h1>
            <p class="text-sm text-gray-500 mt-1">
                Pantau, kelola, dan rekapitulasi data pembayaran kas siswa secara real-time.
            </p>
        </div>

        <a href="#"
            class="inline-flex items-center justify-center px-5 py-3 bg-luxuryGold text-darkJet rounded-xl font-semibold shadow-sm hover:bg-opacity-90 transform hover:-translate-y-0.5 transition-all duration-200">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            Tambah Pembayaran
        </a>
    </div>

    <!-- STATISTIK -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Card 1 -->
        <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm hover:shadow-md transition-shadow duration-300 relative overflow-hidden group">
            <div class="absolute right-0 top-0 w-24 h-24 bg-luxuryGold opacity-5 rounded-bl-full pointer-events-none transition-all duration-300 group-hover:scale-110"></div>
            <p class="text-xs font-bold tracking-wider uppercase text-gray-400">Total Kas Masuk</p>
            <h2 class="text-3xl font-black text-darkJet mt-2 tracking-tight">
                Rp {{ number_format($totalKas, 0, ',', '.') }}
            </h2>
        </div>
        
        <!-- Card 2 -->
        <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm hover:shadow-md transition-shadow duration-300 relative overflow-hidden group">
            <div class="absolute right-0 top-0 w-24 h-24 bg-green-500 opacity-5 rounded-bl-full pointer-events-none transition-all duration-300 group-hover:scale-110"></div>
            <p class="text-xs font-bold tracking-wider uppercase text-gray-400">Sudah Bayar</p>
            <h2 class="text-3xl font-black text-green-600 mt-2 tracking-tight flex items-baseline">
                {{ $sudahBayar }} <span class="text-sm font-medium text-gray-400 ml-2">Siswa</span>
            </h2>
        </div>

        <!-- Card 3 -->
        <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm hover:shadow-md transition-shadow duration-300 relative overflow-hidden group">
            <div class="absolute right-0 top-0 w-24 h-24 bg-red-500 opacity-5 rounded-bl-full pointer-events-none transition-all duration-300 group-hover:scale-110"></div>
            <p class="text-xs font-bold tracking-wider uppercase text-gray-400">Belum Bayar</p>
            <h2 class="text-3xl font-black text-red-500 mt-2 tracking-tight flex items-baseline">
                {{ $belumBayar }} <span class="text-sm font-medium text-gray-400 ml-2">Siswa</span>
            </h2>
        </div>
    </div>

    <!-- FILTER -->
    <form method="GET" class="bg-white p-4 rounded-2xl border border-gray-100 shadow-sm flex flex-col lg:flex-row gap-4 lg:items-center">
        <div class="relative flex-1">
            <span class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none text-gray-400">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
            </span>
            <input type="text"
                name="search"
                value="{{ request('search') }}"
                placeholder="Cari nama siswa..."
                class="w-full pl-10 pr-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:bg-white focus:ring-2 focus:ring-luxuryGold/20 focus:border-luxuryGold transition outline-none">
        </div>

        <div class="w-full lg:w-48">
            <select name="status" class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:bg-white focus:ring-2 focus:ring-luxuryGold/20 focus:border-luxuryGold transition outline-none appearance-none cursor-pointer">
                <option value="">Semua Status</option>
                <option value="lunas" {{ request('status') == 'lunas' ? 'selected' : '' }}>Sudah Bayar</option>
                <option value="belum" {{ request('status') == 'belum' ? 'selected' : '' }}>Belum Bayar</option>
            </select>
        </div>

        <button class="w-full lg:w-auto px-6 py-2.5 bg-darkJet text-white hover:bg-opacity-90 rounded-xl text-sm font-semibold shadow-sm transition-all duration-200">
            Terapkan Filter
        </button>
    </form>

    <!-- TABEL -->
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50/75 border-b border-gray-100 text-gray-500 font-semibold uppercase tracking-wider text-xs">
                        <th class="p-4 text-center w-16">No</th>
                        <th class="p-4">Nama Siswa</th>
                        <th class="p-4">Kelas</th>
                        <th class="p-4">Tanggal Bayar</th>
                        <th class="p-4">Jumlah</th>
                        <th class="p-4">Status</th>
                        <th class="p-4 text-center w-28">Aksi</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-100">
                    @forelse($kas as $item)
                    <tr class="hover:bg-gray-50/50 transition-colors duration-150">
                        <td class="p-4 text-center text-gray-500 font-medium">
                            {{ $kas->firstItem() + $loop->index }}
                        </td>
                        <td class="p-4 font-semibold text-darkJet">
                            {{ $item->siswa->nama ?? '-' }}
                        </td>
                        <td class="p-4 text-gray-600">
                            {{ $item->siswa->kelas ?? '-' }}
                        </td>
                        <td class="p-4 text-gray-500">
                            {{ $item->created_at ? $item->created_at->translatedFormat('d M Y') : '-' }}
                        </td>
                        <td class="p-4 font-bold text-darkJet">
                            Rp {{ number_format($item->jumlah, 0, ',', '.') }}
                        </td>
                        <td class="p-4">
                            @if($item->status == 'lunas')
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-green-50 text-green-700 border border-green-200/50">
                                <span class="w-1.5 h-1.5 rounded-full bg-green-500 mr-1.5"></span>
                                Sudah Bayar
                            </span>
                            @else
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-red-50 text-red-700 border border-red-200/50">
                                <span class="w-1.5 h-1.5 rounded-full bg-red-500 mr-1.5"></span>
                                Belum Bayar
                            </span>
                            @endif
                        </td>
                        <td class="p-4 text-center">
                            <a href="#" class="inline-flex items-center px-3 py-1.5 border border-gray-200 hover:border-darkJet text-gray-600 hover:text-darkJet rounded-lg font-medium text-xs transition duration-150">
                                Detail
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center py-12 px-4 text-gray-400">
                            <svg class="w-12 h-12 mx-auto text-gray-300 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                            </svg>
                            <p class="text-base font-medium text-gray-500">Tidak ada data pembayaran</p>
                            <p class="text-xs text-gray-400 mt-1">Coba sesuaikan kata kunci atau filter Anda</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        @if($kas->hasPages())
        <div class="p-4 border-t border-gray-100 bg-gray-50/50">
            {{ $kas->links() }}
        </div>
        @endif
    </div>

</div>
@endsection