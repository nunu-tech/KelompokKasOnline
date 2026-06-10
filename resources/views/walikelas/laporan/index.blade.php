@extends('waliKelas.layouts.app')

@section('content')

<div class="space-y-8">

    {{-- HERO --}}
    <section class="bg-gradient-to-r from-darkJet to-gray-800 text-white rounded-[30px] p-8 shadow-lg">

        <div class="flex justify-between items-center">

            <div>
                <p class="text-luxuryGold text-sm font-medium uppercase tracking-wider">
                    Laporan Keuangan
                </p>

                <h1 class="text-4xl font-bold mt-2">
                    Laporan Bendahara
                </h1>

                <p class="mt-3 text-gray-300">
                    Seluruh transaksi kas yang telah dicatat bendahara kelas.
                </p>
            </div>

            <div class="bg-white/10 p-5 rounded-3xl">
                <i data-lucide="file-text" class="w-12 h-12 text-luxuryGold"></i>
            </div>

        </div>

    </section>

    {{-- STATISTIK --}}
    <section class="grid md:grid-cols-3 gap-5">

        <div class="bg-white rounded-3xl p-6 border shadow-sm">

            <p class="text-gray-500 text-sm">
                Total Transaksi
            </p>

            <h3 class="text-4xl font-bold mt-3">
                {{ $laporan->count() }}
            </h3>

        </div>

        <div class="bg-white rounded-3xl p-6 border shadow-sm">

            <p class="text-gray-500 text-sm">
                Total Kas Masuk
            </p>

            <h3 class="text-3xl font-bold text-green-600 mt-3">
                Rp {{ number_format($laporan->sum('jumlah'),0,',','.') }}
            </h3>

        </div>

        <div class="bg-white rounded-3xl p-6 border shadow-sm">

            <p class="text-gray-500 text-sm">
                Data Terakhir
            </p>

            <h3 class="text-xl font-bold mt-3">
                {{ $laporan->count() > 0 ? $laporan->first()->nama : '-' }}
            </h3>

        </div>

    </section>

    {{-- TABEL --}}
    <section class="bg-white rounded-[30px] shadow-sm border overflow-hidden">

        <div class="p-6 border-b">

            <h3 class="text-xl font-bold">
                Riwayat Transaksi Kas
            </h3>

            <p class="text-gray-500 text-sm mt-1">
                Data transaksi yang dicatat bendahara
            </p>

        </div>

        <div class="overflow-x-auto">

            <table class="w-full">

                <thead class="bg-gray-50">

                    <tr class="text-left text-xs uppercase text-gray-500">

                        <th class="px-6 py-4">No</th>
                        <th class="px-6 py-4">Tanggal</th>
                        <th class="px-6 py-4">Nama</th>
                        <th class="px-6 py-4">Nominal</th>
                        <th class="px-6 py-4">Keterangan</th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($laporan as $item)

                    <tr class="border-b hover:bg-gray-50 transition">

                        <td class="px-6 py-4">
                            {{ $loop->iteration }}
                        </td>

                        <td class="px-6 py-4">
                            {{ \Carbon\Carbon::parse($item->tanggal)->format('d M Y') }}
                        </td>

                        <td class="px-6 py-4 font-medium">
                            {{ $item->nama }}
                        </td>

                        <td class="px-6 py-4">

                            <span class="bg-green-100 text-green-600 px-3 py-1 rounded-full text-sm font-semibold">

                                Rp {{ number_format($item->jumlah,0,',','.') }}

                            </span>

                        </td>

                        <td class="px-6 py-4 text-gray-600">
                            {{ $item->keterangan ?? '-' }}
                        </td>

                    </tr>

                    @empty

                    <tr>

                        <td colspan="5" class="text-center py-16">

                            <div class="space-y-3">

                                <i data-lucide="folder-open"
                                    class="w-12 h-12 mx-auto text-gray-300"></i>

                                <p class="text-gray-400">
                                    Belum ada transaksi kas
                                </p>

                            </div>

                        </td>

                    </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </section>

</div>

@endsection