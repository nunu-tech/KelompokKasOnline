@extends('admin.app')
@section('title', 'Edit User')

@section('content')
<div class="p-6">

    <!-- Page Header -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-slate-800">
            Edit User
        </h1>
        <p class="text-slate-500 mt-1">
            Perbarui data akun pengguna.
        </p>
    </div>

    <div class="bg-white rounded-3xl shadow-lg border border-slate-200 overflow-hidden">

        <!-- HEADER -->
        <div class="bg-gradient-to-r from-amber-500 to-orange-500 px-6 py-5 flex items-center gap-3">

            <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L12 15l-4 1 1-4 8.586-8.586" />
                </svg>
            </div>

            <div>
                <h2 class="text-white font-semibold text-lg">
                    Form Edit User
                </h2>
                <p class="text-orange-100 text-sm">
                    Ubah data akun pengguna
                </p>
            </div>

        </div>
       

        <!-- FORM -->
        <form action="{{ route('admin.user.update', $user->id_user) }}" method="POST" class="p-8">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                <!-- Nama -->
                <div class="md:col-span-2">
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Nama Lengkap</label>
                    <input type="text"
                        name="nama_lengkap"
                        value="{{ old('nama_lengkap', $user->nama_lengkap) }}"
                        class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:ring-2 focus:ring-amber-500">
                    @error('nama_lengkap')
                    <p class="text-red-500 text-sm mt-1">
                        {{ $message }}
                    </p>
                    @enderror

                </div>

                <!-- Username -->
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Username</label>
                    <input type="text"
                        name="username"
                        value="{{ old('username', $user->username) }}"
                        class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:ring-2 focus:ring-amber-500">
                    @error('username')
                    <p class="text-red-500 text-sm mt-1">
                        {{ $message }}
                    </p>
                    @enderror
                </div>

                <!-- Jenis Kelamin -->
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Jenis Kelamin</label>
                    <select name="kelamin"
                        class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:ring-2 focus:ring-amber-500">

                        <option value="Laki-laki" {{ $user->kelamin == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                        <option value="Perempuan" {{ $user->kelamin == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>

                    </select>
                    @error('kelamin')
                    <p class="text-red-500 text-sm mt-1">
                        {{ $message }}
                    </p>
                    @enderror
                </div>

                <!-- Email -->
                <div class="md:col-span-2">
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Email</label>
                    <input type="email"
                        name="email"
                        value="{{ old('email', $user->email) }}"
                        class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:ring-2 focus:ring-amber-500">
                    @error('email')
                    <p class="text-red-500 text-sm mt-1">
                        {{ $message }}
                    </p>
                    @enderror
                </div>

                <!-- Kelas -->
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Kelas</label>
                    <select name="id_kelas"
                        class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:ring-2 focus:ring-amber-500">

                        @foreach($kelas as $item)
                        <option value="{{ $item->id }}"
                            {{ $user->id_kelas == $item->id ? 'selected' : '' }}>
                            {{ $item->nama_kelas }}
                        </option>
                        @endforeach

                    </select>
                    @error('id_kelas')
                    <p class="text-red-500 text-sm mt-1">
                        {{ $message }}
                    </p>
                    @enderror
                </div>

                <!-- Role -->
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Role</label>
                    <select name="id_role"
                        class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:ring-2 focus:ring-amber-500">

                        @foreach($roles as $role)
                        <option value="{{ $role->id }}"
                            {{ $user->id_role == $role->id ? 'selected' : '' }}>
                            {{ $role->nama_role }}
                        </option>
                        @endforeach

                    </select>
                    @error('id_role')
                    <p class="text-red-500 text-sm mt-1">
                        {{ $message }}
                    </p>
                    @enderror
                </div>

                <!-- Password -->
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">
                        Password (opsional)
                    </label>
                    <input type="password"
                        name="password"
                        placeholder="Kosongkan jika tidak diubah"
                        class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:ring-2 focus:ring-amber-500">
                    @error('password')
                    <p class="text-red-500 text-sm mt-1">
                        {{ $message }}
                    </p>
                    @enderror
                </div>

                <!-- Confirm Password -->
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">
                        Konfirmasi Password
                    </label>
                    <input type="password"
                        name="password_confirmation"
                        class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:ring-2 focus:ring-amber-500">
                </div>

            </div>

            <!-- INFO -->
            <div class="mt-6 bg-amber-50 border border-amber-100 rounded-2xl p-4">
                <p class="text-sm text-amber-700">
                    Password hanya akan berubah jika kamu mengisinya.
                </p>
            </div>

            <!-- BUTTON -->
            <div class="flex justify-end gap-3 mt-8">
                <a href="{{ route('admin.user.tampiluser') }}"
                    class="px-5 py-3 rounded-xl border border-slate-300 hover:bg-slate-100">
                    Batal
                </a>

                <button type="submit"
                    class="px-6 py-3 rounded-xl bg-amber-500 hover:bg-amber-600 text-white font-medium shadow-lg">
                    Update User
                </button>
            </div>

        </form>

    </div>
</div>
@endsection