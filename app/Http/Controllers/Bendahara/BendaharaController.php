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
        if (!Auth::check()) { Auth::loginUsingId(1); }

        $semua_transaksi = Transaksi::with('user')->latest()->get();
        $daftar_siswa = User::all();

        $total_masuk = Transaksi::where('jenis', 'Masuk')->sum('nominal');
        $total_keluar = Transaksi::where('jenis', 'Keluar')->sum('nominal');
        $saldo_akhir = $total_masuk - $total_keluar;

        return view('bendahara.index', compact('semua_transaksi', 'saldo_akhir', 'daftar_siswa'));
    }

    public function siswa()
    {
        if (!Auth::check()) { Auth::loginUsingId(1); }

        $daftar_siswa = User::withSum(['transaksi as total_bayar' => function($query) {
            $query->where('jenis', 'Masuk');
        }], 'nominal')->get();

        $siswa_terajin = $daftar_siswa->sortByDesc('total_bayar')->first();

        return view('bendahara.siswa', compact('daftar_siswa', 'siswa_terajin'));
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

        Transaksi::create([
            'id_bendahara' => Auth::id() ?? 1, 
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
        if (!Auth::check()) { Auth::loginUsingId(1); }

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