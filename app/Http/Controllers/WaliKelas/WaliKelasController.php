<?php

namespace App\Http\Controllers\WaliKelas;

use App\Http\Controllers\Controller;
use App\Models\Siswa;
use App\Models\Kas;
use App\Models\Pembayaran;
use App\Models\Pengeluaran;

class WaliKelasController extends Controller
{
    public function index()
{
    $totalSiswa = Siswa::count();

    $sudahBayar = Pembayaran::where('status', 'lunas')->count();

    $menunggak = Pembayaran::where('status', 'menunggak')->count();

    $kasMasuk = Kas::sum('jumlah');

    // data tunggakan untuk tabel
    $tunggakan = Pembayaran::with('siswa')
        ->where('status', 'menunggak')
        ->latest()
        ->take(10)
        ->get();

    return view('waliKelas.dashboard', compact(
        'totalSiswa',
        'sudahBayar',
        'menunggak',
        'kasMasuk',
        'tunggakan'
    ));
}
}