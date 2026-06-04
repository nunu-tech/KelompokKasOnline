<?php

namespace App\Http\Controllers\WaliKelas;

use App\Http\Controllers\Controller;
use App\Models\Kas;
use App\Models\Pengeluaran;

class LaporanController extends Controller
{
    public function index()
    {
        // Total pemasukan
        $totalPemasukan = Kas::sum('jumlah');

        // Total pengeluaran
        $totalPengeluaran = Pengeluaran::sum('jumlah');

        // Saldo akhir
        $saldo = $totalPemasukan - $totalPengeluaran;

        // Data pembayaran terbaru
        $kas = Kas::latest()->get();

        // Data pengeluaran terbaru
        $pengeluaran = Pengeluaran::latest()->get();

        return view('waliKelas.laporan.index', compact(
            'totalPemasukan',
            'totalPengeluaran',
            'saldo',
            'kas',
            'pengeluaran'
        ));
    }

    public function pdf()
{
    return "PDF laporan belum dibuat";
}
}