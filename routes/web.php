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

// Rute Utama / Dashboard Default
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Rute Profile User (Breeze/Jetstream)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';


// ==========================================
// RUTE ADMIN
// ==========================================
Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
Route::get('/admin/user', [UserController::class, 'index'])->name('admin.user.tampiluser');


// ==========================================
// RUTE WALI KELAS
// ==========================================
Route::prefix('walikelas')->name('walikelas.')->group(function () {

    // Dashboard Wali Kelas
    Route::get('/dashboard', [WaliKelasController::class, 'index'])->name('dashboard');

    Route::post('/ingatkan/{id}', [WaliKelasController::class, 'ingatkan'])
        ->name('ingatkan');

    // Manajemen Kas
    Route::get('/kas', [KasController::class, 'index'])->name('kas.index');
    Route::get('/kas/create', [KasController::class, 'create'])->name('kas.create');
    Route::post('/kas', [KasController::class, 'store'])->name('kas.store');

    Route::get('/kas/pdf', [KasController::class, 'pdf'])->name('kas.pdf');

    // Manajemen Pengeluaran
    Route::get('/pengeluaran', [PengeluaranController::class, 'index'])->name('pengeluaran.index');
    Route::post('/pengeluaran/store', [PengeluaranController::class, 'store'])->name('pengeluaran.store');
    Route::get('/pengeluaran/create', [PengeluaranController::class, 'create'])
         ->name('pengeluaran.create');

    Route::get('/pengeluaran/{id}/edit', [PengeluaranController::class, 'edit'])
        ->name('pengeluaran.edit');

    Route::put('/pengeluaran/{id}', [PengeluaranController::class, 'update'])
        ->name('pengeluaran.update');

    Route::delete('/pengeluaran/{id}', [PengeluaranController::class, 'destroy'])
        ->name('pengeluaran.destroy');

    // Laporan
    Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan');
    Route::get('/laporan/pdf', [LaporanController::class, 'pdf'])->name('laporan.pdf');

    // Tunggakan
Route::get('/tunggakan', [WaliKelasController::class, 'tunggakan'])
    ->name('tunggakan');

// Pengumuman
Route::get('/pengumuman', [WaliKelasController::class, 'pengumuman'])
    ->name('pengumuman');


    // ==========================================
// CRUD SISWA
// ==========================================

// Tampil daftar siswa
Route::get('/siswa', [SiswaController::class, 'index'])
    ->name('siswa.index');

// Form tambah siswa
Route::get('/siswa/create', [SiswaController::class, 'create'])
    ->name('siswa.create');

// Simpan siswa baru
Route::post('/siswa', [SiswaController::class, 'store'])
    ->name('siswa.store');

// Form edit siswa
Route::get('/siswa/{id}/edit', [SiswaController::class, 'edit'])
    ->name('siswa.edit');

// Update siswa
Route::put('/siswa/{id}', [SiswaController::class, 'update'])
    ->name('siswa.update');

// Hapus siswa
Route::delete('/siswa/{id}', [SiswaController::class, 'destroy'])
    ->name('siswa.destroy');
});


// ==========================================
// RUTE BENDAHARA
// ==========================================
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

    // 8. Halaman Antrean Verifikasi Setoran Siswa
    Route::get('/verifikasi', [BendaharaController::class, 'verifikasi'])->name('bendahara.verifikasi');

    // 9. Proses Verifikasi / Menyetujui Pembayaran
    Route::patch('/verifikasi/{id}/setujui', [BendaharaController::class, 'setujui'])->name('bendahara.setujui');

    // 10. Proses Menolak Pembayaran yang Bermasalah
    Route::patch('/verifikasi/{id}/tolak', [BendaharaController::class, 'tolak'])->name('bendahara.tolak');

    // 11. Detail transaksi (Wajib paling bawah agar tidak memblokir rute text / rute lain)
    Route::get('/{id}', [BendaharaController::class, 'show'])->name('bendahara.show');
});
