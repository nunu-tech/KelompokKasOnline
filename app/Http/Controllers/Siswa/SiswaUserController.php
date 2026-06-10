<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\Transaksi;
use App\Models\Notifikasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SiswaUserController extends Controller
{
    // ─────────────────────────────────────────────────────────
    //  Helper: ambil notifikasi belum dibaca milik siswa login
    // ─────────────────────────────────────────────────────────
    private function getNotifikasi()
    {
        if (!Auth::check()) {
            return collect();
        }

        return Notifikasi::where('siswa_id', Auth::user()->id_user)
            ->where('is_read', 0)
            ->latest()
            ->get();
    }

    // ─────────────────────────────────────────────────────────
    //  DASHBOARD SISWA
    // ─────────────────────────────────────────────────────────
    public function dashboard()
    {
        $saldo        = Transaksi::where('jenis', 'Masuk')->sum('nominal')
            - Transaksi::where('jenis', 'Keluar')->sum('nominal');

        $totalMasuk   = Transaksi::where('jenis', 'Masuk')->sum('nominal');
        $totalKeluar  = Transaksi::where('jenis', 'Keluar')->sum('nominal');

        $transaksiTerbaru = Transaksi::latest()->take(5)->get();
        $notifikasi_siswa = $this->getNotifikasi();

        return view('siswa.dashboard', compact(
            'saldo',
            'totalMasuk',
            'totalKeluar',
            'transaksiTerbaru',
            'notifikasi_siswa'
        ));
    }

    // ─────────────────────────────────────────────────────────
    //  SALDO KAS — terhubung ke data bendahara (Transaksi model)
    // ─────────────────────────────────────────────────────────
    public function saldo()
    {
        // Agregat keseluruhan (sama sumber data bendahara)
        $total_masuk  = Transaksi::where('jenis', 'Masuk')->sum('nominal');
        $total_keluar = Transaksi::where('jenis', 'Keluar')->sum('nominal');
        $saldo_akhir  = $total_masuk - $total_keluar;

        // Pemasukan & pengeluaran bulan ini
        $masuk_bulan_ini  = Transaksi::where('jenis', 'Masuk')
            ->whereMonth('tanggal', now()->month)
            ->whereYear('tanggal', now()->year)
            ->sum('nominal');

        $keluar_bulan_ini = Transaksi::where('jenis', 'Keluar')
            ->whereMonth('tanggal', now()->month)
            ->whereYear('tanggal', now()->year)
            ->sum('nominal');

        // Riwayat saldo per bulan (kumulatif running balance)
        $riwayat_bulanan = Transaksi::selectRaw("
                DATE_FORMAT(tanggal, '%M %Y') as bulan,
                YEAR(tanggal)                 as tahun,
                MONTH(tanggal)                as bulan_num,
                SUM(CASE WHEN jenis = 'Masuk'  THEN nominal ELSE 0 END) as total_masuk,
                SUM(CASE WHEN jenis = 'Keluar' THEN nominal ELSE 0 END) as total_keluar,
                SUM(CASE WHEN jenis = 'Masuk'  THEN nominal ELSE -nominal END) as saldo_akhir
            ")
            ->groupBy('bulan', 'tahun', 'bulan_num')
            ->orderBy('tahun', 'desc')
            ->orderBy('bulan_num', 'desc')
            ->get();

        $notifikasi_siswa = $this->getNotifikasi();

        return view('siswa.saldo-kas', compact(
            'total_masuk',
            'total_keluar',
            'saldo_akhir',
            'masuk_bulan_ini',
            'keluar_bulan_ini',
            'riwayat_bulanan',
            'notifikasi_siswa'
        ));
    }

    // ─────────────────────────────────────────────────────────
    //  LAPORAN KEUANGAN — terhubung ke data bendahara
    // ─────────────────────────────────────────────────────────
    public function laporan(Request $request)
    {
        $query = Transaksi::orderBy('tanggal', 'asc');

        // Filter pencarian
        if ($request->filled('search')) {
            $query->where('keterangan', 'like', '%' . $request->search . '%');
        }
        if ($request->filled('jenis')) {
            $query->where('jenis', $request->jenis);
        }
        if ($request->filled('dari')) {
            $query->whereDate('tanggal', '>=', $request->dari);
        }
        if ($request->filled('sampai')) {
            $query->whereDate('tanggal', '<=', $request->sampai);
        }

        $laporan      = $query->get();
        $total_masuk  = $laporan->where('jenis', 'Masuk')->sum('nominal');
        $total_keluar = $laporan->where('jenis', 'Keluar')->sum('nominal');
        $saldo_periode = $total_masuk - $total_keluar;

        $notifikasi_siswa = $this->getNotifikasi();

        return view('siswa.laporan-keuangan', compact(
            'laporan',
            'total_masuk',
            'total_keluar',
            'saldo_periode',
            'notifikasi_siswa'
        ));
    }

    // ─────────────────────────────────────────────────────────
    //  RIWAYAT TRANSAKSI — dengan filter + pagination
    // ─────────────────────────────────────────────────────────
    public function riwayat(Request $request)
    {
        $query = Transaksi::orderBy('tanggal', 'desc');

        if ($request->filled('search')) {
            $query->where('keterangan', 'like', '%' . $request->search . '%');
        }
        if ($request->filled('jenis')) {
            $query->where('jenis', $request->jenis);
        }
        if ($request->filled('dari')) {
            $query->whereDate('tanggal', '>=', $request->dari);
        }
        if ($request->filled('sampai')) {
            $query->whereDate('tanggal', '<=', $request->sampai);
        }

        $transaksi = $query->paginate(15);

        $notifikasi_siswa = $this->getNotifikasi();

        return view('siswa.riwayat-saldo', compact('transaksi', 'notifikasi_siswa'));
    }

    // ─────────────────────────────────────────────────────────
    //  TANDAI SEMUA NOTIFIKASI SUDAH DIBACA (AJAX)
    // ─────────────────────────────────────────────────────────
    public function tandaiNotifDibaca()
    {
        if (Auth::check()) {
            Notifikasi::where('siswa_id', Auth::user()->id_user)
                ->where('is_read', 0)
                ->update(['is_read' => 1]);
        }

        return response()->json(['status' => 'ok']);
    }
}
