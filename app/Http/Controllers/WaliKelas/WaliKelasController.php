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

        $kasMasuk = Kas::sum('jumlah');

        $pengeluaran = Pengeluaran::sum('jumlah');

        $saldo = $kasMasuk - $pengeluaran;

        // sementara
        $sudahBayar = 0;
        $menunggak = $totalSiswa;

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