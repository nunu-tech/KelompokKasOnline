<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KasKelas</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <link rel="preconnect" href="https://fonts.googleapis.com">

    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        body{
            font-family:'Plus Jakarta Sans',sans-serif;
            background:#FAFAFA;
        }
    </style>
</head>

<body class="text-gray-800">

<div class="flex min-h-screen">

    {{-- SIDEBAR --}}
    <aside class="w-64 bg-[#111111] text-gray-400 p-5 flex flex-col justify-between">

        <div>

            <div class="flex items-center gap-3 mb-8 px-2">
                <div class="bg-[#E6C6A2] text-[#111111] font-bold w-8 h-8 rounded-lg flex items-center justify-center">
                    K
                </div>

                <span class="text-white font-bold text-xl">
                    Kas<span class="text-[#E6C6A2]">Kelas</span>
                </span>
            </div>

            <nav class="space-y-1">

                <a href="{{ route('walikelas.dashboard') }}"
                   class="flex items-center gap-3 px-4 py-3 rounded-xl
                   {{ request()->routeIs('walikelas.dashboard')
                        ? 'bg-[#222222] text-white'
                        : 'hover:bg-[#1A1A1A] hover:text-white' }}">

                    <i class="fa-solid fa-table-columns"></i>
                    Dashboard
                </a>

                <a href="{{ route('walikelas.siswa.index') }}"
                   class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-[#1A1A1A] hover:text-white">

                    <i class="fa-solid fa-user-group"></i>
                    Data Siswa
                </a>

                <a href="{{ route('walikelas.kas.index') }}"
                   class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-[#1A1A1A] hover:text-white">

                    <i class="fa-solid fa-wallet"></i>
                    Pembayaran Kas
                </a>

                <a href="{{ route('walikelas.laporan') }}"
                   class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-[#1A1A1A] hover:text-white">

                    <i class="fa-solid fa-file-invoice-dollar"></i>
                    Laporan
                </a>

                <a href="{{ route('walikelas.tunggakan') }}"
                   class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-[#1A1A1A] hover:text-white">

                    <i class="fa-solid fa-circle-exclamation"></i>
                    Tunggakan
                </a>

                <a href="{{ route('walikelas.pengumuman') }}"
                   class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-[#1A1A1A] hover:text-white">

                    <i class="fa-solid fa-bullhorn"></i>
                    Pengumuman
                </a>

            </nav>

        </div>

        <div class="border-t border-gray-800 pt-4">

            <form action="{{ route('logout') }}" method="POST">
                @csrf

                <button type="submit"
                        class="w-full flex items-center gap-3 px-4 py-3 rounded-xl text-red-400 hover:bg-red-500/10">

                    <i class="fa-solid fa-right-from-bracket"></i>
                    Keluar

                </button>
            </form>

        </div>

    </aside>

    {{-- CONTENT --}}
    <div class="flex-1 flex flex-col">

        <header class="bg-white border-b border-gray-100 px-8 py-4">

            <h1 class="text-2xl font-bold">
                KasKelas
            </h1>

        </header>

        <main class="p-8 flex-1 overflow-y-auto">

            @yield('content')

        </main>

    </div>

</div>

</body>
</html>