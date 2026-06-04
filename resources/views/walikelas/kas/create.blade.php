@extends('walikelas.layouts.app')

@section('content')

<div class="max-w-2xl mx-auto bg-white p-8 rounded-2xl shadow-sm border border-gray-100">

    <!-- HEADER -->
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-darkJet font-poppins">
            Input Kas
        </h2>
        <p class="text-sm text-gray-400 mt-1">
            Tambahkan data pemasukan kas siswa
        </p>
    </div>

    <!-- FORM -->
    <form action="{{ route('walikelas.kas.store') }}" method="POST" class="space-y-5">
        @csrf

        <!-- JUMLAH -->
        <div>
            <label class="text-sm font-medium text-gray-600">Jumlah</label>
            <input type="number"
                   name="jumlah"
                   placeholder="Masukkan jumlah kas"
                   class="mt-2 w-full rounded-xl border border-gray-200 px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-luxuryGold focus:border-luxuryGold transition">
        </div>

        <!-- TANGGAL -->
        <div>
            <label class="text-sm font-medium text-gray-600">Tanggal</label>
            <input type="date"
                   name="tanggal"
                   class="mt-2 w-full rounded-xl border border-gray-200 px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-luxuryGold focus:border-luxuryGold transition">
        </div>

        <!-- BUTTON -->
        <div class="pt-2">
            <button type="submit"
                    class="w-full bg-darkJet text-white py-3 rounded-xl font-medium hover:bg-luxuryGold hover:text-darkJet transition-all duration-300">
                Simpan Data Kas
            </button>
        </div>

    </form>

</div>

@endsection