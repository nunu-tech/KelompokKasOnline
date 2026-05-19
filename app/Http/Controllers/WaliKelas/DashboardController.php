<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use App\Models\Student;
// use App\Models\Transaction;

class DashboardController extends Controller
{
    public function index()
    {
        // Simulasi data (Nantinya kamu bisa ganti dengan query Eloquent Database)
        $data = [
            'totalSiswa' => 36,
            'sudahBayar' => 28,
            'belumBayar' => 8,
            'totalUangKas' => 'Rp 1.450.000', // Nantinya gunakan number_format()
            
            // Contoh array data tabel
            'transaksiTerbaru' => [
                ['nama' => 'Ahmad Fauzi', 'tanggal' => '08 Mei 2026', 'nominal' => 20000, 'status' => 'Lunas'],
                ['nama' => 'Budi Santoso', 'tanggal' => '-', 'nominal' => 0, 'status' => 'Belum Bayar'],
            ]
        ];

        return view('dashboard', $data);
    }
}