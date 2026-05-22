@extends('waliKelas.layouts.app')

@section('content')

<div class="space-y-8">

    {{-- HEADER --}}
    <section class="bg-white p-8 rounded-[24px] shadow-sm border border-gray-100">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-2xl font-bold font-poppins text-darkJet">
                    Laporan Keuangan Kas
                </h2>

                <p class="text-sm text-gray-500 mt-1">
                    Ringkasan pemasukan dan pengeluaran kas kelas
                </p>
            </div>

            <div class="bg-softCream p-4 rounded-2xl">
                <i data-lucide="file-text" class="w-10 h-10 text-luxuryGold"></i>
            </div>
        </div>
    </section>

    {{-- CARD STATISTIK --}}
    <section class="grid grid-cols-1 md:grid-cols-3 gap-6">

        {{-- PEMASUKAN --}}
        <div class="bg-white p-6 rounded-[24px] border border-gray-100 shadow-sm">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-400">Total Pemasukan</p>

                    <h3 class="text-2xl font-bold mt-2 text-emerald-600">
                        Rp {{ number_format($totalPemasukan, 0, ',', '.') }}
                    </h3>
                </div>

                <div class="bg-emerald-100 p-3 rounded-xl">
                    <i data-lucide="arrow-down-circle" class="w-6 h-6 text-emerald-600"></i>
                </div>
            </div>
        </div>

        {{-- PENGELUARAN --}}
        <div class="bg-white p-6 rounded-[24px] border border-gray-100 shadow-sm">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-400">Total Pengeluaran</p>

                    <h3 class="text-2xl font-bold mt-2 text-red-500">
                        Rp {{ number_format($totalPengeluaran, 0, ',', '.') }}
                    </h3>
                </div>

                <div class="bg-red-100 p-3 rounded-xl">
                    <i data-lucide="arrow-up-circle" class="w-6 h-6 text-red-500"></i>
                </div>
            </div>
        </div>

        {{-- SALDO --}}
        <div class="bg-darkJet text-white p-6 rounded-[24px] shadow-sm">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-300">Saldo Akhir</p>

                    <h3 class="text-2xl font-bold mt-2 text-luxuryGold">
                        Rp {{ number_format($saldo, 0, ',', '.') }}
                    </h3>
                </div>

                <div class="bg-white/10 p-3 rounded-xl">
                    <i data-lucide="wallet" class="w-6 h-6 text-luxuryGold"></i>
                </div>
            </div>
        </div>

    </section>

    {{-- TABEL PEMASUKAN --}}
    <section class="bg-white p-8 rounded-[24px] shadow-sm border border-gray-100">

        <div class="flex items-center justify-between mb-6">
            <div>
                <h3 class="text-lg font-bold font-poppins">
                    Data Pembayaran Kas
                </h3>

                <p class="text-sm text-gray-400">
                    Seluruh data pemasukan kas siswa
                </p>
            </div>
        </div>

        <div class="overflow-x-auto">

            <table class="w-full text-sm">

                <thead>
                    <tr class="border-b border-gray-100 text-left text-gray-400 uppercase text-xs">
                        <th class="pb-4">No</th>
                        <th class="pb-4">Nama</th>
                        <th class="pb-4">Tanggal</th>
                        <th class="pb-4">Jumlah</th>
                        <th class="pb-4">Keterangan</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-50">

                    @forelse($kas as $item)

                    <tr class="hover:bg-softCream/10 transition-all">

                        <td class="py-4">
                            {{ $loop->iteration }}
                        </td>

                        <td class="py-4 font-medium text-darkJet">
                            {{ $item->nama }}
                        </td>

                        <td class="py-4 text-gray-500">
                            {{ $item->tanggal }}
                        </td>

                        <td class="py-4 font-semibold text-emerald-600">
                            Rp {{ number_format($item->jumlah, 0, ',', '.') }}
                        </td>

                        <td class="py-4 text-gray-500">
                            {{ $item->keterangan }}
                        </td>

                    </tr>

                    @empty

                    <tr>
                        <td colspan="5" class="py-6 text-center text-gray-400">
                            Belum ada data pembayaran
                        </td>
                    </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </section>

    {{-- TABEL PENGELUARAN --}}
    <section class="bg-white p-8 rounded-[24px] shadow-sm border border-gray-100">

        <div class="mb-6">
            <h3 class="text-lg font-bold font-poppins">
                Data Pengeluaran
            </h3>

            <p class="text-sm text-gray-400">
                Seluruh penggunaan uang kas kelas
            </p>
        </div>

        <div class="overflow-x-auto">

            <table class="w-full text-sm">

                <thead>
                    <tr class="border-b border-gray-100 text-left text-gray-400 uppercase text-xs">
                        <th class="pb-4">No</th>
                        <th class="pb-4">Tanggal</th>
                        <th class="pb-4">Keperluan</th>
                        <th class="pb-4">Jumlah</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-50">

                    @forelse($pengeluaran as $item)

                    <tr class="hover:bg-softCream/10 transition-all">

                        <td class="py-4">
                            {{ $loop->iteration }}
                        </td>

                        <td class="py-4 text-gray-500">
                            {{ $item->tanggal }}
                        </td>

                        <td class="py-4 font-medium text-darkJet">
                            {{ $item->keterangan }}
                        </td>

                        <td class="py-4 font-semibold text-red-500">
                            Rp {{ number_format($item->jumlah, 0, ',', '.') }}
                        </td>

                    </tr>

                    @empty

                    <tr>
                        <td colspan="4" class="py-6 text-center text-gray-400">
                            Belum ada data pengeluaran
                        </td>
                    </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </section>

</div>

@endsection