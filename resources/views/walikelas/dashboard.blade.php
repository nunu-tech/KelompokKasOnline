@extends('layouts.app')

@section('title', 'Dashboard - Overview')

@section('content')
    <div class="mb-8 flex flex-col md:flex-row md:items-end justify-between gap-4">
        <div>
            <h2 class="text-2xl font-bold text-navy">Overview Kas Kelas</h2>
            <p class="text-slate-500 text-sm mt-1">Pantau perkembangan dana kas dan status siswa bulan ini.</p>
        </div>
        <button class="bg-emerald hover:bg-emerald-600 text-white px-5 py-2.5 rounded-xl text-sm font-medium transition-all shadow-lg shadow-emerald/20 flex items-center gap-2">
            <i class="ph ph-plus-circle text-lg"></i> Tambah Transaksi
        </button>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm hover:shadow-md hover:-translate-y-1 transition-all group">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-slate-500 text-sm font-medium">Total Siswa</p>
                    <h3 class="text-3xl font-bold text-navy mt-2">{{ $totalSiswa ?? 0 }}</h3>
                </div>
                <div class="w-12 h-12 rounded-xl bg-blue-50 text-blue-500 flex items-center justify-center group-hover:bg-blue-500 group-hover:text-white transition-colors">
                    <i class="ph ph-users-three text-2xl"></i>
                </div>
            </div>
        </div>
        
        </div>

    @endsection

@push('scripts')
<script>
    // Taruh script Chart.js di sini agar hanya diload saat halaman dashboard dibuka
    const ctx = document.getElementById('kasChart').getContext('2d');
    // ... sisa konfigurasi chart ...
</script>
@endpush