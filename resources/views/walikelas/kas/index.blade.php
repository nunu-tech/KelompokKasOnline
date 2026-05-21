@extends('waliKelas.layouts.app')

@section('content')

<div class="space-y-8">

    {{-- HEADER --}}
    <section class="bg-softCream rounded-[24px] p-8 flex items-center justify-between relative overflow-hidden shadow-sm">
        
        <div class="absolute -right-10 -top-10 w-40 h-40 bg-luxuryGold/10 rounded-full blur-3xl"></div>

        <div class="space-y-3 z-10">
            <h1 class="text-3xl font-bold font-poppins text-darkJet">
                Kelola Kas Kelas
            </h1>

            <p class="text-sm text-darkJet/70 leading-relaxed max-w-2xl">
                Kelola pemasukan, pengeluaran, dan pembayaran kas siswa dengan mudah dan terorganisir.
            </p>
        </div>

        <a href="#"
           class="hidden md:flex items-center gap-2 px-5 py-3 bg-darkJet text-white rounded-2xl text-sm font-medium hover:scale-[1.02] transition-all shadow-lg shadow-darkJet/10">
            
            <i data-lucide="plus" class="w-4 h-4"></i>
            Tambah Kas

        </a>

    </section>

    {{-- STATISTIK --}}
    <section class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">

        <div class="bg-white p-6 rounded-[22px] border border-gray-100 shadow-sm">
            <div class="flex items-center justify-between">
                <span class="text-sm text-gray-400 font-medium">
                    Total Saldo
                </span>

                <div class="p-2.5 rounded-xl bg-luxuryGold/10 text-luxuryGold">
                    <i data-lucide="wallet" class="w-5 h-5"></i>
                </div>
            </div>

            <div class="mt-4">
                <h2 class="text-2xl font-bold font-poppins text-darkJet">
                    Rp 2.450.000
                </h2>

                <p class="text-xs text-emerald-500 mt-1">
                    +12% dari bulan lalu
                </p>
            </div>
        </div>

        <div class="bg-white p-6 rounded-[22px] border border-gray-100 shadow-sm">
            <div class="flex items-center justify-between">
                <span class="text-sm text-gray-400 font-medium">
                    Pemasukan
                </span>

                <div class="p-2.5 rounded-xl bg-emerald-50 text-emerald-500">
                    <i data-lucide="arrow-down-circle" class="w-5 h-5"></i>
                </div>
            </div>

            <div class="mt-4">
                <h2 class="text-2xl font-bold font-poppins text-darkJet">
                    Rp 3.000.000
                </h2>

                <p class="text-xs text-gray-400 mt-1">
                    Total pembayaran siswa
                </p>
            </div>
        </div>

        <div class="bg-white p-6 rounded-[22px] border border-gray-100 shadow-sm">
            <div class="flex items-center justify-between">
                <span class="text-sm text-gray-400 font-medium">
                    Pengeluaran
                </span>

                <div class="p-2.5 rounded-xl bg-red-50 text-red-500">
                    <i data-lucide="arrow-up-circle" class="w-5 h-5"></i>
                </div>
            </div>

            <div class="mt-4">
                <h2 class="text-2xl font-bold font-poppins text-darkJet">
                    Rp 550.000
                </h2>

                <p class="text-xs text-gray-400 mt-1">
                    Pengeluaran bulan ini
                </p>
            </div>
        </div>

        <div class="bg-white p-6 rounded-[22px] border border-gray-100 shadow-sm">
            <div class="flex items-center justify-between">
                <span class="text-sm text-gray-400 font-medium">
                    Tunggakan
                </span>

                <div class="p-2.5 rounded-xl bg-yellow-50 text-yellow-500">
                    <i data-lucide="alert-circle" class="w-5 h-5"></i>
                </div>
            </div>

            <div class="mt-4">
                <h2 class="text-2xl font-bold font-poppins text-darkJet">
                    8 Siswa
                </h2>

                <p class="text-xs text-gray-400 mt-1">
                    Belum membayar kas
                </p>
            </div>
        </div>

    </section>

    {{-- TABEL --}}
    <section class="bg-white rounded-[24px] p-8 border border-gray-100 shadow-sm">

        <div class="flex items-center justify-between mb-6">

            <div>
                <h3 class="text-xl font-bold font-poppins text-darkJet">
                    Riwayat Kas
                </h3>

                <p class="text-sm text-gray-400 mt-1">
                    Data transaksi kas kelas terbaru
                </p>
            </div>

            <div class="flex items-center gap-3">

                <input type="text"
                       placeholder="Cari siswa..."
                       class="px-4 py-2 rounded-xl border border-gray-200 text-sm focus:outline-none focus:ring-2 focus:ring-luxuryGold/30">

                <button class="px-4 py-2 bg-darkJet text-white rounded-xl text-sm hover:bg-luxuryGold hover:text-darkJet transition-all">
                    Filter
                </button>

            </div>

        </div>

        <div class="overflow-x-auto">

            <table class="w-full text-left">

                <thead>
                    <tr class="border-b border-gray-100 text-xs uppercase tracking-wider text-gray-400">

                        <th class="pb-4">Nama Siswa</th>
                        <th class="pb-4">Tanggal</th>
                        <th class="pb-4">Jenis</th>
                        <th class="pb-4">Jumlah</th>
                        <th class="pb-4">Status</th>
                        <th class="pb-4 text-right">Aksi</th>

                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-50 text-sm">

                    <tr class="hover:bg-softCream/10 transition-all">

                        <td class="py-4 font-medium text-darkJet">
                            Ahmad Fauzan
                        </td>

                        <td class="py-4 text-gray-500">
                            20 Mei 2026
                        </td>

                        <td class="py-4">
                            <span class="px-3 py-1 text-xs rounded-full bg-emerald-50 text-emerald-600">
                                Pemasukan
                            </span>
                        </td>

                        <td class="py-4 font-semibold text-darkJet">
                            Rp 20.000
                        </td>

                        <td class="py-4">
                            <span class="px-3 py-1 text-xs rounded-full bg-softCream text-darkJet border border-luxuryGold/20">
                                Lunas
                            </span>
                        </td>

                        <td class="py-4 text-right space-x-2">

                            <button class="px-3 py-1.5 text-xs bg-blue-50 text-blue-600 rounded-lg hover:bg-blue-100 transition-all">
                                Detail
                            </button>

                            <button class="px-3 py-1.5 text-xs bg-red-50 text-red-500 rounded-lg hover:bg-red-100 transition-all">
                                Hapus
                            </button>

                        </td>

                    </tr>

                    <tr class="hover:bg-softCream/10 transition-all">

                        <td class="py-4 font-medium text-darkJet">
                            Citra Lestari
                        </td>

                        <td class="py-4 text-gray-500">
                            18 Mei 2026
                        </td>

                        <td class="py-4">
                            <span class="px-3 py-1 text-xs rounded-full bg-red-50 text-red-500">
                                Pengeluaran
                            </span>
                        </td>

                        <td class="py-4 font-semibold text-darkJet">
                            Rp 50.000
                        </td>

                        <td class="py-4">
                            <span class="px-3 py-1 text-xs rounded-full bg-yellow-50 text-yellow-600">
                                Diproses
                            </span>
                        </td>

                        <td class="py-4 text-right space-x-2">

                            <button class="px-3 py-1.5 text-xs bg-blue-50 text-blue-600 rounded-lg hover:bg-blue-100 transition-all">
                                Detail
                            </button>

                            <button class="px-3 py-1.5 text-xs bg-red-50 text-red-500 rounded-lg hover:bg-red-100 transition-all">
                                Hapus
                            </button>

                        </td>

                    </tr>

                </tbody>

            </table>

        </div>

    </section>

</div>

@endsection