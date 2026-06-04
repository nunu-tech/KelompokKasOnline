@extends('admin.app')
@section('title', 'Tambah User')
@section('content')
<title>Tambah User</title>
<div class="p-6">

    <!-- Page Header -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-slate-800">
            Tambah User
        </h1>
        <p class="text-slate-500 mt-1">
            Tambahkan akun baru ke sistem KasKelasOnline.
        </p>
    </div>

    <div class="bg-white rounded-3xl shadow-lg border border-slate-200 overflow-hidden">

        <!-- Header -->
        <div class="bg-gradient-to-r from-indigo-600 to-purple-600 px-6 py-5 flex items-center gap-3">

            <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center">
                <svg class="w-6 h-6 text-white"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197" />
                </svg>
            </div>

            <div>
                <h2 class="text-white font-semibold text-lg">
                    Form Tambah User
                </h2>
                <p class="text-indigo-100 text-sm">
                    Lengkapi data akun pengguna
                </p>
            </div>

        </div>

        <!-- Form -->
        @if ($errors->any())
        <div class="bg-red-100 text-red-700 p-4 rounded mb-4">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        <form action="{{ route('admin.user.store') }}" method="POST" class="p-8">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                <!-- Nama -->
                <div class="md:col-span-2">
                    <label class="block text-sm font-semibold text-slate-700 mb-2">
                        Nama Lengkap <span class="text-red-500">*</span>
                    </label>

                    <input
                        type="text"
                        name="nama_lengkap"
                        value="{{ old('nama_lengkap') }}"
                        placeholder="Masukkan nama lengkap"
                        class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:ring-2 focus:ring-indigo-500">
                </div>

                <!-- Username -->
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">
                        Username <span class="text-red-500">*</span>
                    </label>

                    <input
                        type="text"
                        name="username"
                        value="{{ old('username') }}"
                        placeholder="Masukkan username"
                        class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:ring-2 focus:ring-indigo-500">
                </div>

                <!-- Jenis Kelamin -->
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">
                        Jenis Kelamin <span class="text-red-500">*</span>
                    </label>

                    <select
                        name="kelamin"
                        class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:ring-2 focus:ring-indigo-500">

                        <option value="">Pilih Jenis Kelamin</option>
                        <option value="Laki-laki">Laki-laki</option>
                        <option value="Perempuan">Perempuan</option>

                    </select>
                </div>

                <!-- Email -->
                <div class="md:col-span-2">
                    <label class="block text-sm font-semibold text-slate-700 mb-2">
                        Email
                    </label>

                    <input
                        type="email"
                        name="email"
                        value="{{ old('email') }}"
                        placeholder="contoh@gmail.com"
                        class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:ring-2 focus:ring-indigo-500">
                </div>

                <!-- Kelas -->
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">
                        Kelas <span class="text-red-500">*</span>
                    </label>

                    <select
                        name="id_kelas"
                        class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:ring-2 focus:ring-indigo-500">

                        <option value="">Pilih Kelas</option>

                        @foreach($kelas as $item)
                        <option value="{{ $item->id }}">
                            {{ $item->nama_kelas }}
                        </option>
                        @endforeach

                    </select>
                </div>

                <!-- Role -->
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">
                        Role <span class="text-red-500">*</span>
                    </label>

                    <select
                        name="id_role"
                        class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:ring-2 focus:ring-indigo-500">

                        <option value="">Pilih Role</option>

                        @foreach($roles as $role)
                        <option value="{{ $role->id }}">
                            {{ $role->nama_role }}
                        </option>
                        @endforeach

                    </select>
                </div>

                <!-- Password -->
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">
                        Password <span class="text-red-500">*</span>
                    </label>

                    <input
                        type="password"
                        name="password"
                        class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:ring-2 focus:ring-indigo-500">
                </div>

                <!-- Konfirmasi Password -->
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">
                        Konfirmasi Password <span class="text-red-500">*</span>
                    </label>

                    <input
                        type="password"
                        name="password_confirmation"
                        class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:ring-2 focus:ring-indigo-500">
                </div>

            </div>

            <!-- Informasi -->
            <div class="mt-6 bg-indigo-50 border border-indigo-100 rounded-2xl p-4">
                <p class="text-sm text-indigo-700">
                    Akun yang dibuat akan langsung dapat digunakan untuk login sesuai role yang dipilih.
                </p>
            </div>

            <!-- Tombol -->
            <div class="flex justify-end gap-3 mt-8">
                <a href="{{ route('admin.user.tampiluser') }}"
                    class="px-5 py-3 rounded-xl border border-slate-300 hover:bg-slate-100">
                    Batal
                </a>


                <button
                    type="submit"
                    class="px-6 py-3 rounded-xl bg-indigo-600 hover:bg-indigo-700 text-white font-medium shadow-lg">
                    Simpan User
                </button>

            </div>
        </form>

    </div>

</div>


<script>
    function togglePassword() {
        const password = document.getElementById('password');

        if (password.type === 'password') {
            password.type = 'text';
        } else {
            password.type = 'password';
        }
    }
</script>
@endsection