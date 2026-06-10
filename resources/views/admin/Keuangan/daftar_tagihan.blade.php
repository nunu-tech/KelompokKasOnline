@extends('admin.app')

@section('title', 'Daftar Tagihan & Verifikasi')

@section('content')
<div class="p-6 sm:p-10 max-w-6xl mx-auto">
    
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-8 gap-4">
        <div>
            <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight mb-2">Verifikasi & Tagihan</h1>
            <p class="text-gray-500">Pantau status pembayaran iuran kas dan lakukan verifikasi (ACC) di sini.</p>
        </div>
        <a href="{{ route('admin.keuangan.tagihan') }}" class="inline-flex items-center px-5 py-2.5 bg-gray-900 hover:bg-indigo-600 text-white font-semibold rounded-xl shadow-md transition-all duration-200">
            + Buat Tagihan Baru
        </a>
    </div>

    @if(session('sukses'))
    <div class="bg-emerald-50 border border-emerald-200 text-emerald-800 px-6 py-4 rounded-2xl mb-8 flex items-center shadow-sm">
        <svg class="w-6 h-6 mr-3 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
        <div>
            <p class="font-bold text-sm">Berhasil di-ACC!</p>
            <p class="text-sm">{{ session('sukses') }}</p>
        </div>
    </div>
    @endif

    <div class="bg-white p-4 rounded-2xl shadow-sm border border-gray-100 mb-6">
        <form action="{{ route('admin.keuangan.daftarTagihan') }}" method="GET" class="flex flex-col sm:flex-row gap-4">
            
            <div class="flex-1">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama siswa..." class="w-full bg-gray-50 border border-gray-200 text-gray-700 rounded-xl px-4 py-2 focus:bg-white focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition">
            </div>

            <div class="w-full sm:w-48">
                <select name="status" class="w-full bg-gray-50 border border-gray-200 text-gray-700 rounded-xl px-4 py-2 focus:bg-white focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition">
                    <option value="">Semua Status</option>
                    <option value="Belum Bayar" {{ request('status') == 'Belum Bayar' ? 'selected' : '' }}>Belum Bayar</option>
                    <option value="Lunas" {{ request('status') == 'Lunas' ? 'selected' : '' }}>Lunas</option>
                </select>
            </div>

            <div class="flex items-center gap-2">
                <button type="submit" class="px-6 py-2 bg-indigo-50 text-indigo-700 hover:bg-indigo-100 font-bold rounded-xl transition-colors">
                    Terapkan
                </button>
                @if(request('search') || request('status'))
                    <a href="{{ route('admin.keuangan.daftarTagihan') }}" class="px-4 py-2 text-gray-400 hover:text-rose-600 font-semibold rounded-xl transition-colors">
                        Reset
                    </a>
                @endif
            </div>
        </form>
    </div>

    <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead class="bg-gray-50 border-b border-gray-100">
                    <tr>
                        <th class="py-4 px-6 text-gray-500 font-bold text-sm tracking-wider">Siswa / Kelas</th>
                        <th class="py-4 px-6 text-gray-500 font-bold text-sm tracking-wider">Keterangan Tagihan</th>
                        <th class="py-4 px-6 text-gray-500 font-bold text-sm tracking-wider">Nominal</th>
                        <th class="py-4 px-6 text-gray-500 font-bold text-sm tracking-wider">Jatuh Tempo</th>
                        <th class="py-4 px-6 text-gray-500 font-bold text-sm tracking-wider text-center">Status</th>
                        <th class="py-4 px-6 text-gray-500 font-bold text-sm tracking-wider text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse($semua_tagihan as $tagihan)
                    <tr class="hover:bg-gray-50/50 transition">
                        <td class="py-4 px-6">
                            <div class="font-bold text-gray-800">{{ $tagihan->user->nama_lengkap ?? 'Siswa Dihapus' }}</div>
                            <div class="text-xs text-gray-400 mt-0.5">Kelas: {{ $tagihan->user->kelas->nama_kelas ?? '-' }}</div>
                        </td>
                        
                        <td class="py-4 px-6 text-sm text-gray-600 font-medium">
                            {{ $tagihan->keterangan }}
                        </td>
                        
                        <td class="py-4 px-6 text-sm font-bold text-gray-900">
                            Rp {{ number_format($tagihan->nominal, 0, ',', '.') }}
                        </td>
                        
                        <td class="py-4 px-6 text-sm text-gray-500 font-medium">
                            {{ \Carbon\Carbon::parse($tagihan->jatuh_tempo)->translatedFormat('d M Y') }}
                        </td>
                        
                        <td class="py-4 px-6 text-center">
                            @if($tagihan->status === 'Belum Bayar')
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-amber-50 text-amber-600 border border-amber-200">
                                    Belum Bayar
                                </span>
                            @else
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-emerald-50 text-emerald-600 border border-emerald-200">
                                    Lunas
                                </span>
                            @endif
                        </td>
                        
                        <td class="py-4 px-6 text-right">
                            @if($tagihan->status === 'Belum Bayar')
                                <form action="{{ route('admin.keuangan.accTagihan', $tagihan->id_tagihan) }}" method="POST" class="inline-block" onsubmit="return confirm('Apakah kamu yakin siswa ini sudah membayar tunai dan ingin meng-ACC tagihan ini?');">
                                    @csrf
                                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-xs font-bold rounded-xl shadow-md transition duration-150">
                                        ACC Pembayaran
                                    </button>
                                </form>
                            @else
                                <span class="text-xs font-semibold text-gray-400 italic">Sudah Diverifikasi</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="py-12 text-center">
                            <div class="text-gray-300 mb-2">
                                <svg class="w-12 h-12 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path></svg>
                            </div>
                            <p class="text-gray-400 font-medium text-sm">Belum ada riwayat tagihan kas yang dibuat.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="px-6 py-4 border-t border-gray-100 bg-gray-50/50">
            {{ $semua_tagihan->links() }}
        </div>
    </div>
</div>
@endsection