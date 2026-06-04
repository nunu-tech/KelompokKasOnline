<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\UserController;

use App\Http\Controllers\WaliKelas\WaliKelasController;
use App\Http\Controllers\WaliKelas\SiswaController;
use App\Http\Controllers\WaliKelas\LaporanController;
use App\Http\Controllers\WaliKelas\PengeluaranController;
use App\Http\Controllers\WaliKelas\KasController;

use App\Http\Controllers\Bendahara\BendaharaController;



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

// Rute Admin
Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])
    ->name('admin.dashboard');

Route::get('/admin/user', [UserController::class, 'index'])
    ->name('admin.user.tampiluser');



// Rute Wali Kelas
Route::get('walikelas/dashboard', [WaliKelasController::class, 'index'])
    ->name('walikelas.dashboard');

Route::prefix('walikelas')->name('walikelas.')->group(function () {

    // DASHBOARD
    Route::get('/dashboard', [WaliKelasController::class, 'index'])
        ->name('dashboard');

    // KAS
    Route::get('/kas', [KasController::class, 'index'])->name('kas.index');
    Route::get('/kas/create', [KasController::class, 'create'])->name('kas.create');
    Route::post('/kas', [KasController::class, 'store'])->name('kas.store');

    // PENGELUARAN
    Route::get('/pengeluaran', [PengeluaranController::class, 'index'])->name('pengeluaran.index');
    Route::post('/pengeluaran/store', [PengeluaranController::class, 'store'])->name('pengeluaran.store');

    // LAPORAN
    Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan');
    Route::get('/laporan/pdf', [LaporanController::class, 'pdf'])->name('laporan.pdf');

    // SISWA
    Route::resource('siswa', SiswaController::class);
});

Route::prefix('walikelas')->name('walikelas.')->group(function () {

    Route::get('/siswa', function () {
        return "Siswa page";
    })->name('siswa.index');

    Route::get('/kas', [KasController::class, 'index'])
        ->name('kas.index');

    Route::get('/laporan', [LaporanController::class, 'index'])
        ->name('laporan');

    Route::post('/kas', [KasController::class, 'store'])->name('kas.store'); 
});

// Group rute Bendahara
Route::prefix('bendahara')->group(function () {
    
    // 1. Halaman Dashboard Utama
    Route::get('/', [BendaharaController::class, 'index'])->name('bendahara.index');

    // 2. Halaman Daftar Siswa
    Route::get('/siswa', [BendaharaController::class, 'siswa'])->name('bendahara.siswa');

    // 3. Halaman Laporan
    Route::get('/laporan', [BendaharaController::class, 'laporan'])->name('bendahara.laporan');

    // 4. Simpan transaksi baru
    Route::post('/store', [BendaharaController::class, 'store'])->name('bendahara.store');

    // 5. Lembar Halaman Edit Transaksi
    Route::get('/transaksi/{id}/edit', [BendaharaController::class, 'edit'])->name('bendahara.transaksi.edit');

    // 6. Proses Update data transaksi ke database
    Route::put('/update/{id}', [BendaharaController::class, 'update'])->name('bendahara.update');

    // 7. Hapus transaksi
    Route::delete('/hapus/{id}', [BendaharaController::class, 'destroy'])->name('bendahara.transaksi.destroy');


    // 8. Detail transaksi (Tetap di paling bawah grup bendahara)

    //  RUTE BARU: 8. Halaman Antrean Verifikasi Setoran Siswa
    Route::get('/verifikasi', [BendaharaController::class, 'verifikasi'])->name('bendahara.verifikasi');

    //  RUTE BARU: 9. Proses Verifikasi / Menyetujui Pembayaran
    Route::patch('/verifikasi/{id}/setujui', [BendaharaController::class, 'setujui'])->name('bendahara.setujui');

    //  RUTE BARU: 10. Proses Menolak Pembayaran yang Bermasalah
    Route::patch('/verifikasi/{id}/tolak', [BendaharaController::class, 'tolak'])->name('bendahara.tolak');

    // 8. Detail transaksi (Tetap di paling bawah agar tidak bentrok dengan parameter rute lain)

    Route::get('/{id}', [BendaharaController::class, 'show'])->name('bendahara.show');

});