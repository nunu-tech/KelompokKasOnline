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

require __DIR__ . '/auth.php';

// Rute Admin
// Dashboard
Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])
    ->name('admin.dashboard');
//Tampil User
Route::get('/admin/user', [UserController::class, 'index'])
    ->name('admin.user.tampiluser');
// Menampilkan halaman tambah user
Route::get('/admin/user/create', [UserController::class, 'create'])
    ->name('admin.user.create');

// Menyimpan data user
Route::post('/admin/user/store', [UserController::class, 'store'])
    ->name('admin.user.store');

// Hapus user
Route::delete('/admin/user/{id_user}', [UserController::class, 'destroy'])
    ->name('admin.user.destroy');



// Rute Wali Kelas
Route::get('walikelas/dashboard', [WaliKelasController::class, 'index'])
    ->name('walikelas.dashboard');

Route::prefix('walikelas')->group(function () {

    // Laporan
    Route::get('/laporan', [LaporanController::class, 'index'])
        ->name('walikelas.laporan');

    // Siswa
    Route::resource('siswa', SiswaController::class);

    // Pengeluaran
    Route::get('/pengeluaran', [PengeluaranController::class, 'index'])
        ->name('walikelas.pengeluaran.index');

    Route::get('/pengeluaran/create', [PengeluaranController::class, 'create'])
        ->name('walikelas.pengeluaran.create');

    Route::get('/pengeluaran/{id}/edit', [PengeluaranController::class, 'edit'])
        ->name('walikelas.pengeluaran.edit');

    Route::put('/walikelas/pengeluaran/{id}', [PengeluaranController::class, 'update'])
        ->name('walikelas.pengeluaran.update');

    Route::delete('/walikelas/pengeluaran/{id}', [PengeluaranController::class, 'destroy'])
        ->name('walikelas.pengeluaran.destroy');

    Route::post('/pengeluaran/store', [PengeluaranController::class, 'store'])
        ->name('walikelas.pengeluaran.store');
});

Route::prefix('walikelas')->name('walikelas.')->group(function () {

    Route::get('/siswa', function () {
        return "Siswa page";
    })->name('siswa.index');

    Route::get('/kas', [KasController::class, 'index'])
        ->name('kas.index');

    Route::get('/laporan', [LaporanController::class, 'index'])
        ->name('laporan');
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
