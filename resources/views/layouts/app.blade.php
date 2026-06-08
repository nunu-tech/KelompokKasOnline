<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'KasKelas') }}</title>

    <!-- Google Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }

        .glass {
            backdrop-filter: blur(12px);
            background: rgba(255,255,255,0.8);
        }
    </style>
</head>
<body class="bg-gradient-to-br from-slate-100 via-blue-50 to-indigo-100 min-h-screen">

    <div class="min-h-screen flex flex-col">

        <!-- Navbar -->
        @include('layouts.navigation')

        <!-- Header -->
        @isset($header)
            <header class="px-6 pt-6">
                <div class="max-w-7xl mx-auto">
                    <div class="glass rounded-3xl shadow-lg p-6 border border-white/50">
                        {{ $header }}
                    </div>
                </div>
            </header>
        @endisset

        <!-- Content -->
        <main class="flex-1 px-6 py-8">
            <div class="max-w-7xl mx-auto">
                {{ $slot }}
            </div>
        </main>

        <!-- Footer -->
        <footer class="py-4 text-center text-gray-500 text-sm">
            © {{ date('Y') }} KasKelas • Sistem Manajemen Kas Kelas
        </footer>

    </div>

</body>
</html>