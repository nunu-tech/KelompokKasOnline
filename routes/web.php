<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;

Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

// Group rute Bendahara agar pengelolaan URL lebih mudah
Route::prefix('bendahara')->group(function () {
    
    // 1. Halaman utama (Menampilkan Tabel & Saldo)
    Route::get('/', [BendaharaController::class, 'index'])->name('bendahara.index');

    // 2. Simpan transaksi baru (Create)
    Route::post('/store', [BendaharaController::class, 'store'])->name('bendahara.store');

    // 3. Lihat detail transaksi (Read/Show) - UNTUK TOMBOL DETAIL
    Route::get('/{id}', [BendaharaController::class, 'show'])->name('bendahara.show');

    // 4. Update transaksi (Update) - UNTUK EDIT NANTI
    Route::put('/update/{id}', [BendaharaController::class, 'update'])->name('bendahara.update');

    // 5. Hapus transaksi (Delete)
    Route::delete('/hapus/{id}', [BendaharaController::class, 'destroy'])->name('bendahara.destroy');

});
