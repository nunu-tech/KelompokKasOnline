@extends('admin.app')

@section('title', 'Tambah Role')

@section('content')
<div class="p-6">

    <div class="mb-8">
        <h1 class="text-3xl font-bold text-slate-800">
            Tambah Role
        </h1>
        <p class="text-slate-500 mt-1">
            Tambahkan data peran (role) baru ke sistem kas.
        </p>
    </div>

    <div class="bg-white rounded-3xl shadow-lg border border-slate-200 overflow-hidden">

        <div class="bg-gradient-to-r from-indigo-600 to-purple-600 px-6 py-5 flex items-center gap-3">

            <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                </svg>
            </div>

            <div>
                <h2 class="text-white font-semibold text-lg">
                    Form Tambah Role
                </h2>
                <p class="text-indigo-100 text-sm">
                    Isi nama peran yang ingin ditambahkan
                </p>
            </div>

        </div>

        <form action="{{ route('admin.peran.store') }}" method="POST" class="p-8">
            @csrf

            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-2">
                    Nama Role <span class="text-red-500">*</span>
                </label>

                <input
                    type="text"
                    name="nama_role"
                    value="{{ old('nama_role') }}"
                    placeholder="Contoh: Bendahara"
                    class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition-all"
                    required>
            </div>

            @if ($errors->any())
                <div class="bg-red-50 text-red-700 p-4 rounded-xl mt-4 border border-red-200">
                    <ul class="list-disc list-inside text-sm font-medium">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="flex justify-end gap-3 mt-8">

                <a href="{{ route('admin.peran.index') }}"
                   class="px-5 py-3 rounded-xl border border-slate-300 hover:bg-slate-100 text-slate-700 font-medium transition-colors">
                    Batal
                </a>

                <button type="submit"
                        class="px-6 py-3 rounded-xl bg-indigo-600 hover:bg-indigo-700 text-white font-medium shadow-lg shadow-indigo-600/30 transition-all active:scale-95">
                    Simpan Role
                </button>

            </div>

        </form>

    </div>

</div>
@endsection