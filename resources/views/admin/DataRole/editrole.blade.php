@extends('admin.app')

@section('title', 'Edit Role')

@section('content')
<div class="p-6">

    <div class="mb-8">
        <h1 class="text-3xl font-bold text-slate-800">Edit Role</h1>
        <p class="text-slate-500 mt-1">Ubah data peran sesuai kebutuhan.</p>
    </div>

    <div class="bg-white rounded-3xl shadow-lg border border-slate-200 overflow-hidden">

        <div class="bg-gradient-to-r from-amber-500 to-orange-500 px-6 py-5 flex items-center gap-3">
            <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                </svg>
            </div>
            <div>
                <h2 class="text-white font-semibold text-lg">Form Edit Role</h2>
                <p class="text-amber-100 text-sm">Perbarui data nama peran</p>
            </div>
        </div>

        <form action="{{ route('admin.peran.update', $role->id) }}" method="POST" class="p-8">
            @csrf
            @method('PUT')

            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-2">
                    Nama Role <span class="text-red-500">*</span>
                </label>
                <input type="text"
                    name="nama_role"
                    value="{{ old('nama_role', $role->nama_role) }}"
                    placeholder="Masukkan nama role"
                    class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:ring-2 focus:ring-amber-500 focus:border-amber-500 outline-none transition-all">
            </div>

            @if ($errors->any())
            <div class="bg-red-50 text-red-700 p-4 rounded-xl mt-4 border border-red-200 text-sm">
                <ul class="list-disc list-inside">
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
                    class="px-6 py-3 rounded-xl bg-amber-600 hover:bg-amber-700 text-white font-medium shadow-lg shadow-amber-500/30 transition-all active:scale-95">
                    Update Role
                </button>
            </div>
        </form>
    </div>
</div>
@endsection