@extends('waliKelas.layouts.app')

@section('content')

<section class="bg-softCream rounded-[24px] p-8 relative overflow-hidden shadow-sm flex items-center justify-between">
    <div class="absolute -right-10 -top-10 w-40 h-40 bg-luxuryGold/10 rounded-full blur-2xl"></div>

    <div class="max-w-xl space-y-4 z-10">
        <h3 class="text-2xl font-bold font-poppins text-darkJet">Selamat Datang, Wali Kelas ✨</h3>
        <p class="text-darkJet/80 text-sm leading-relaxed">
            Pantau perputaran kas kelas 11 RPL 2 dengan mudah hari ini. Semua data pembayaran, tunggakan, dan laporan keuangan telah tersinkronisasi secara otomatis.
        </p>
        <div class="flex gap-3 pt-2">
            <a href="{{ route('walikelas.laporan') }}"
                class="px-5 py-2.5 border border-darkJet/20 text-darkJet text-sm font-medium rounded-xl hover:bg-darkJet/5 transition-all">
                Lihat Laporan
            </a>
        </div>
    </div>
    <div class="hidden md:block pr-8 z-10">
        <div class="w-32 h-32 bg-luxuryGold/20 rounded-2xl flex items-center justify-center border border-luxuryGold/30 shadow-inner">
            <i data-lucide="presentation" class="w-16 h-16 text-luxuryGold"></i>
        </div>
    </div>
</section>

<section class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
    <div class="bg-white p-6 rounded-[20px] shadow-[0_10px_30px_rgba(0,0,0,0.01)] border border-gray-100 flex flex-col justify-between group hover:shadow-md transition-shadow">
        <div class="flex items-center justify-between">
            <span class="text-sm font-medium text-gray-400">Total Siswa</span>
            <div class="p-2.5 bg-darkJet rounded-xl text-white">
                <i data-lucide="users" class="w-5 h-5"></i>
            </div>
        </div>
        <div class="mt-4">
            <h4 class="text-3xl font-bold font-poppins">
                {{ $totalSiswa }}
            </h4>
            <p class="text-xs text-gray-400 mt-1">Siswa aktif semester ini</p>
        </div>
    </div>
    <div class="bg-white p-6 rounded-[20px] shadow-[0_10px_30px_rgba(0,0,0,0.01)] border border-gray-100 flex flex-col justify-between group hover:shadow-md transition-shadow">
        <div class="flex items-center justify-between">
            <span class="text-sm font-medium text-gray-400">Siswa Sudah Bayar</span>
            <div class="p-2.5 bg-luxuryGold rounded-xl text-darkJet">
                <i data-lucide="check-circle" class="w-5 h-5"></i>
            </div>
        </div>
        <div class="mt-4">
            <h4 class="text-3xl font-bold font-poppins">
                {{ $sudahBayar }}
                <span class="text-sm font-medium text-gray-400">
                    /{{ $totalSiswa }}
                </span>
            </h4>
            <div class="w-full bg-gray-100 h-1.5 rounded-full mt-2 overflow-hidden">
                <div class="bg-luxuryGold h-full rounded-full" style="width: 77%"></div>
            </div>
        </div>
    </div>
    <div class="bg-white p-6 rounded-[20px] shadow-[0_10px_30px_rgba(0,0,0,0.01)] border border-gray-100 flex flex-col justify-between group hover:shadow-md transition-shadow">
        <div class="flex items-center justify-between">
            <span class="text-sm font-medium text-gray-400">Siswa Menunggak</span>
            <div class="p-2.5 bg-red-50 text-red-500 rounded-xl">
                <i data-lucide="alert-triangle" class="w-5 h-5"></i>
            </div>
        </div>
        <div class="mt-4">
            <h4 class="text-3xl font-bold font-poppins text-red-500">
                {{ $menunggak }}
            </h4>
            <p class="text-xs text-red-400 mt-1">
                Butuh tindakan pengingat
            </p>
        </div>
    </div>
    <div class="bg-white p-6 rounded-[20px] shadow-[0_10px_30px_rgba(0,0,0,0.01)] border border-gray-100 flex flex-col justify-between group hover:shadow-md transition-shadow">
        <div class="flex items-center justify-between">
            <span class="text-sm font-medium text-gray-400">Total Uang Kas</span>
            <div class="p-2.5 bg-softCream rounded-xl text-luxuryGold">
                <i data-lucide="banknote" class="w-5 h-5"></i>
            </div>
        </div>
        <div class="mt-4">
            <h4 class="text-2xl font-bold font-poppins">
                Rp {{ number_format($kasMasuk, 0, ',', '.') }}
            </h4>
            <p class="text-xs text-emerald-500 mt-1 flex items-center gap-1">
                <i data-lucide="trending-up" class="w-3 h-3"></i> +12% bulan ini
            </p>
        </div>
    </div>
</section>

<section class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    <div class="lg:col-span-2 bg-white p-8 rounded-[24px] shadow-[0_10px_30px_rgba(0,0,0,0.01)] border border-gray-100 space-y-6">
        <div class="flex items-center justify-between">
            <div>
                <h4 class="text-lg font-bold font-poppins">Daftar Tunggakan Siswa</h4>
                <p class="text-xs text-gray-400">Siswa yang belum menyelesaikan iuran kas bulan ini</p>
            </div>
            <button class="text-xs font-semibold text-luxuryGold hover:underline flex items-center gap-1">
                Lihat Semua <i data-lucide="chevron-right" class="w-3 h-3"></i>
            </button>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="border-b border-gray-100 text-xs font-semibold text-gray-400 uppercase tracking-wider">
                        <th class="pb-3">Siswa</th>
                        <th class="pb-3">Kelas</th>
                        <th class="pb-3">Jumlah</th>
                        <th class="pb-3">Status</th>
                        <th class="pb-3 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50 text-sm">

                    @forelse($tunggakan as $item)

                    <tr class="group hover:bg-softCream/10 transition-all duration-200">

                        <td class="py-4 flex items-center gap-3 pl-1 group-hover:translate-x-1 transition-transform">

                            <span class="font-medium text-darkJet">
                                {{ $item->siswa->nama }}
                            </span>
                        </td>

                        <td class="py-4 text-gray-500">
                            {{ $item->siswa->kelas }}
                        </td>

                        <td class="py-4 font-semibold text-darkJet">
                            Rp {{ number_format($item->jumlah, 0, ',', '.') }}
                        </td>

                        <td class="py-4">
                            <span class="px-2.5 py-1 text-xs font-medium rounded-full bg-softCream text-darkJet border border-luxuryGold/20">
                                {{ $item->created_at->diffForHumans() }}
                            </span>
                        </td>

                        <td class="py-4 text-right">
                            <form action="{{ route('wali.ingatkan', $item->id) }}" method="POST">
                                @csrf
                                <button class="px-3 py-1.5 bg-darkJet text-white text-xs rounded-lg hover:bg-luxuryGold hover:text-darkJet transition-colors">
                                    Ingatkan
                                </button>
                            </form>
                        </td>

                    </tr>

                    @empty

                    <tr>
                        <td colspan="5" class="text-center py-6 text-gray-400">
                            Tidak ada data tunggakan
                        </td>
                    </tr>

                    @endforelse

                </tbody>
            </table>
        </div>
    </div>

    <div class="space-y-6">
        <div class="bg-darkJet text-white p-6 rounded-[24px] space-y-4">
            <h5 class="text-sm font-semibold font-poppins text-luxuryGold tracking-wide uppercase">Aksi Cepat</h5>
            <div class="grid grid-cols-2 gap-3">
                <a href="{{ route('walikelas.kas.create') }}"
                    class="p-3 bg-white/10 rounded-xl hover:bg-white/20 transition-all text-left space-y-2 block">
                    <i data-lucide="plus-circle" class="w-5 h-5 text-luxuryGold"></i>
                    <p class="text-xs font-medium">Input Kas</p>
                </a>
                <a href="{{ route('walikelas.laporan.pdf') }}"
                    class="p-3 bg-white/10 rounded-xl hover:bg-white/20 transition-all text-left space-y-2 block">
                    <i data-lucide="download" class="w-5 h-5 text-luxuryGold"></i>
                    <p class="text-xs font-medium">Unduh PDF</p>
                </a>
            </div>
        </div>

        <div class="bg-white p-6 rounded-[24px] shadow-[0_10px_30px_rgba(0,0,0,0.01)] border border-gray-100 space-y-4">
            <h4 class="text-base font-bold font-poppins">Aktivitas Terbaru</h4>
            <div class="relative pl-6 space-y-6 before:absolute before:left-2 before:top-2 before:bottom-2 before:w-0.5 before:bg-gray-100">
                <div class="relative space-y-1">
                    <div class="absolute -left-[22px] top-1 w-3 h-3 bg-luxuryGold rounded-full ring-4 ring-softCream"></div>
                    <p class="text-xs font-medium text-darkJet">Budi Saputra <span class="text-gray-400 font-normal">membayar Kas minggu ke-3</span></p>
                    <p class="text-[10px] text-gray-400">2 menit yang lalu</p>
                </div>
                <div class="relative space-y-1">
                    <div class="absolute -left-[22px] top-1 w-3 h-3 bg-darkJet rounded-full ring-4 ring-gray-100"></div>
                    <p class="text-xs font-medium text-darkJet">Pengeluaran <span class="text-gray-400 font-normal">pembelian sapu kelas Rp 25.000</span></p>
                    <p class="text-[10px] text-gray-400">1 jam yang lalu</p>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection