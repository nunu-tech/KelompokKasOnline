@extends('waliKelas.layouts.app')

@section('content')

<div class="max-w-3xl mx-auto">

    <!-- Header -->
    <div class="bg-softCream rounded-[24px] p-8 shadow-sm mb-6">
        <h1 class="text-2xl font-bold font-poppins text-darkJet">
            Tambah Pengeluaran
        </h1>

        <p class="text-sm text-gray-500 mt-2">
            Tambahkan data pengeluaran kas kelas.
        </p>
    </div>

    <!-- Form -->
    <div class="bg-white rounded-[24px] shadow-sm border border-gray-100 p-8">

        <form action="{{ route('walikelas.pengeluaran.store') }}" method="POST">

            @csrf

            <!-- Tanggal -->
            <div class="mb-5">
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Tanggal
                </label>

                <input
                    type="date"
                    name="tanggal"
                    value="{{ old('tanggal') }}"
                    class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-luxuryGold">

                @error('tanggal')
                    <p class="text-red-500 text-sm mt-1">
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <!-- Jumlah -->
            <div class="mb-5">
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Jumlah Pengeluaran
                </label>

                <input
                    type="number"
                    name="jumlah"
                    value="{{ old('jumlah') }}"
                    placeholder="Masukkan jumlah pengeluaran"
                    class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-luxuryGold">

                @error('jumlah')
                    <p class="text-red-500 text-sm mt-1">
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <!-- Keterangan -->
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Keterangan
                </label>

                <textarea
                    name="keterangan"
                    rows="4"
                    placeholder="Contoh: Pembelian sapu kelas"
                    class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-luxuryGold">{{ old('keterangan') }}</textarea>

                @error('keterangan')
                    <p class="text-red-500 text-sm mt-1">
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <!-- Tombol -->
            <div class="flex gap-3">

                <button
                    type="submit"
                    class="px-6 py-3 bg-darkJet text-white rounded-xl hover:bg-luxuryGold hover:text-darkJet transition">

                    Simpan Pengeluaran
                </button>

                <a href="{{ route('walikelas.pengeluaran.index') }}"
                    class="px-6 py-3 border border-gray-300 rounded-xl hover:bg-gray-100 transition">

                    Kembali
                </a>

            </div>

        </form>

    </div>

</div>

@endsection