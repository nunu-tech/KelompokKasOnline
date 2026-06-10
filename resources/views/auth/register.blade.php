<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register - Aplikasi</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        /* Kita samakan selektornya dengan app.css agar bisa ditimpa total */
        input[type="text"],
        input[type="email"],
        input[type="password"] {
            background-color: #f8fafc !important;
            /* Latar kolom terang */
            color: #0f172a !important;
            /* TEKS DIKONSISTENKAN JADI HITAM/GELAP */
            border: 1px solid #cbd5e1 !important;
            width: 100% !important;
            border-radius: 0.5rem !important;
            padding: 0.5rem 0.75rem !important;
        }

        /* Efek saat kolom diklik/diketik */
        input[type="text"]:focus,
        input[type="email"]:focus,
        input[type="password"]:focus {
            border-color: #6366f1 !important;
            background-color: #ffffff !important;
            color: #0f172a !important;
            /* Tetap hitam saat focus */
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.2) !important;
        }

        /* Untuk kolom pilihan Role */
        select {
            background-color: #f8fafc !important;
            color: #0f172a !important;
            /* Teks role jadi hitam */
            border: 1px solid #cbd5e1 !important;
            width: 100% !important;
            border-radius: 0.5rem !important;
            padding: 0.5rem 0.75rem !important;
        }

        /* Mewarnai tulisan Label (Nama, Email, dll) agar kontras di atas warna putih */
        label,
        span {
            color: #334155 !important;
        }
    </style>
</head>

<body class="font-sans antialiased" style="background: linear-gradient(135deg, #1f2937, #374151); min-height: 100vh;">

    <div class="min-h-screen flex items-center justify-center p-4 md:p-10">
        <div class="w-full max-w-5xl bg-white rounded-2xl shadow-xl overflow-hidden flex flex-col md:flex-row">

            {{-- SISI KIRI (Ungu/Biru) --}}
            <div
                class="md:w-1/2 bg-gradient-to-br from-indigo-600 to-violet-600 text-white p-10 flex flex-col justify-center">
                <h1 class="text-3xl font-bold mb-4" style="color: white !important;">
                    Selamat Datang 👋
                </h1>

                <p class="text-sm opacity-90 mb-6 leading-relaxed" style="color: white !important;">
                    Buat akun untuk mengakses sistem. Semua data kamu akan tersimpan dengan aman.
                </p>

                <div class="bg-white/10 rounded-xl p-4 backdrop-blur-sm">
                    <p class="text-xs opacity-90" style="color: white !important;">
                        “Sistem ini dibuat untuk mempermudah pengelolaan data pengguna dengan cepat dan efisien.”
                    </p>
                </div>

                <div class="mt-8 text-6xl">
                    🚀
                </div>
            </div>

            {{-- SISI KANAN (Form Putih) --}}
            <div class="md:w-1/2 p-8 md:p-10 bg-white">

                <h2 class="text-2xl font-semibold text-slate-800 mb-1" style="color: #1e293b !important;">
                    Buat Akun Baru
                </h2>
                <p class="text-sm text-slate-500 mb-6">
                    Lengkapi data berikut untuk mendaftar.
                </p>

                <x-input-error :messages="$errors->all()" class="mb-4" />

                <form method="POST" action="{{ route('register') }}" class="space-y-4">
                    @csrf

                    {{-- Nama --}}
                    <div>
                        <label class="block text-sm font-medium mb-1">Nama Lengkap</label>
                        <input name="nama_lengkap" type="text" class="input-custom text-sm"
                            value="{{ old('nama_lengkap') }}" required>
                    </div>

                    {{-- Username --}}
                    <div>
                        <label class="block text-sm font-medium mb-1">Username</label>
                        <input name="username" type="text" class="input-custom text-sm" value="{{ old('username') }}"
                            required>
                    </div>

                    {{-- Email --}}
                    <div>
                        <label class="block text-sm font-medium mb-1">Email</label>
                        <input name="email" type="email" class="input-custom text-sm" value="{{ old('email') }}"
                            required>
                    </div>

                    {{-- Role --}}
                    <div>
                        <label class="block text-sm font-medium mb-1">Role</label>
                        <select name="role" class="input-custom text-sm" style="-webkit-appearance: cubic-bezier;"
                            required>
                            <option value="" disabled selected style="color:#9ca3af">Pilih role</option>
                            <option value="siswa">siswa</option>
                            <option value="walikelas">walikelas</option>
                            <option value="bendahara">bendahara</option>
                        </select>
                    </div>

                    {{-- Gender --}}
                    <div>
                        <span class="block text-sm font-medium mb-1">Jenis Kelamin</span>
                        <div class="flex gap-6 text-sm">
                            <label class="flex items-center gap-2" style="color: #334155 !important;">
                                <input type="radio" name="kelamin" value="L" required
                                    style="accent-color: #4f46e5;">
                                Laki-laki
                            </label>

                            <label class="flex items-center gap-2" style="color: #334155 !important;">
                                <input type="radio" name="kelamin" value="P" required
                                    style="accent-color: #4f46e5;">
                                Perempuan
                            </label>
                        </div>
                    </div>

                    {{-- Password --}}
                    <div>
                        <label class="block text-sm font-medium mb-1">Password</label>
                        <input name="password" type="password" class="input-custom text-sm" required>
                    </div>

                    {{-- Confirm --}}
                    <div>
                        <label class="block text-sm font-medium mb-1">Konfirmasi Password</label>
                        <input name="password_confirmation" type="password" class="input-custom text-sm" required>
                    </div>

                    <div class="flex items-center justify-between pt-2">
                        <a href="{{ route('login') }}" class="text-xs text-indigo-500 hover:text-indigo-600 underline">
                            Sudah punya akun?
                        </a>

                        <button type="submit"
                            class="px-5 py-2 rounded-lg bg-indigo-600 text-white text-sm hover:bg-indigo-700 shadow"
                            style="background: #4f46e5 !important; color: white !important;">
                            Daftar
                        </button>
                    </div>

                </form>
            </div>

        </div>
    </div>
</body>

</html>
