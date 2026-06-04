@extends('layouts.walikelas')

@section('content')

<div class="space-y-8">

    <!-- HEADER -->
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-darkJet font-poppins">Pembayaran Kas</h1>
            <p class="text-sm text-gray-400">Kelola data pembayaran kas siswa</p>
        </div>

        <a href="#"
            class="px-4 py-2 bg-luxuryGold text-darkJet rounded-xl font-medium hover:opacity-90 transition">
            + Tambah Pembayaran
        </a>
    </div>

    <!-- STATISTIK -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
            <p class="text-sm text-gray-400">Total Kas Masuk</p>

            <h2 class="text-2xl font-bold text-darkJet mt-2">
                Rp {{ number_format($totalKas, 0, ',', '.') }}
            </h2>
        </div>
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
            <p class="text-sm text-gray-400">Sudah Bayar</p>
            <h2 class="text-2xl font-bold text-green-500 mt-2">{{ $sudahBayar }} Siswa</h2>
        </div>

        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
            <p class="text-sm text-gray-400">Belum Bayar</p>
            <h2 class="text-2xl font-bold text-red-500 mt-2">{{ $belumBayar }} Siswa</h2>
        </div>

    </div>

    <!-- FILTER -->
    <form method="GET" class="bg-white p-4 rounded-2xl shadow-sm border flex flex-col md:flex-row gap-4 md:items-center md:justify-between">

        <input type="text"
            name="search"
            value="{{ request('search') }}"
            placeholder="Cari nama siswa..."
            class="w-full md:w-1/3 px-4 py-2 border rounded-xl">

        <select name="status" class="px-4 py-2 border rounded-xl">
            <option value="">Semua Status</option>
            <option value="lunas" {{ request('status') == 'lunas' ? 'selected' : '' }}>Sudah Bayar</option>
            <option value="belum" {{ request('status') == 'belum' ? 'selected' : '' }}>Belum Bayar</option>
        </select>

        <button class="px-4 py-2 bg-luxuryGold rounded-xl text-darkJet font-medium">
            Filter
        </button>

    </form>
    <!-- TABEL -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-x-auto">

        <table class="w-full text-sm text-left">
            <thead class="bg-gray-50 text-gray-500">
                <tr>
                    <th class="p-4">No</th>
                    <th class="p-4">Nama Siswa</th>
                    <th class="p-4">Kelas</th>
                    <th class="p-4">Tanggal Bayar</th>
                    <th class="p-4">Jumlah</th>
                    <th class="p-4">Status</th>
                    <th class="p-4 text-center">Aksi</th>
                </tr>
            </thead>

            <tbody>

                <!-- DATA CONTOH 1 -->
                @forelse($kas as $item)
                <tr class="border-t">

                    <td class="p-4">{{ $kas->firstItem() + $loop->index }}</td>

                    <td class="p-4 font-medium">
                        {{ $item->siswa->nama ?? '-' }}
                    </td>

                    <td class="p-4">
                        {{ $item->siswa->kelas ?? '-' }}
                    </td>

                    <td class="p-4">
                        {{ $item->created_at->format('Y-m-d') }}
                    </td>

                    <td class="p-4">
                        Rp {{ number_format($item->jumlah, 0, ',', '.') }}
                    </td>

                    <td class="p-4">
                        @if($item->status == 'lunas')
                        <span class="px-3 py-1 text-xs rounded-full bg-green-100 text-green-600">
                            Sudah Bayar
                        </span>
                        @else
                        <span class="px-3 py-1 text-xs rounded-full bg-red-100 text-red-600">
                            Belum Bayar
                        </span>
                        @endif
                    </td>

                    <td class="p-4 text-center">
                        <button class="text-blue-500 hover:underline">Detail</button>
                    </td>

                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center p-4 text-gray-400">
                        Tidak ada data
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>

    </div>

</div>

@endsection