@extends('waliKelas.layouts.app')

@section('content')

<div class="space-y-8">

    <!-- Header -->
    <section class="bg-softCream rounded-[24px] p-8 shadow-sm">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">

            <div>
                <h1 class="text-2xl font-bold font-poppins text-darkJet">
                    Data Pengeluaran
                </h1>

                <p class="text-sm text-gray-500 mt-1">
                    Kelola seluruh pengeluaran kas kelas dengan mudah dan terstruktur.
                </p>
            </div>

            <a href="{{ route('walikelas.pengeluaran.create') }}"
                class="inline-flex items-center gap-2 px-5 py-3 bg-darkJet text-white rounded-xl hover:bg-luxuryGold hover:text-darkJet transition-all duration-300">

                <i data-lucide="plus-circle" class="w-5 h-5"></i>
                Tambah Pengeluaran
            </a>

        </div>
    </section>

    <!-- Statistik -->
    <section class="grid grid-cols-1 md:grid-cols-3 gap-6">

        <div class="bg-white p-6 rounded-[20px] shadow-sm border border-gray-100">
            <p class="text-sm text-gray-400">
                Total Pengeluaran
            </p>

            <h2 class="text-2xl font-bold mt-2 text-red-500">
                Rp {{ number_format($pengeluaran->sum('jumlah'), 0, ',', '.') }}
            </h2>
        </div>

        <div class="bg-white p-6 rounded-[20px] shadow-sm border border-gray-100">
            <p class="text-sm text-gray-400">
                Jumlah Transaksi
            </p>

            <h2 class="text-2xl font-bold mt-2 text-darkJet">
                {{ $pengeluaran->count() }}
            </h2>
        </div>

        <div class="bg-white p-6 rounded-[20px] shadow-sm border border-gray-100">
            <p class="text-sm text-gray-400">
                Pengeluaran Terakhir
            </p>

            <h2 class="text-lg font-semibold mt-2 text-darkJet">
                {{ $pengeluaran->first()?->tanggal ?? '-' }}
            </h2>
        </div>

    </section>

    <!-- Pesan Berhasil -->
    @if(session('success'))
        <div class="bg-green-100 border border-green-300 text-green-700 px-4 py-3 rounded-xl">
            {{ session('success') }}
        </div>
    @endif

    <!-- Tabel -->
    <section class="bg-white rounded-[24px] shadow-sm border border-gray-100 overflow-hidden">

        <div class="p-6 border-b border-gray-100">
            <h3 class="font-bold text-lg text-darkJet">
                Daftar Pengeluaran
            </h3>
        </div>

        <div class="overflow-x-auto">

            <table class="w-full">

                <thead class="bg-gray-50">

                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase">
                            No
                        </th>

                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase">
                            Tanggal
                        </th>

                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase">
                            Keterangan
                        </th>

                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase">
                            Jumlah
                        </th>

                        <th class="px-6 py-4 text-center text-xs font-semibold text-gray-500 uppercase">
                            Aksi
                        </th>
                    </tr>

                </thead>

                <tbody>

                    @forelse($pengeluaran as $item)

                        <tr class="border-b border-gray-100 hover:bg-gray-50 transition">

                            <td class="px-6 py-4">
                                {{ $loop->iteration }}
                            </td>

                            <td class="px-6 py-4">
                                {{ \Carbon\Carbon::parse($item->tanggal)->format('d M Y') }}
                            </td>

                            <td class="px-6 py-4">
                                {{ $item->keterangan }}
                            </td>

                            <td class="px-6 py-4 font-semibold text-red-500">
                                Rp {{ number_format($item->jumlah, 0, ',', '.') }}
                            </td>

                            <td class="px-6 py-4">

                                <div class="flex justify-center gap-2">

                                    <a href="{{ route('walikelas.pengeluaran.edit', $item->id) }}"
                                        class="px-3 py-2 bg-yellow-100 text-yellow-700 rounded-lg hover:bg-yellow-200 transition">

                                        Edit
                                    </a>

                                    <form action="{{ route('walikelas.pengeluaran.destroy', $item->id) }}"
                                        method="POST"
                                        onsubmit="return confirm('Yakin ingin menghapus data ini?')">

                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                            class="px-3 py-2 bg-red-100 text-red-600 rounded-lg hover:bg-red-200 transition">

                                            Hapus
                                        </button>

                                    </form>

                                </div>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="5" class="text-center py-12 text-gray-400">

                                <div class="flex flex-col items-center gap-3">

                                    <i data-lucide="wallet-cards" class="w-10 h-10"></i>

                                    <p>
                                        Belum ada data pengeluaran
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