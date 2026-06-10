<?php

namespace App\Http\Controllers\WaliKelas;

use App\Http\Controllers\Controller;
use App\Models\Kas;
use App\Models\Pengeluaran;

class LaporanController extends Controller
{
    public function index()
{
    $laporan = Kas::latest()->get();

    return view('waliKelas.laporan.index', compact('laporan'));
}

    public function pdf()
{
    return "PDF laporan belum dibuat";
}
}