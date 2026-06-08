@extends('admin.app')

@section('title', 'Tambah Kelas')

@section('content')
<div class="p-6">

    <!-- Header -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-slate-800">
            Tambah Kelas
        </h1>
        <p class="text-slate-500 mt-1">
            Tambahkan data kelas baru ke sistem kas.
        </p>
    </div>

    <!-- Card -->
    <div class="bg-white rounded-3xl shadow-lg border border-slate-200 overflow-hidden">

        <!-- Header Card -->
        <div class="bg-gradient-to-r from-indigo-600 to-purple-600 px-6 py-5 flex items-center gap-3">

            <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center">
                <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                </svg>
            </div>

            <div>
                <h2 class="text-white font-semibold text-lg">
                    Form Tambah Kelas
                </h2>
                <p class="text-indigo-100 text-sm">
                    Isi nama kelas yang ingin ditambahkan
                </p>
            </div>

        </div>

        <!-- Form -->
        <form action="{{ route('admin.kelas.store') }}" method="POST" class="p-8">
            @csrf

            <!-- Nama Kelas -->
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-2">
                    Nama Kelas <span class="text-red-500">*</span>
                </label>

                <input
                    type="text"
                    name="nama_kelas"
                    value="{{ old('nama_kelas') }}"
                    placeholder="Contoh: X RPL 1"
                    class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
            </div>

            <!-- Error -->
            @if ($errors->any())
            <div class="bg-red-100 text-red-700 p-4 rounded mt-4">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <!-- Button -->
            <div class="flex justify-end gap-3 mt-8">

                <a href="{{ route('admin.kelas.index') }}"
                    class="px-5 py-3 rounded-xl border border-slate-300 hover:bg-slate-100">
                    Batal
                </a>

                <button type="submit"
                    class="px-6 py-3 rounded-xl bg-indigo-600 hover:bg-indigo-700 text-white font-medium shadow-lg">
                    Simpan Kelas
                </button>

            </div>

        </form>

    </div>

</div>
@endsection