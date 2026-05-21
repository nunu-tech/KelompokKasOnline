<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
<<<<<<< HEAD

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
=======
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Bendahara\BendaharaController;

Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

// Group rute Bendahara
Route::prefix('bendahara')->group(function () {
    
    // 1. Halaman Dashboard Utama
    Route::get('/', [BendaharaController::class, 'index'])->name('bendahara.index');

    // 2. Halaman Daftar Siswa
    Route::get('/siswa', [BendaharaController::class, 'siswa'])->name('bendahara.siswa');

    // 3. Halaman Laporan (TAMBAHKAN DI SINI)
    Route::get('/laporan', [BendaharaController::class, 'laporan'])->name('bendahara.laporan');

    // 4. Simpan transaksi baru
    Route::post('/store', [BendaharaController::class, 'store'])->name('bendahara.store');

    // 5. Update transaksi
    Route::put('/update/{id}', [BendaharaController::class, 'update'])->name('bendahara.update');

    // 6. Hapus transaksi
    Route::delete('/hapus/{id}', [BendaharaController::class, 'destroy'])->name('bendahara.destroy');

    // 7. Detail transaksi (Tetap di paling bawah)
    Route::get('/{id}', [BendaharaController::class, 'show'])->name('bendahara.show');

});
>>>>>>> ad41cc6f72428be06f3b5b9f5322077bbec4250b
