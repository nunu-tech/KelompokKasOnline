<?php

namespace App\Http\Controllers\WaliKelas;

use App\Http\Controllers\Controller;
use App\Models\Siswa;
use App\Models\Kas;
use App\Models\Pembayaran;
use App\Models\Pengeluaran;
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

            $totalPengeluaran = Pengeluaran::sum('jumlah');

            $saldoKas = $kasMasuk - $totalPengeluaran;

            $aktivitas = Pengeluaran::latest()
                ->take(5)
                ->get();
        } catch (Exception $e) {

            $sudahBayar = 0;
            $menunggak = 0;
            $tunggakan = collect();
        }

        $persentase = $totalSiswa > 0
            ? round(($sudahBayar / $totalSiswa) * 100)
            : 0;

        return view('waliKelas.dashboard', compact(
            'totalSiswa',
            'sudahBayar',
            'menunggak',
            'kasMasuk',
            'tunggakan',
            'persentase',
            'totalPengeluaran',
            'saldoKas',
            'aktivitas'
        ));
    }

    public function tunggakan()
{
    $tunggakan = Pembayaran::with('siswa')
        ->where('status', 'menunggak')
        ->latest()
        ->get();

    return view('walikelas.tunggakan.index', compact('tunggakan'));
}

    public function pengumuman()
    {
        return view('walikelas.pengumuman.index');
    }

}
