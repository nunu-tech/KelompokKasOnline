<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaksi;
use App\Models\Tagihan;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // 1. Hitung Total Saldo Kas
        $total_masuk = Transaksi::where('jenis', 'Masuk')->sum('nominal');
        $total_keluar = Transaksi::where('jenis', 'Keluar')->sum('nominal');
        $saldo_kas = $total_masuk - $total_keluar;

        // 2. Pemasukan Bulan Ini
        $bulan_ini = Carbon::now()->month;
        $tahun_ini = Carbon::now()->year;

        $pemasukan_bulan_ini = Transaksi::where('jenis', 'Masuk')
            ->whereMonth('tanggal', $bulan_ini)
            ->whereYear('tanggal', $tahun_ini)
            ->sum('nominal');

        // 3. Jumlah Tunggakan
        $jumlah_tunggakan = Tagihan::where('status', 'Belum Bayar')->count();

        // 4. Transaksi Terakhir
        $transaksi_terakhir = Transaksi::with('user')
            ->orderBy('tanggal', 'desc')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        // 5. Data Grafik
        $bulan_labels = [];
        $data_masuk = [];
        $data_keluar = [];

        for ($i = 5; $i >= 0; $i--) {
            $bulan = Carbon::now()->subMonths($i);

            $bulan_labels[] = $bulan->translatedFormat('M');

            $masuk = Transaksi::where('jenis', 'Masuk')
                ->whereMonth('tanggal', $bulan->month)
                ->whereYear('tanggal', $bulan->year)
                ->sum('nominal');

            $data_masuk[] = (int) $masuk;

            $keluar = Transaksi::where('jenis', 'Keluar')
                ->whereMonth('tanggal', $bulan->month)
                ->whereYear('tanggal', $bulan->year)
                ->sum('nominal');

            $data_keluar[] = (int) $keluar;
        }

        return view('admin.dashboard', compact(
            'saldo_kas',
            'pemasukan_bulan_ini',
            'jumlah_tunggakan',
            'transaksi_terakhir',
            'bulan_labels',
            'data_masuk',
            'data_keluar'
        ));
    }
}