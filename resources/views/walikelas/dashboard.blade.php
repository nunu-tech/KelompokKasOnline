@extends('waliKelas.layouts.app')

@section('content')

@php
    $persentase = $totalSiswa > 0
        ? round(($sudahBayar / $totalSiswa) * 100)
        : 0;
@endphp

<div class="space-y-8">

    {{-- HERO --}}
    <section class="bg-softCream rounded-[24px] p-8 relative overflow-hidden shadow-sm flex items-center justify-between">

        <div class="absolute -right-10 -top-10 w-40 h-40 bg-luxuryGold/10 rounded-full blur-2xl"></div>

        <div class="max-w-xl space-y-4 z-10">

            <h3 class="text-2xl font-bold font-poppins text-darkJet">
                Selamat Datang, Wali Kelas ✨
            </h3>

            <p class="text-darkJet/80 text-sm leading-relaxed">
                Pantau seluruh transaksi kas kelas dengan mudah.
                Semua pembayaran, tunggakan, pemasukan, dan pengeluaran
                tersinkronisasi secara otomatis.
            </p>

            <div class="flex gap-8 pt-2">

                <div>
                    <p class="text-xs text-gray-500">
                        Saldo Kas
                    </p>

                    <h4 class="text-2xl font-bold text-luxuryGold">
                        Rp {{ number_format($saldoKas,0,',','.') }}
                    </h4>
                </div>

                <div>
                    <p class="text-xs text-gray-500">
                        Menunggak
                    </p>

                    <h4 class="text-2xl font-bold text-red-500">
                        {{ $menunggak }} Siswa
                    </h4>
                </div>

            </div>

            <div class="flex gap-3 pt-2">

                <a href="{{ route('walikelas.laporan') }}"
                    class="px-5 py-2.5 border border-darkJet/20 text-darkJet text-sm font-medium rounded-xl hover:bg-darkJet/5 transition-all">

                    Lihat Laporan

                </a>

            </div>

        </div>

        <div class="hidden md:block pr-8 z-10">

            <div class="w-32 h-32 bg-luxuryGold/20 rounded-2xl flex items-center justify-center border border-luxuryGold/30 shadow-inner">

                <i data-lucide="wallet" class="w-16 h-16 text-luxuryGold"></i>

            </div>

        </div>

    </section>

    {{-- STATISTIK --}}
    <section class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-6">

        {{-- Total Siswa --}}
        <div class="bg-white p-6 rounded-[20px] border border-gray-100 shadow-sm">

            <div class="flex items-center justify-between">

                <span class="text-sm text-gray-400">
                    Total Siswa
                </span>

                <div class="p-2.5 bg-darkJet rounded-xl text-white">
                    <i data-lucide="users" class="w-5 h-5"></i>
                </div>

            </div>

            <div class="mt-4">

                <h4 class="text-3xl font-bold">
                    {{ $totalSiswa }}
                </h4>

                <p class="text-xs text-gray-400 mt-1">
                    Siswa aktif
                </p>

            </div>

        </div>

        {{-- Sudah Bayar --}}
        <div class="bg-white p-6 rounded-[20px] border border-gray-100 shadow-sm">

            <div class="flex items-center justify-between">

                <span class="text-sm text-gray-400">
                    Sudah Bayar
                </span>

                <div class="p-2.5 bg-luxuryGold rounded-xl text-darkJet">
                    <i data-lucide="check-circle" class="w-5 h-5"></i>
                </div>

            </div>

            <div class="mt-4">

                <h4 class="text-3xl font-bold">
                    {{ $sudahBayar }}
                    <span class="text-sm text-gray-400">
                        /{{ $totalSiswa }}
                    </span>
                </h4>

                <div class="w-full bg-gray-100 h-2 rounded-full mt-3 overflow-hidden">

                    <div
                        class="bg-luxuryGold h-full rounded-full transition-all duration-500"
                        style="width: {{ $persentase }}%">
                    </div>

                </div>

                <p class="text-xs text-gray-400 mt-2">
                    {{ $persentase }}% siswa sudah membayar
                </p>

            </div>

        </div>

        {{-- Menunggak --}}
        <div class="bg-white p-6 rounded-[20px] border border-gray-100 shadow-sm">

            <div class="flex items-center justify-between">

                <span class="text-sm text-gray-400">
                    Menunggak
                </span>

                <div class="p-2.5 bg-red-50 rounded-xl text-red-500">
                    <i data-lucide="alert-triangle" class="w-5 h-5"></i>
                </div>

            </div>

            <div class="mt-4">

                <h4 class="text-3xl font-bold text-red-500">
                    {{ $menunggak }}
                </h4>

                <p class="text-xs text-red-400 mt-1">
                    Perlu diingatkan
                </p>

            </div>

        </div>

        {{-- Pemasukan --}}
        <div class="bg-white p-6 rounded-[20px] border border-gray-100 shadow-sm">

            <div class="flex items-center justify-between">

                <span class="text-sm text-gray-400">
                    Pemasukan
                </span>

                <div class="p-2.5 bg-emerald-50 rounded-xl text-emerald-500">
                    <i data-lucide="banknote" class="w-5 h-5"></i>
                </div>

            </div>

            <div class="mt-4">

                <h4 class="text-2xl font-bold">
                    Rp {{ number_format($kasMasuk,0,',','.') }}
                </h4>

            </div>

        </div>

        {{-- Pengeluaran --}}
        <div class="bg-white p-6 rounded-[20px] border border-gray-100 shadow-sm">

            <div class="flex items-center justify-between">

                <span class="text-sm text-gray-400">
                    Pengeluaran
                </span>

                <div class="p-2.5 bg-red-50 rounded-xl text-red-500">
                    <i data-lucide="wallet-cards" class="w-5 h-5"></i>
                </div>

            </div>

            <div class="mt-4">

                <h4 class="text-2xl font-bold text-red-500">
                    Rp {{ number_format($totalPengeluaran,0,',','.') }}
                </h4>

            </div>

        </div>

    </section>

    {{-- CONTENT --}}
    <section class="grid grid-cols-1 lg:grid-cols-3 gap-8">

        {{-- TABEL --}}
        <div class="lg:col-span-2 bg-white p-8 rounded-[24px] border border-gray-100 shadow-sm">

            <div class="flex items-center justify-between mb-6">

                <div>

                    <h4 class="text-lg font-bold font-poppins">
                        Daftar Tunggakan Siswa
                    </h4>

                    <p class="text-xs text-gray-400">
                        Siswa yang belum membayar kas
                    </p>

                </div>

            </div>

            <div class="overflow-x-auto">

                <table class="w-full">

                    <thead>

                        <tr class="border-b text-xs text-gray-400 uppercase">

                            <th class="pb-3 text-left">Nama</th>
                            <th class="pb-3 text-left">Kelas</th>
                            <th class="pb-3 text-left">Jumlah</th>
                            <th class="pb-3 text-left">Status</th>
                            <th class="pb-3 text-right">Aksi</th>

                        </tr>

                    </thead>

                    <tbody>

                        @forelse($tunggakan as $item)

                        <tr class="border-b">

                            <td class="py-4">
                                {{ $item->siswa->nama }}
                            </td>

                            <td>
                                {{ $item->siswa->kelas }}
                            </td>

                            <td>
                                Rp {{ number_format($item->jumlah,0,',','.') }}
                            </td>

                            <td>
                                {{ $item->created_at->diffForHumans() }}
                            </td>

                            <td class="text-right">

                                <form action="{{ route('walikelas.ingatkan',$item->id) }}" method="POST">
                                    @csrf

                                    <button
                                        class="px-3 py-1.5 bg-darkJet text-white rounded-lg text-xs">

                                        Ingatkan

                                    </button>

                                </form>

                            </td>

                        </tr>

                        @empty

                        <tr>

                            <td colspan="5" class="py-8 text-center text-gray-400">

                                Tidak ada data tunggakan

                            </td>

                        </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

        {{-- SIDEBAR --}}
        <div class="space-y-6">

            {{-- Aksi Cepat --}}
            <div class="bg-darkJet text-white p-6 rounded-[24px]">

                <h5 class="text-luxuryGold text-sm font-semibold mb-4">
                    Aksi Cepat
                </h5>

                <div class="grid grid-cols-2 gap-3">

                    <a href="{{ route('walikelas.kas.create') }}"
                        class="p-3 bg-white/10 rounded-xl">

                        <i data-lucide="plus-circle" class="w-5 h-5 text-luxuryGold"></i>

                        <p class="text-xs mt-2">
                            Input Kas
                        </p>

                    </a>

                    <a href="{{ route('walikelas.laporan.pdf') }}"
                        class="p-3 bg-white/10 rounded-xl">

                        <i data-lucide="download" class="w-5 h-5 text-luxuryGold"></i>

                        <p class="text-xs mt-2">
                            Unduh PDF
                        </p>

                    </a>

                </div>

            </div>

            {{-- Ringkasan --}}
            <div class="bg-white p-6 rounded-[24px] border border-gray-100 shadow-sm">

                <h4 class="font-bold mb-4">
                    Ringkasan Keuangan
                </h4>

                <div class="space-y-3">

                    <div class="flex justify-between">
                        <span>Pemasukan</span>
                        <span class="text-emerald-500 font-semibold">
                            Rp {{ number_format($kasMasuk,0,',','.') }}
                        </span>
                    </div>

                    <div class="flex justify-between">
                        <span>Pengeluaran</span>
                        <span class="text-red-500 font-semibold">
                            Rp {{ number_format($totalPengeluaran,0,',','.') }}
                        </span>
                    </div>

                    <hr>

                    <div class="flex justify-between font-bold">

                        <span>Saldo</span>

                        <span class="text-luxuryGold">
                            Rp {{ number_format($saldoKas,0,',','.') }}
                        </span>

                    </div>

                </div>

            </div>

            {{-- Aktivitas --}}
            <div class="bg-white p-6 rounded-[24px] border border-gray-100 shadow-sm">

                <h4 class="font-bold mb-4">
                    Aktivitas Terbaru
                </h4>

                <div class="space-y-4">

                    @forelse($aktivitas as $item)

                        <div>

                            <p class="text-sm font-medium">
                                {{ $item->keterangan }}
                            </p>

                            <p class="text-xs text-gray-400">
                                {{ $item->created_at->diffForHumans() }}
                            </p>

                        </div>

                    @empty

                        <p class="text-sm text-gray-400">
                            Belum ada aktivitas
                        </p>

                    @endforelse

                </div>

            </div>

        </div>

    </section>

</div>

@endsection