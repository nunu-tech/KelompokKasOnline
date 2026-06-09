@extends('admin.app')

@section('title', 'Dashboard Admin')

@section('content')
<main class="flex-1 overflow-y-auto p-6 md:p-10 relative">
    
    <div class="absolute top-0 left-0 w-full h-64 bg-gradient-to-b from-indigo-50/50 to-transparent -z-10"></div>

    <header class="flex flex-col md:flex-row justify-between items-start md:items-center mb-10 gap-5">
        <div>
            <h2 class="text-3xl font-extrabold tracking-tight bg-clip-text text-transparent bg-gradient-to-r from-slate-900 to-slate-600">
                Selamat Datang, {{ auth()->user()->nama_lengkap ?? 'Admin' }}! 👋
            </h2>
            <p class="text-slate-500 mt-1.5 font-medium">Ringkasan aktivitas kas kelas hari ini.</p>
        </div>
        
        <a href="{{ route('admin.keuangan.create') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white px-5 py-2.5 rounded-xl font-medium transition-all shadow-lg shadow-indigo-600/30 hover:shadow-indigo-600/50 hover:-translate-y-0.5 flex items-center gap-2 active:scale-95">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
            Catat Transaksi
        </a>
    </header>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-200/60 flex flex-col justify-between hover:shadow-md hover:border-emerald-200 transition-all group">
            <div class="flex items-start justify-between">
                <div>
                    <p class="text-sm text-slate-500 font-medium mb-1">Total Saldo Kas</p>
                    <p class="text-3xl font-bold text-slate-800">Rp {{ number_format($saldo_kas, 0, ',', '.') }}</p>
                </div>
                <div class="w-12 h-12 flex items-center justify-center rounded-xl bg-emerald-50 text-emerald-600 group-hover:scale-110 transition-transform">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
            </div>
            <div class="mt-4 flex items-center text-xs font-medium text-emerald-600 bg-emerald-50 w-fit px-2.5 py-1 rounded-lg">
                <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>
                Stabilitas Aman
            </div>
        </div>

        <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-200/60 flex flex-col justify-between hover:shadow-md hover:border-indigo-200 transition-all group">
            <div class="flex items-start justify-between">
                <div>
                    <p class="text-sm text-slate-500 font-medium mb-1">Pemasukan (Bulan Ini)</p>
                    <p class="text-3xl font-bold text-slate-800">Rp {{ number_format($pemasukan_bulan_ini, 0, ',', '.') }}</p>
                </div>
                <div class="w-12 h-12 flex items-center justify-center rounded-xl bg-indigo-50 text-indigo-600 group-hover:scale-110 transition-transform">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>
                </div>
            </div>
            <div class="mt-4 flex items-center text-xs font-medium text-indigo-600 bg-indigo-50 w-fit px-2.5 py-1 rounded-lg">
                <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>
                Aktif Bergerak
            </div>
        </div>

        <a href="{{ route('admin.keuangan.daftarTagihan') }}" class="bg-white p-6 rounded-2xl shadow-sm border border-slate-200/60 flex flex-col justify-between hover:shadow-md hover:border-rose-300 transition-all group">
            <div class="flex items-start justify-between">
                <div>
                    <p class="text-sm text-slate-500 font-medium mb-1">Data Tunggakan</p>
                    <p class="text-3xl font-bold text-slate-800">{{ $jumlah_tunggakan }} Tagihan</p>
                </div>
                <div class="w-12 h-12 flex items-center justify-center rounded-xl bg-rose-50 text-rose-600 group-hover:scale-110 transition-transform">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                </div>
            </div>
            <div class="mt-4 w-full bg-slate-100 h-1.5 rounded-full overflow-hidden">
                <div class="bg-rose-500 h-1.5 rounded-full" style="width: {{ $jumlah_tunggakan > 0 ? '40%' : '0%' }}"></div>
            </div>
            <p class="text-xs text-slate-400 mt-2">Segera ditindaklanjuti &rarr;</p>
        </a>
    </div>

    <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-200/60 mb-8">
        <div class="flex justify-between items-center mb-4">
            <div>
                <h3 class="font-bold text-lg text-slate-800">Grafik Arus Kas</h3>
                <p class="text-sm text-slate-500">Pemasukan dan Pengeluaran</p>
            </div>
            <select class="bg-slate-50 border border-slate-200 text-slate-600 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block p-2 outline-none">
                <option>Semester Ini</option>
                <option>Tahun Ini</option>
            </select>
        </div>
        <div id="chartArusKas" class="w-full h-80"></div>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-slate-200/60 overflow-hidden">
        <div class="px-6 py-5 border-b border-slate-100 flex justify-between items-center bg-slate-50/50">
            <h3 class="font-bold text-lg text-slate-800">Riwayat Transaksi Terakhir</h3>
            <a href="{{ route('admin.keuangan.index') }}" class="text-sm font-medium text-indigo-600 hover:text-indigo-700 flex items-center gap-1">
                Lihat Buku Kas 
                <span class="text-lg">&rarr;</span>
            </a>
        </div>
        
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead>
                    <tr class="bg-white text-slate-500 text-xs uppercase tracking-wider font-semibold border-b border-slate-100">
                        <th class="px-6 py-4">Siswa / Info</th>
                        <th class="px-6 py-4">Tanggal</th>
                        <th class="px-6 py-4">Keterangan</th>
                        <th class="px-6 py-4">Nominal</th>
                        <th class="px-6 py-4 text-center">Jenis</th>
                    </tr>
                </thead>
                <tbody class="text-sm divide-y divide-slate-100">
                    @forelse($transaksi_terakhir as $trx)
                    <tr class="hover:bg-slate-50 transition-colors">
                        <td class="px-6 py-4 font-semibold text-slate-800 flex items-center gap-3">
                            <img src="https://ui-avatars.com/api/?name={{ urlencode($trx->user->nama_lengkap ?? 'K') }}&background=e0e7ff&color=4f46e5&rounded=true&bold=true" class="w-8 h-8 rounded-full">
                            {{ $trx->user->nama_lengkap ?? 'Kas Umum' }}
                        </td>
                        <td class="px-6 py-4 text-slate-500">{{ \Carbon\Carbon::parse($trx->tanggal)->translatedFormat('d M Y') }}</td>
                        <td class="px-6 py-4 text-slate-600">{{ Str::limit($trx->keterangan, 30) }}</td>
                        <td class="px-6 py-4 font-bold {{ $trx->jenis == 'Masuk' ? 'text-emerald-600' : 'text-rose-600' }}">
                            {{ $trx->jenis == 'Masuk' ? '+' : '-' }} Rp {{ number_format($trx->nominal, 0, ',', '.') }}
                        </td>
                        <td class="px-6 py-4 text-center">
                            <span class="px-2.5 py-1 rounded-md text-xs font-semibold {{ $trx->jenis == 'Masuk' ? 'bg-emerald-50 text-emerald-700 border border-emerald-200' : 'bg-rose-50 text-rose-700 border border-rose-200' }}">
                                {{ $trx->jenis }}
                            </span>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="5" class="px-6 py-10 text-center text-slate-500">Belum ada transaksi yang dicatat.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</main>

<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var options = {
            series: [{
                name: 'Uang Masuk',
                // Data diambil otomatis dari database
                data: @json($data_masuk) 
            }, {
                name: 'Uang Keluar',
                // Data diambil otomatis dari database
                data: @json($data_keluar) 
            }],
            chart: {
                height: 320,
                type: 'area',
                fontFamily: 'Inter, sans-serif',
                toolbar: { show: false },
                zoom: { enabled: false }
            },
            colors: ['#10b981', '#f43f5e'], // Emerald & Rose
            dataLabels: { enabled: false },
            stroke: { 
                curve: 'smooth', 
                width: 3 
            },
            fill: {
                type: 'gradient',
                gradient: {
                    shadeIntensity: 1,
                    opacityFrom: 0.4,
                    opacityTo: 0.05,
                    stops: [0, 90, 100]
                }
            },
            xaxis: {
                // Label bulan di sumbu X diambil dari database
                categories: @json($bulan_labels),
                axisBorder: { show: false },
                axisTicks: { show: false }
            },
            yaxis: {
                labels: {
                    formatter: function (val) {
                        return "Rp " + val.toLocaleString('id-ID');
                    }
                }
            },
            legend: { 
                position: 'top', 
                horizontalAlign: 'right' 
            },
            grid: {
                borderColor: '#f1f5f9',
                strokeDashArray: 4,
            }
        };

        var chart = new ApexCharts(document.querySelector("#chartArusKas"), options);
        chart.render();
    });
</script>
@endsection