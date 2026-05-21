<?php

namespace App\Http\Controllers\WaliKelas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class WaliKelasController extends Controller
{
    public function index()
    {
        $data = [
            'totalSiswa' => 36,
            'kasMasuk' => 2500000,
            'pengeluaran' => 750000,
            'saldo' => 1750000,
        ];

        return view('walikelas.dashboard', $data);
    }
}