<?php

namespace App\Http\Controllers\WaliKelas;

use App\Http\Controllers\Controller;
use App\Models\Siswa;
use App\Models\Kas;
use App\Models\Pengeluaran;

class WaliKelasController extends Controller
{
    public function index()
    {
        $totalSiswa = Siswa::count();

        $kasMasuk = Kas::where('status', 'lunas')->sum('jumlah');

        $pengeluaran = Pengeluaran::sum('jumlah');

        $saldo = $kasMasuk - $pengeluaran;

        $sudahBayar = Kas::where('status', 'lunas')->count();

        $menunggak = Siswa::count() - $sudahBayar;

        return view('waliKelas.dashboard', compact(
            'totalSiswa',
            'kasMasuk',
            'pengeluaran',
            'saldo',
            'sudahBayar',
            'menunggak'
        ));
    }
}