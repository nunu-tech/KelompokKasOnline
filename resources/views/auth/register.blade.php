<x-guest-layout>
    <h2 class="text-2xl font-semibold text-slate-800 mb-1">
        Buat Akun Baru
    </h2>
    <p class="text-sm text-slate-500 mb-6">
        Lengkapi data berikut untuk mendaftar.
    </p>

    <x-input-error :messages="$errors->all()" class="mt-2" />

    <form method="POST" action="{{ route('register') }}" class="space-y-4">
        @csrf

        {{-- Nama Lengkap --}}
        <div>
            <label class="block text-sm font-medium text-slate-600 mb-1" for="nama_lengkap">
                Nama Lengkap
            </label>
            <input id="nama_lengkap" name="nama_lengkap" type="text"
                class="input-soft block w-full rounded-lg px-3 py-2 text-sm text-slate-800"
                value="{{ old('nama_lengkap') }}" required autofocus>
        </div>

        {{-- Username --}}
        <div>
            <label class="block text-sm font-medium text-slate-600 mb-1" for="username">
                Username
            </label>
            <input id="username" name="username" type="text"
                class="input-soft block w-full rounded-lg px-3 py-2 text-sm text-slate-800"
                value="{{ old('username') }}" required>
        </div>

        {{-- Email --}}
        <div>
            <label class="block text-sm font-medium text-slate-600 mb-1" for="email">
                Email
            </label>
            <input id="email" name="email" type="email"
                class="input-soft block w-full rounded-lg px-3 py-2 text-sm text-slate-800" value="{{ old('email') }}"
                required>
        </div>

        {{-- Role --}}
        <div>
            <label class="block text-sm font-medium text-slate-600 mb-1" for="role">
                Role
            </label>
            <select id="role" name="role"
                class="input-soft block w-full rounded-lg px-3 py-2 text-sm text-slate-800" required>
                <option value="" disabled {{ old('role') ? '' : 'selected' }}>Pilih role</option>
                <option value="siswa" {{ old('role') == 'siswa' ? 'selected' : '' }}>siswa</option>
                <option value="walikelas" {{ old('role') == 'walikelas' ? 'selected' : '' }}>walikelas</option>
                <option value="bendahara" {{ old('role') == 'bendahara' ? 'selected' : '' }}>bendahara</option>
                {{-- tambah opsi lain kalau perlu --}}
            </select>
        </div>

        {{-- Jenis Kelamin --}}
        <div>
            <span class="block text-sm font-medium text-slate-600 mb-1">Jenis Kelamin</span>
            <div class="flex items-center gap-4 text-sm text-slate-700">
                <label class="inline-flex items-center gap-1">
                    <input type="radio" name="kelamin" value="L"
                        class="text-indigo-500 border-slate-300 focus:ring-indigo-300"
                        {{ old('kelamin') == 'L' ? 'checked' : '' }} required>
                    <span>Laki-laki</span>
                </label>
                <label class="inline-flex items-center gap-1">
                    <input type="radio" name="kelamin" value="P"
                        class="text-indigo-500 border-slate-300 focus:ring-indigo-300"
                        {{ old('kelamin') == 'P' ? 'checked' : '' }} required>
                    <span>Perempuan</span>
                </label>
            </div>
        </div>
        </div>

        {{-- Password --}}
        <div>
            <label class="block text-sm font-medium text-slate-600 mb-1" for="password">
                Password
            </label>
            <input id="password" name="password" type="password"
                class="input-soft block w-full rounded-lg px-3 py-2 text-sm text-slate-800" required
                autocomplete="new-password">
        </div>

        {{-- Confirm Password --}}
        <div>
            <label class="block text-sm font-medium text-slate-600 mb-1" for="password_confirmation">
                Konfirmasi Password
            </label>
            <input id="password_confirmation" name="password_confirmation" type="password"
                class="input-soft block w-full rounded-lg px-3 py-2 text-sm text-slate-800" required>
        </div>

        <div class="flex items-center justify-between pt-2">
            <a class="text-xs text-indigo-500 hover:text-indigo-600 underline" href="{{ route('login') }}">
                Sudah punya akun? Masuk
            </a>

            <button type="submit" class="btn-primary-soft px-4 py-2 rounded-lg text-sm font-medium shadow-sm">
                Daftar
            </button>
        </div>
    </form>
</x-guest-layout>
