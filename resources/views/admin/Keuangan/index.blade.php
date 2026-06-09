@extends('admin.app')

@section('content')
<div class="p-6">
    <h1 class="text-2xl font-bold text-gray-800 mb-6">Keuangan Kelas</h1>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        
        <div class="bg-indigo-600 p-6 rounded-2xl text-white shadow-md">
            <p class="text-indigo-200 text-sm font-semibold">Saldo Akhir Saat Ini</p>
            <h2 class="text-3xl font-bold mt-2">Rp {{ number_format($saldo_akhir, 0, ',', '.') }}</h2>
        </div>

        <div class="bg-emerald-500 p-6 rounded-2xl text-white shadow-md">
            <p class="text-emerald-100 text-sm font-semibold">Total Uang Masuk</p>
            <h2 class="text-3xl font-bold mt-2">+ Rp {{ number_format($total_masuk, 0, ',', '.') }}</h2>
        </div>

        <div class="bg-rose-500 p-6 rounded-2xl text-white shadow-md">
            <p class="text-rose-100 text-sm font-semibold">Total Pengeluaran</p>
            <h2 class="text-3xl font-bold mt-2">- Rp {{ number_format($total_keluar, 0, ',', '.') }}</h2>
        </div>

    </div>

    <div class="mb-8 bg-white p-4 rounded-xl shadow-sm border border-gray-100 flex items-center justify-between">
        <p class="text-gray-600 font-medium">Tampilkan data keuangan untuk kelas:</p>
        
        <form action="{{ route('admin.keuangan.index') }}" method="GET" class="flex items-center space-x-3">
            <select name="kelas" class="border border-gray-300 text-gray-700 rounded-lg px-4 py-2 focus:ring focus:ring-indigo-200 focus:outline-none">
                <option value="">-- Semua Kelas --</option>
                
                @foreach($daftar_kelas as $kelas)
                    <option value="{{ $kelas->id }}" {{ $kelas_dipilih == $kelas->id ? 'selected' : '' }}>
                        {{ $kelas->nama_kelas }}
                    </option>
                @endforeach
            </select>
            
            <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2 px-6 rounded-lg transition duration-200">
                Filter
            </button>
        </form>
    </div>

    <div class="bg-white mt-8 p-6 rounded-2xl shadow border border-gray-100">
        
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-lg font-bold text-gray-700">5 Transaksi Terakhir</h3>
            <a href="{{ route('admin.keuangan.laporan') }}" class="text-sm text-indigo-600 hover:text-indigo-800 font-semibold hover:underline">
                Lihat Buku Kas &rarr;
            </a>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="border-b-2 border-gray-100">
                        <th class="py-3 px-4 text-gray-500 font-semibold text-sm">Tanggal</th>
                        <th class="py-3 px-4 text-gray-500 font-semibold text-sm">Keterangan</th>
                        <th class="py-3 px-4 text-gray-500 font-semibold text-sm">Jenis</th>
                        <th class="py-3 px-4 text-gray-500 font-semibold text-sm">Nominal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($semua_transaksi->take(5) as $tr)
                    <tr class="border-b border-gray-50 hover:bg-gray-50 transition">
                        <td class="py-3 px-4 text-sm">{{ \Carbon\Carbon::parse($tr->tanggal)->format('d M Y') }}</td>
                        <td class="py-3 px-4 text-sm font-medium text-gray-800">{{ $tr->keterangan }}</td>
                        
                        <td class="py-3 px-4">
                            @if($tr->jenis == 'Masuk')
                                <span class="bg-emerald-100 text-emerald-700 px-2 py-1 rounded-md text-xs font-bold">Masuk</span>
                            @else
                                <span class="bg-rose-100 text-rose-700 px-2 py-1 rounded-md text-xs font-bold">Keluar</span>
                            @endif
                        </td>
                        
                        <td class="py-3 px-4 text-sm font-bold text-gray-700">
                            Rp {{ number_format($tr->nominal, 0, ',', '.') }}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        @if($semua_transaksi->isEmpty())
        <div class="text-center py-6 text-gray-400 text-sm">
            Belum ada transaksi kas kelas.
        </div>
        @endif

    </div>
</div>
@endsection