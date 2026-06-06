@extends('walikelas.layouts.app')

@section('content')

<div class="space-y-8">

    {{-- HEADER --}}
    <section class="bg-softCream rounded-[28px] p-8 shadow-sm">

        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6">

            <div>
                <h1 class="text-3xl font-bold text-darkJet font-poppins">
                    Pengumuman Kelas
                </h1>

                <p class="text-gray-500 mt-2">
                    Informasi terbaru mengenai kegiatan, pembayaran kas, dan agenda kelas.
                </p>
            </div>

            <div class="bg-white px-6 py-4 rounded-2xl shadow-sm border border-gray-100">

                <p class="text-xs uppercase text-gray-400">
                    Status
                </p>

                <h2 class="text-2xl font-bold text-green-500">
                    Aktif
                </h2>

            </div>

        </div>

    </section>

    {{-- STATISTIK --}}
    <section class="grid grid-cols-1 md:grid-cols-3 gap-6">

        <div class="bg-white p-6 rounded-[24px] shadow-sm border border-gray-100">

            <div class="flex items-center justify-between">

                <div>
                    <p class="text-sm text-gray-400">
                        Total Pengumuman
                    </p>

                    <h2 class="text-3xl font-bold text-darkJet mt-2">
                        3
                    </h2>
                </div>

                <div class="w-14 h-14 rounded-2xl bg-blue-100 flex items-center justify-center">

                    <i class="fa-solid fa-bullhorn text-blue-500 text-xl"></i>

                </div>

            </div>

        </div>

        <div class="bg-white p-6 rounded-[24px] shadow-sm border border-gray-100">

            <div class="flex items-center justify-between">

                <div>
                    <p class="text-sm text-gray-400">
                        Pengumuman Terbaru
                    </p>

                    <h2 class="text-2xl font-bold text-green-500 mt-2">
                        Hari Ini
                    </h2>
                </div>

                <div class="w-14 h-14 rounded-2xl bg-green-100 flex items-center justify-center">

                    <i class="fa-solid fa-bell text-green-500 text-xl"></i>

                </div>

            </div>

        </div>

        <div class="bg-white p-6 rounded-[24px] shadow-sm border border-gray-100">

            <div class="flex items-center justify-between">

                <div>
                    <p class="text-sm text-gray-400">
                        Status Sistem
                    </p>

                    <h2 class="text-2xl font-bold text-luxuryGold mt-2">
                        Online
                    </h2>
                </div>

                <div class="w-14 h-14 rounded-2xl bg-yellow-100 flex items-center justify-center">

                    <i class="fa-solid fa-signal text-yellow-600 text-xl"></i>

                </div>

            </div>

        </div>

    </section>

    {{-- DAFTAR PENGUMUMAN --}}
    <section class="bg-white rounded-[28px] shadow-sm border border-gray-100 overflow-hidden">

        <div class="p-6 border-b border-gray-100">

            <h2 class="text-xl font-bold text-darkJet">
                Daftar Pengumuman
            </h2>

            <p class="text-sm text-gray-400 mt-1">
                Informasi terbaru untuk seluruh siswa.
            </p>

        </div>

        <div class="p-6 space-y-5">

            {{-- Pengumuman 1 --}}
            <div class="border border-gray-100 rounded-2xl p-5 hover:shadow-md transition">

                <div class="flex items-start justify-between">

                    <div>

                        <h3 class="font-bold text-lg text-darkJet">
                            Pembayaran Kas Bulan Juni
                        </h3>

                        <p class="text-gray-500 mt-2">
                            Seluruh siswa diharapkan menyelesaikan pembayaran kas bulan Juni sebelum tanggal 15.
                        </p>

                    </div>

                    <span class="px-3 py-1 bg-red-100 text-red-600 rounded-full text-xs font-semibold">
                        Penting
                    </span>

                </div>

                <p class="text-sm text-gray-400 mt-4">
                    Dipublikasikan: Hari ini
                </p>

            </div>

            {{-- Pengumuman 2 --}}
            <div class="border border-gray-100 rounded-2xl p-5 hover:shadow-md transition">

                <div class="flex items-start justify-between">

                    <div>

                        <h3 class="font-bold text-lg text-darkJet">
                            Rapat Kelas
                        </h3>

                        <p class="text-gray-500 mt-2">
                            Akan diadakan rapat kelas pada hari Jumat setelah jam pelajaran selesai.
                        </p>

                    </div>

                    <span class="px-3 py-1 bg-blue-100 text-blue-600 rounded-full text-xs font-semibold">
                        Informasi
                    </span>

                </div>

                <p class="text-sm text-gray-400 mt-4">
                    Dipublikasikan: 2 hari lalu
                </p>

            </div>

            {{-- Pengumuman 3 --}}
            <div class="border border-gray-100 rounded-2xl p-5 hover:shadow-md transition">

                <div class="flex items-start justify-between">

                    <div>

                        <h3 class="font-bold text-lg text-darkJet">
                            Laporan Keuangan Tersedia
                        </h3>

                        <p class="text-gray-500 mt-2">
                            Laporan keuangan kas kelas bulan ini sudah dapat dilihat melalui menu laporan.
                        </p>

                    </div>

                    <span class="px-3 py-1 bg-green-100 text-green-600 rounded-full text-xs font-semibold">
                        Baru
                    </span>

                </div>

                <p class="text-sm text-gray-400 mt-4">
                    Dipublikasikan: 3 hari lalu
                </p>

            </div>

        </div>

    </section>

</div>

@endsection