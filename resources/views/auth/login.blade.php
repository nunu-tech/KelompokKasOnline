<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Masuk - Aplikasi</title>
    
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        /* Kita samakan selektornya dengan app.css agar bisa ditimpa total */
        input[type="text"], 
        input[type="email"], 
        input[type="password"] {
            background-color: #f8fafc !important; /* Latar kolom terang */
            color: #0f172a !important;            /* TEKS DIKONSISTENKAN JADI HITAM/GELAP */
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
            color: #0f172a !important;            /* Tetap hitam saat focus */
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.2) !important;
        }

        /* Untuk kolom pilihan Role */
        select {
            background-color: #f8fafc !important;
            color: #0f172a !important;            /* Teks role jadi hitam */
            border: 1px solid #cbd5e1 !important;
            width: 100% !important;
            border-radius: 0.5rem !important;
            padding: 0.5rem 0.75rem !important;
        }

        /* Mewarnai tulisan Label (Nama, Email, dll) agar kontras di atas warna putih */
        label, span {
            color: #334155 !important; 
        }
    </style>
</head>
<body class="font-sans antialiased" style="background: linear-gradient(135deg, #1f2937, #374151); min-height: 100vh;">

    <div class="min-h-screen flex items-center justify-center p-4 md:p-10">
        <div class="w-full max-w-5xl bg-white rounded-2xl shadow-xl overflow-hidden flex flex-col md:flex-row">

            {{-- SISI KIRI (Ungu/Biru - Disesuaikan untuk konteks Login) --}}
            <div class="md:w-1/2 bg-gradient-to-br from-indigo-600 to-violet-600 text-white p-10 flex flex-col justify-center">
                <h1 class="text-3xl font-bold mb-4" style="color: white !important;">
                    Halo, Senang Melihatmu Kembali! 👋
                </h1>

                <p class="text-sm opacity-90 mb-6 leading-relaxed" style="color: white !important;">
                    Silakan masuk ke akun kamu untuk melanjutkan pengelolaan data dan mengakses seluruh fitur sistem.
                </p>

                <div class="bg-white/10 rounded-xl p-4 backdrop-blur-sm">
                    <p class="text-xs opacity-90" style="color: white !important;">
                        “Keamanan akun kamu adalah prioritas kami. Pastikan untuk selalu menjaga kerahasiaan password Anda.”
                    </p>
                </div>

                <div class="mt-8 text-6xl">
                    🔐
                </div>
            </div>

            {{-- SISI KANAN (Form Putih - Menggunakan Data Asli Anda) --}}
            <div class="md:w-1/2 p-8 md:p-10 bg-white">

                <h2 class="text-2xl font-semibold text-slate-800 mb-1" style="color: #1e293b !important;">
                    Masuk
                </h2>
                <p class="text-sm text-slate-500 mb-6">
                    Silakan login untuk melanjutkan.
                </p>

                <x-auth-session-status class="mb-4" :status="session('status')" />
                <x-input-error :messages="$errors->all()" class="mt-2" />

                <form method="POST" action="{{ route('login') }}" class="space-y-4">
                    @csrf

                    {{-- Email --}}
                    <div>
                        <label class="block text-sm font-medium text-slate-600 mb-1" for="email">
                            Email
                        </label>
                        <input id="email" type="email" name="email"
                            class="input-soft block w-full rounded-lg px-3 py-2 text-sm text-slate-800" value="{{ old('email') }}"
                            required autofocus>
                    </div>

                    {{-- Password --}}
                    <div>
                        <label class="block text-sm font-medium text-slate-600 mb-1" for="password">
                            Password
                        </label>
                        <input id="password" type="password" name="password"
                            class="input-soft block w-full rounded-lg px-3 py-2 text-sm text-slate-800" required
                            autocomplete="current-password">
                    </div>

                    {{-- Remember me + lupa password --}}
                    <div class="flex items-center justify-between text-xs text-slate-500">
                        <label class="inline-flex items-center gap-1">
                            <input id="remember_me" type="checkbox" name="remember"
                                class="rounded border-slate-300 text-indigo-500 shadow-sm focus:ring-indigo-300" style="accent-color: #4f46e5;">
                            <span>Ingat saya</span>
                        </label>

                        @if (Route::has('password.request'))
                            <a class="text-indigo-500 hover:text-indigo-600 underline" href="{{ route('password.request') }}">
                                Lupa password?
                            </a>
                        @endif
                    </div>

                    <div class="flex items-center justify-between pt-2">
                        <a class="text-xs text-indigo-500 hover:text-indigo-600 underline" href="{{ route('register') }}">
                            Belum punya akun? Daftar
                        </a>

                        <button type="submit" class="btn-primary-soft px-4 py-2 rounded-lg text-sm font-medium shadow-sm" style="background: #4f46e5 !important; color: white !important;">
                            Masuk
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</body>
</html>