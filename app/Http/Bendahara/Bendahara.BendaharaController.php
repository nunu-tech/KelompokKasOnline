<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;
use App\Models\User; // Ditambahkan agar bisa mengambil daftar nama siswa
use Illuminate\Support\Facades\Auth; 

class BendaharaController extends Controller
{
    // TAMPILKAN DATA (Halaman Utama)
    public function index()
    {
        // Bypass Login: Menganggap Melani (ID 1) yang sedang mengelola kas
        if (!Auth::check()) {
            Auth::loginUsingId(1);
        }

        /** * LOGIKA: Mengambil transaksi beserta data USER (Eager Loading)
         * Dengan 'with', kita bisa panggil nama siswa di tampilan tanpa error
         */
        $semua_transaksi = Transaksi::with('user')->latest()->get();
        
        // Mengambil daftar semua siswa untuk isi dropdown di form input
        $daftar_siswa = User::all();

        // Menghitung Saldo Otomatis
        $total_masuk = Transaksi::where('jenis', 'Masuk')->sum('nominal');
        $total_keluar = Transaksi::where('jenis', 'Keluar')->sum('nominal');
        $saldo_akhir = $total_masuk - $total_keluar;

        // Kirim semua variabel ke view
        return view('bendahara.index', compact('semua_transaksi', 'saldo_akhir', 'daftar_siswa'));
    }

    // SIMPAN DATA (CREATE)
    public function store(Request $request)
    {
        if (!Auth::check()) {
            Auth::loginUsingId(1);
        }

        // Validasi input
        $request->validate([
            'id_user' => 'nullable|exists:users,id_user', // Siswa yang bayar
            'nominal' => 'required|numeric',
            'jenis' => 'required',
            'keterangan' => 'required',
            'tanggal' => 'required|date',
        ]);

        // Simpan ke database
        Transaksi::create([
            'id_bendahara' => Auth::id(), 
            'id_user' => $request->id_user, 
            'jenis' => $request->jenis,
            'nominal' => $request->nominal,
            'keterangan' => $request->keterangan,
            'tanggal' => $request->tanggal,
        ]);

        return redirect()->back()->with('sukses', 'Data kas berhasil dicatat!');
    }

    // LIHAT DETAIL (READ SATU DATA)
    public function show($id)
    {
        // Mencari data transaksi dan nama siswanya untuk ditampilkan di pop-up/detail
        $transaksi = Transaksi::with('user')->findOrFail($id);
        
        // Biasanya untuk detail kita lempar ke halaman detail atau modal
        return view('bendahara.show', compact('transaksi'));
    }

    // UPDATE DATA (EDIT)
    public function update(Request $request, $id)
    {
        $transaksi = Transaksi::findOrFail($id);
        
        $transaksi->update($request->all());

        return redirect()->back()->with('sukses', 'Data kas berhasil diubah!');
    }

    // HAPUS DATA (DELETE)
    public function destroy($id)
    {
        $transaksi = Transaksi::findOrFail($id);
        $transaksi->delete();

        return redirect()->back()->with('sukses', 'Data berhasil dihapus!');
    }
}
