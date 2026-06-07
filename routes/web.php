<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\KelasController;
use App\Http\Controllers\Admin\RoleController;
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




// Rute Wali Kelas



// ==========================================
// RUTE ADMIN
// ==========================================
// Dashboard
Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])
    ->name('admin.dashboard');


//USER
//Tampil User
Route::get('/admin/user', [UserController::class, 'index'])
    ->name('admin.user.tampiluser');
// Menampilkan halaman tambah user
Route::get('/admin/user/create', [UserController::class, 'create'])
    ->name('admin.user.create');
// Menyimpan data user
Route::post('/admin/user/store', [UserController::class, 'store'])
    ->name('admin.user.store');
// EDIT
Route::get('/user/{id_user}/edit', [UserController::class, 'edit'])->name('admin.user.edit');
// UPDATE
Route::put('/user/{id_user}', [UserController::class, 'update'])->name('admin.user.update');
// Hapus user
Route::delete('/admin/user/{id_user}', [UserController::class, 'destroy'])
    ->name('admin.user.destroy');

//KELAS
//Tampil Kelas
Route::get('/admin/kelas', [KelasController::class, 'index'])->name('admin.kelas.index');
//Tambah Kelas
Route::get('/admin/kelas/create', [KelasController::class, 'create'])->name('admin.kelas.create');
// Simpan Kelas
Route::post('/admin/kelas', [KelasController::class, 'store'])->name('admin.kelas.store');
// EDIT Kelas
Route::get('/admin/kelas/{id}/edit', [KelasController::class, 'edit'])->name('admin.kelas.edit');
// UPDATE Kelas
Route::put('/admin/kelas/{id}', [KelasController::class, 'update'])->name('admin.kelas.update');
// Hapus Kelas
Route::delete('/admin/kelas/{id}', [KelasController::class, 'destroy'])->name('admin.kelas.destroy');

// PERAN
Route::get('/admin/peran', [RoleController::class, 'index'])->name('admin.peran.index');
    Route::get('/admin/peran/tambah', [RoleController::class, 'create'])->name('admin.peran.create');
    Route::post('/admin/peran', [RoleController::class, 'store'])->name('admin.peran.store');
    Route::get('/admin/peran/{id}/edit', [RoleController::class, 'edit'])->name('admin.peran.edit');
    Route::put('/admin/peran/{id}', [RoleController::class, 'update'])->name('admin.peran.update');
    Route::delete('/peran/{id}', [RoleController::class, 'destroy'])->name('admin.peran.destroy');


// ==========================================
// RUTE WALI KELAS
// ==========================================

Route::prefix('walikelas')->name('walikelas.')->group(function () {

    // Dashboard Wali Kelas
    Route::get('/dashboard', [WaliKelasController::class, 'index'])->name('dashboard');

    // Manajemen Kas
    Route::get('/kas', [KasController::class, 'index'])->name('kas.index');
    Route::get('/kas/create', [KasController::class, 'create'])->name('kas.create');
    Route::post('/kas', [KasController::class, 'store'])->name('kas.store');

    Route::get('/kas/pdf', [KasController::class, 'pdf'])->name('kas.pdf');

    // Manajemen Pengeluaran
    Route::get('/pengeluaran', [PengeluaranController::class, 'index'])->name('pengeluaran.index');
    Route::post('/pengeluaran/store', [PengeluaranController::class, 'store'])->name('pengeluaran.store');

    // Laporan
    Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan');
    Route::get('/laporan/pdf', [LaporanController::class, 'pdf'])->name('laporan.pdf');


    // CRUD Siswa (Otomatis mencakup index, create, store, show, edit, update, destroy)
    Route::resource('siswa', SiswaController::class);
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
