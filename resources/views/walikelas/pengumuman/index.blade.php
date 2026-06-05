@extends('waliKelas.layouts.app')

@section('content')

<div class="space-y-8">

    {{-- HEADER --}}
    <section class="bg-softCream rounded-[28px] p-8 shadow-sm">

        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6">

            <div>
                <h1 class="text-3xl font-bold text-darkJet font-poppins">
                    Monitoring Tunggakan Kas
                </h1>

                <p class="text-gray-500 mt-2">
                    Pantau siswa yang belum menyelesaikan pembayaran kas kelas secara real-time.
                </p>
            </div>

            <div class="flex items-center gap-3">

                <div class="bg-white px-6 py-4 rounded-2xl shadow-sm border border-gray-100">

                    <p class="text-xs uppercase text-gray-400">
                        Total Tunggakan
                    </p>

                    <h2 class="text-3xl font-bold text-red-500">
                        {{ $tunggakan->count() }}
                    </h2>

                </div>

            </div>

        </div>

    </section>

    {{-- STATISTIK --}}
    <section class="grid grid-cols-1 md:grid-cols-3 gap-6">

        <div class="bg-white rounded-[24px] p-6 shadow-sm border border-gray-100">

            <div class="flex items-center justify-between">

                <div>

                    <p class="text-sm text-gray-400">
                        Siswa Menunggak
                    </p>

                    <h2 class="text-3xl font-bold text-red-500 mt-2">
                        {{ $tunggakan->count() }}
                    </h2>

                </div>

                <div class="w-14 h-14 rounded-2xl bg-red-100 flex items-center justify-center">

                    <i class="fa-solid fa-triangle-exclamation text-red-500 text-xl"></i>

                </div>

            </div>

        </div>

        <div class="bg-white rounded-[24px] p-6 shadow-sm border border-gray-100">

            <div class="flex items-center justify-between">

                <div>

                    <p class="text-sm text-gray-400">
                        Status Monitoring
                    </p>

                    <h2 class="text-2xl font-bold text-green-500 mt-2">
                        Aktif
                    </h2>

                </div>

                <div class="w-14 h-14 rounded-2xl bg-green-100 flex items-center justify-center">

                    <i class="fa-solid fa-chart-line text-green-500 text-xl"></i>

                </div>

            </div>

        </div>

        <div class="bg-white rounded-[24px] p-6 shadow-sm border border-gray-100">

            <div class="flex items-center justify-between">

                <div>

                    <p class="text-sm text-gray-400">
                        Perlu Ditindaklanjuti
                    </p>

                    <h2 class="text-2xl font-bold text-orange-500 mt-2">
                        Ya
                    </h2>

                </div>

                <div class="w-14 h-14 rounded-2xl bg-orange-100 flex items-center justify-center">

                    <i class="fa-solid fa-bell text-orange-500 text-xl"></i>

                </div>

            </div>

        </div>

    </section>

    {{-- TABEL --}}
    <section class="bg-white rounded-[28px] shadow-sm border border-gray-100 overflow-hidden">

        <div class="p-6 border-b border-gray-100">

            <div class="flex items-center justify-between">

                <div>

                    <h2 class="text-xl font-bold text-darkJet">
                        Daftar Siswa Menunggak
                    </h2>

                    <p class="text-sm text-gray-400 mt-1">
                        Data siswa yang belum melakukan pembayaran kas.
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

                        <th class="px-6 py-4 text-left text-xs font-semibold uppercase text-gray-500">
                            Terakhir Update
                        </th>

                        <th class="px-6 py-4 text-center text-xs font-semibold uppercase text-gray-500">
                            Aksi
                        </th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($tunggakan as $item)

                    <tr class="border-b border-gray-100 hover:bg-gray-50 transition duration-300">

                        <td class="px-6 py-5">
                            {{ $loop->iteration }}
                        </td>

                        <td class="px-6 py-5">

                            <div class="flex items-center gap-3">

                                <div class="w-10 h-10 rounded-full bg-luxuryGold/20 flex items-center justify-center font-semibold text-darkJet">

                                    {{ strtoupper(substr($item->siswa->nama ?? 'S',0,1)) }}

                                </div>

                                <div>

                                    <h4 class="font-semibold text-darkJet">
                                        {{ $item->siswa->nama ?? '-' }}
                                    </h4>

                                </div>

                            </div>

                        </td>

                        <td class="px-6 py-5">
                            {{ $item->siswa->kelas ?? '-' }}
                        </td>

                        <td class="px-6 py-5">

                            <span class="px-3 py-1 bg-red-100 text-red-600 rounded-full text-xs font-semibold">

                                Menunggak

                            </span>

                        </td>

                        <td class="px-6 py-5 text-gray-500">

                            {{ $item->created_at?->diffForHumans() ?? '-' }}

                        </td>

                        <td class="px-6 py-5">

                            <div class="flex justify-center gap-2">

                                <form action="{{ route('walikelas.ingatkan', $item->id) }}"
                                      method="POST">

                                    @csrf

                                    <button type="submit"
                                            class="px-4 py-2 bg-darkJet text-white rounded-xl hover:bg-luxuryGold hover:text-darkJet transition-all">

                                        <i class="fa-solid fa-paper-plane mr-2"></i>
                                        Ingatkan

                                    </button>

                                </form>

                            </div>

                        </td>

                    </tr>

                    @empty

                    <tr>

                        <td colspan="6">

                            <div class="py-20 text-center">

                                <div class="w-24 h-24 mx-auto rounded-full bg-green-100 flex items-center justify-center">

                                    <i class="fa-solid fa-circle-check text-5xl text-green-500"></i>

                                </div>

                                <h3 class="text-2xl font-bold text-darkJet mt-6">

                                    Tidak Ada Tunggakan

                                </h3>

                                <p class="text-gray-400 mt-2">

                                    Semua siswa telah melunasi pembayaran kas.

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