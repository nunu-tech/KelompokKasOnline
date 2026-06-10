@extends('waliKelas.layouts.app')

@section('content')

<div class="space-y-6">

    {{-- Welcome Card --}}
    <div class="bg-white rounded-3xl shadow-sm border p-8">

        <h1 class="text-3xl font-bold text-darkJet">
            Selamat Datang 👋
        </h1>

        <p class="mt-2 text-gray-500">
            Selamat datang di Sistem Informasi Kas Kelas.
            Gunakan menu di samping untuk mengelola data siswa,
            melihat laporan keuangan, dan memantau tunggakan kas siswa.
        </p>

    </div>

    {{-- Statistik --}}
    <div class="grid md:grid-cols-3 gap-6">

        <div class="bg-white rounded-3xl border shadow-sm p-6">

            <h3 class="text-sm text-gray-500">
                Total Siswa
            </h3>

            <p class="text-4xl font-bold mt-3 text-blue-600">
                {{ $totalSiswa ?? 0 }}
            </p>

        </div>

        <div class="bg-white rounded-3xl border shadow-sm p-6">

            <h3 class="text-sm text-gray-500">
                Sudah Membayar
            </h3>

            <p class="text-4xl font-bold mt-3 text-green-600">
                {{ $sudahBayar ?? 0 }}
            </p>

        </div>

        <div class="bg-white rounded-3xl border shadow-sm p-6">

            <h3 class="text-sm text-gray-500">
                Belum Membayar
            </h3>

            <p class="text-4xl font-bold mt-3 text-red-500">
                {{ $belumBayar ?? 0 }}
            </p>

        </div>

    </div>

    {{-- Informasi --}}
    <div class="bg-white rounded-3xl shadow-sm border p-8">

        <h2 class="text-xl font-bold mb-4">
            Informasi
        </h2>

        <ul class="space-y-3 text-gray-600">

            <li>
                📌 Pantau pembayaran kas siswa melalui menu Data Siswa.
            </li>

            <li>
                📌 Lihat laporan transaksi bendahara pada menu Laporan Keuangan.
            </li>

            <li>
                📌 Periksa siswa yang belum membayar pada menu Tunggakan.
            </li>

        </ul>

    </div>

</div>

@endsection