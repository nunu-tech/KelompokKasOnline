@extends('waliKelas.layouts.app')

@section('content')

<div class="space-y-8">

    <!-- HEADER -->
    <section class="bg-softCream rounded-[24px] p-8 shadow-sm">

        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-5">

            <div>
                <h1 class="text-3xl font-bold font-poppins text-darkJet">
                    Data Tunggakan Kas
                </h1>

                <p class="text-gray-500 mt-2">
                    Pantau siswa yang belum menyelesaikan pembayaran kas kelas.
                </p>
            </div>

            <div class="flex gap-3">

                <div class="bg-white px-6 py-4 rounded-2xl shadow-sm border border-gray-100">

                    <p class="text-xs text-gray-400 uppercase">
                        Total Menunggak
                    </p>

                    <h3 class="text-2xl font-bold text-red-500 mt-1">
                        {{ $tunggakan->count() }}
                    </h3>

                </div>

            </div>

        </div>

    </section>

    <!-- STATISTIK -->
    <section class="grid grid-cols-1 md:grid-cols-3 gap-6">

        <div class="bg-white p-6 rounded-[24px] shadow-sm border border-gray-100">

            <div class="flex items-center justify-between">

                <div>
                    <p class="text-sm text-gray-400">
                        Total Siswa Menunggak
                    </p>

                    <h2 class="text-3xl font-bold text-red-500 mt-2">
                        {{ $tunggakan->count() }}
                    </h2>
                </div>

                <div class="w-14 h-14 rounded-2xl bg-red-100 flex items-center justify-center">

                    <i class="fa-solid fa-circle-exclamation text-red-500 text-xl"></i>

                </div>

            </div>

        </div>

        <div class="bg-white p-6 rounded-[24px] shadow-sm border border-gray-100">

            <div class="flex items-center justify-between">

                <div>
                    <p class="text-sm text-gray-400">
                        Status
                    </p>

                    <h2 class="text-2xl font-bold text-orange-500 mt-2">
                        Perlu Tindak Lanjut
                    </h2>
                </div>

                <div class="w-14 h-14 rounded-2xl bg-orange-100 flex items-center justify-center">

                    <i class="fa-solid fa-bell text-orange-500 text-xl"></i>

                </div>

            </div>

        </div>

        <div class="bg-white p-6 rounded-[24px] shadow-sm border border-gray-100">

            <div class="flex items-center justify-between">

                <div>
                    <p class="text-sm text-gray-400">
                        Monitoring
                    </p>

                    <h2 class="text-2xl font-bold text-luxuryGold mt-2">
                        Aktif
                    </h2>
                </div>

                <div class="w-14 h-14 rounded-2xl bg-yellow-100 flex items-center justify-center">

                    <i class="fa-solid fa-chart-line text-yellow-600 text-xl"></i>

                </div>

            </div>

        </div>

    </section>

    <!-- TABEL -->
    <section class="bg-white rounded-[24px] shadow-sm border border-gray-100 overflow-hidden">

        <div class="p-6 border-b border-gray-100">

            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">

                <div>

                    <h2 class="text-xl font-bold text-darkJet">
                        Daftar Siswa Menunggak
                    </h2>

                    <p class="text-sm text-gray-400 mt-1">
                        Seluruh siswa yang belum melunasi pembayaran kas.
                    </p>

                </div>

            </div>

        </div>

        <div class="overflow-x-auto">

            <table class="w-full">

                <thead class="bg-gray-50">

                    <tr>

                        <th class="px-6 py-4 text-left text-xs font-semibold uppercase text-gray-500">
                            No
                        </th>

                        <th class="px-6 py-4 text-left text-xs font-semibold uppercase text-gray-500">
                            Nama Siswa
                        </th>

                        <th class="px-6 py-4 text-left text-xs font-semibold uppercase text-gray-500">
                            Kelas
                        </th>

                        <th class="px-6 py-4 text-left text-xs font-semibold uppercase text-gray-500">
                            Status
                        </th>

                        <th class="px-6 py-4 text-center text-xs font-semibold uppercase text-gray-500">
                            Aksi
                        </th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($tunggakan as $item)

                    <tr class="border-b border-gray-100 hover:bg-gray-50 transition">

                        <td class="px-6 py-5">
                            {{ $loop->iteration }}
                        </td>

                        <td class="px-6 py-5">

                            <div>

                                <h4 class="font-semibold text-darkJet">
                                    {{ $item->siswa->nama ?? '-' }}
                                </h4>

                            </div>

                        </td>

                        <td class="px-6 py-5">
                            {{ $item->siswa->kelas ?? '-' }}
                        </td>

                        <td class="px-6 py-5">

                            <span class="px-3 py-1 rounded-full text-xs font-semibold bg-red-100 text-red-600">

                                Menunggak

                            </span>

                        </td>

                        <td class="px-6 py-5">

                            <div class="flex justify-center">

                                <form action="{{ route('walikelas.ingatkan', $item->id) }}"
                                      method="POST">

                                    @csrf

                                    <button type="submit"
                                            class="px-4 py-2 rounded-xl bg-darkJet text-white hover:bg-luxuryGold hover:text-darkJet transition-all">

                                        <i class="fa-solid fa-paper-plane mr-2"></i>
                                        Ingatkan

                                    </button>

                                </form>

                            </div>

                        </td>

                    </tr>

                    @empty

                    <tr>

                        <td colspan="5">

                            <div class="py-20 text-center">

                                <div class="w-20 h-20 mx-auto rounded-full bg-green-100 flex items-center justify-center">

                                    <i class="fa-solid fa-circle-check text-4xl text-green-500"></i>

                                </div>

                                <h3 class="mt-5 text-xl font-bold text-darkJet">
                                    Tidak Ada Tunggakan
                                </h3>

                                <p class="text-gray-400 mt-2">
                                    Semua siswa telah melakukan pembayaran kas.
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