<?php

namespace App\Http\Controllers\WaliKelas;

use App\Http\Controllers\Controller;
use App\Models\Siswa;
use App\Models\Kas;
use App\Models\Pembayaran;
use Illuminate\Support\Collection;
use Exception;

class WaliKelasController extends Controller
{
    public function index()
    {
        $totalSiswa = Siswa::count();
        $kasMasuk = Kas::sum('jumlah');

        try {
            $sudahBayar = Pembayaran::where('status', 'lunas')->count();

            $menunggak = Pembayaran::where('status', 'menunggak')->count();

            $tunggakan = Pembayaran::with('siswa')
                ->where('status', 'menunggak')
                ->latest()
                ->take(10)
                ->get();
        } catch (Exception $e) {
            $sudahBayar = 0;
            $menunggak = 0;
            $tunggakan = collect();
        }

        return view('waliKelas.dashboard', compact(
            'totalSiswa',
            'sudahBayar',
            'menunggak',
            'kasMasuk',
            'tunggakan'
        ));
    }
}