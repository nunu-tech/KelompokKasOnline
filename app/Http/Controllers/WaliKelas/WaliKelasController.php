<?php

namespace App\Http\Controllers\WaliKelas;

use App\Http\Controllers\Controller;
use App\Models\Pembayaran;
use App\Models\Transaksi;

class WaliKelasController extends Controller
{
    public function index()
{
    return view('waliKelas.dashboard');
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