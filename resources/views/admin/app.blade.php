<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'KasKelasOnline')</title>    




</head>

<body class="flex">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <aside class="w-72 shrink-0 bg-[#0f172a]">
        {{-- Sidebar --}}
        @include('admin.navigasi.sidebar')
    </aside>

    <main class="flex-1 p-6">
        {{-- Content --}}
        @yield('content')
    </main>
</body>

</html>