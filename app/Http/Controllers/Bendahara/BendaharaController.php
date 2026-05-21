<?php

namespace App\Http\Controllers\Bendahara;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaksi;
use App\Models\User;
use Illuminate\Support\Facades\Auth; 
use Carbon\Carbon; // Tambahkan ini untuk urusan tanggal yang lebih mudah

class BendaharaController extends Controller
{
    public function index()
    {
        // Fitur Pengaman otomatis: Jika belum login, otomatis login menggunakan ID user pertama yang ada di database
        if (!Auth::check()) { 
            $user_tersedia = User::first();
            if ($user_tersedia) { Auth::loginUsingId($user_tersedia->id); }
        }

        $semua_transaksi = Transaksi::with('user')->latest()->get();
        $daftar_siswa = User::all();

        $total_masuk = Transaksi::where('jenis', 'Masuk')->sum('nominal');
        $total_keluar = Transaksi::where('jenis', 'Keluar')->sum('nominal');
        $saldo_akhir = $total_masuk - $total_keluar;

        return view('bendahara.index', compact('semua_transaksi', 'saldo_akhir', 'daftar_siswa'));
    }

    public function siswa()
    {
        if (!Auth::check()) { 
            $user_tersedia = User::first();
            if ($user_tersedia) { Auth::loginUsingId($user_tersedia->id); }
        }

        $daftar_siswa = User::withSum(['transaksi as total_bayar' => function($query) {
            $query->where('jenis', 'Masuk');
        }], 'nominal')->get();

        $siswa_terajin = $daftar_siswa->sortByDesc('total_bayar')->first();

        // --- Tambahan Logika Rasio Kontribusi Otomatis ---
        $total_siswa = $daftar_siswa->count();
        $siswa_aktif = $daftar_siswa->where('total_bayar', '>', 0)->count();
        $rasio_kontribusi = $total_siswa > 0 ? round(($siswa_aktif / $total_siswa) * 100) : 0;
        // -------------------------------------------------

        return view('bendahara.siswa', compact('daftar_siswa', 'siswa_terajin', 'rasio_kontribusi'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_user' => 'nullable|exists:users,id',
            'nominal' => 'required|numeric',
            'jenis' => 'required',
            'keterangan' => 'required',
            'tanggal' => 'required|date',
        ]);

        // Ambil ID user pertama yang ada di tabel sebagai cadangan jika tidak ada session login
        $user_default = User::first()->id ?? null;

        Transaksi::create([
            'id_bendahara' => Auth::id() ?? $user_default, // <--- Sudah diperbaiki secara dinamis agar tidak gagal Foreign Key
            'id_user' => $request->id_user, 
            'jenis' => $request->jenis,
            'nominal' => $request->nominal,
            'keterangan' => $request->keterangan,
            'tanggal' => $request->tanggal,
        ]);

        return redirect()->back()->with('sukses', 'Data kas berhasil dicatat!');
    }

    /**
     * Fitur Laporan Baru
     */
    public function laporan(Request $request)
    {
        if (!Auth::check()) { 
            $user_tersedia = User::first();
            if ($user_tersedia) { Auth::loginUsingId($user_tersedia->id); }
        }

        // Ambil filter dari request, defaultnya adalah bulan dan tahun sekarang
        $bulan = $request->get('bulan', date('m'));
        $tahun = $request->get('tahun', date('Y'));

        // Ambil data transaksi berdasarkan bulan dan tahun
        $laporan = Transaksi::with('user')
                    ->whereMonth('tanggal', $bulan)
                    ->whereYear('tanggal', $tahun)
                    ->orderBy('tanggal', 'asc')
                    ->get();

        // Hitung totalan untuk summary di atas tabel laporan
        $total_masuk = $laporan->where('jenis', 'Masuk')->sum('nominal');
        $total_keluar = $laporan->where('jenis', 'Keluar')->sum('nominal');
        $saldo_periode = $total_masuk - $total_keluar;

        return view('bendahara.laporan', compact(
            'laporan', 
            'total_masuk', 
            'total_keluar', 
            'saldo_periode', 
            'bulan', 
            'tahun'
        ));
    }
}