<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;

// Admin
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\UserController;

// Wali Kelas
use App\Http\Controllers\WaliKelas\WaliKelasController;
use App\Http\Controllers\WaliKelas\SiswaController;
use App\Http\Controllers\WaliKelas\LaporanController;
use App\Http\Controllers\WaliKelas\PengeluaranController;
use App\Http\Controllers\WaliKelas\KasController;

// Bendahara
use App\Http\Controllers\Bendahara\BendaharaController;

// Logout
Route::get('/logout', function (Request $request) {
    Auth::logout();

    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect('/login');
});

/*
|--------------------------------------------------------------------------
| Landing Page
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('LandingPage.LandingPage');
})->name('landing');

/*
|--------------------------------------------------------------------------
| Profile (Laravel Breeze)
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/*
|--------------------------------------------------------------------------
| Dashboard Per Role
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'verified'])->group(function () {

    // ADMIN
    Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])
        ->middleware('role:admin')
        ->name('admin.dashboard');

    // SISWA
    Route::get('/siswa/dashboard', function () {
        return view('siswa.dashboard');
    })
        ->middleware('role:siswa')
        ->name('siswa.dashboard');

    // WALI KELAS
    Route::get('/walikelas/dashboard', [WaliKelasController::class, 'index'])
        ->middleware('role:walikelas')
        ->name('walikelas.dashboard');

    // BENDAHARA
    Route::get('/bendahara/dashboard', [BendaharaController::class, 'index'])
        ->middleware('role:bendahara')
        ->name('bendahara.dashboard');
});

/*
|--------------------------------------------------------------------------
| ADMIN
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::get('/user', [UserController::class, 'index'])
            ->name('user.tampiluser');
    });

/*
|--------------------------------------------------------------------------
| WALI KELAS
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:walikelas'])
    ->prefix('walikelas')
    ->name('walikelas.')
    ->group(function () {

        // Dashboard
        Route::get('/dashboard', [WaliKelasController::class, 'index'])
            ->name('dashboard');

        // Kas
        Route::get('/kas', [KasController::class, 'index'])
            ->name('kas.index');

        Route::get('/kas/create', [KasController::class, 'create'])
            ->name('kas.create');

        Route::post('/kas', [KasController::class, 'store'])
            ->name('kas.store');

        Route::get('/kas/pdf', [KasController::class, 'pdf'])
            ->name('kas.pdf');

        // Pengeluaran
        Route::get('/pengeluaran', [PengeluaranController::class, 'index'])
            ->name('pengeluaran.index');

        Route::post('/pengeluaran/store', [PengeluaranController::class, 'store'])
            ->name('pengeluaran.store');

        // Laporan
        Route::get('/laporan', [LaporanController::class, 'index'])
            ->name('laporan');

        Route::get('/laporan/pdf', [LaporanController::class, 'pdf'])
            ->name('laporan.pdf');

        // CRUD Siswa
        Route::resource('siswa', SiswaController::class);
    });

/*
|--------------------------------------------------------------------------
| BENDAHARA
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:bendahara'])
    ->prefix('bendahara')
    ->name('bendahara.')
    ->group(function () {

        // Dashboard
        Route::get('/', [BendaharaController::class, 'index'])
            ->name('index');

        // Data Siswa
        Route::get('/siswa', [BendaharaController::class, 'siswa'])
            ->name('siswa');

        // Laporan
        Route::get('/laporan', [BendaharaController::class, 'laporan'])
            ->name('laporan');

        // Simpan transaksi
        Route::post('/store', [BendaharaController::class, 'store'])
            ->name('store');

        // Edit transaksi
        Route::get('/transaksi/{id}/edit', [BendaharaController::class, 'edit'])
            ->name('transaksi.edit');

        // Update transaksi
        Route::put('/update/{id}', [BendaharaController::class, 'update'])
            ->name('update');

        // Hapus transaksi
        Route::delete('/hapus/{id}', [BendaharaController::class, 'destroy'])
            ->name('transaksi.destroy');

        // Verifikasi pembayaran
        Route::get('/verifikasi', [BendaharaController::class, 'verifikasi'])
            ->name('verifikasi');

        Route::patch('/verifikasi/{id}/setujui', [BendaharaController::class, 'setujui'])
            ->name('setujui');

        Route::patch('/verifikasi/{id}/tolak', [BendaharaController::class, 'tolak'])
            ->name('tolak');

        // Detail transaksi (harus paling bawah)
        Route::get('/{id}', [BendaharaController::class, 'show'])
            ->name('show');
    });

/*
|--------------------------------------------------------------------------
| Auth Routes
|--------------------------------------------------------------------------
*/

require __DIR__ . '/auth.php';
