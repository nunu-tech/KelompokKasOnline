<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

// Admin
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\UserController;


// Wali Kelas
use App\Http\Controllers\Admin\KelasController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\KeuanganController;
use App\Http\Controllers\WaliKelas\WaliKelasController;
use App\Http\Controllers\WaliKelas\SiswaController;
use App\Http\Controllers\WaliKelas\LaporanController;
use App\Http\Controllers\WaliKelas\PengeluaranController;
use App\Http\Controllers\WaliKelas\KasController;

// [BendaharaController::class, 'index']
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
require __DIR__ . '/auth.php';


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


    // KEUANGAN
    Route::prefix('admin/keuangan')->name('admin.keuangan.')->group(function () {
        Route::get('/', [KeuanganController::class, 'index'])->name('index');
        Route::get('/laporan', [KeuanganController::class, 'laporan'])->name('laporan');
        Route::get('/verifikasi', [KeuanganController::class, 'verifikasi'])->name('verifikasi');
        Route::patch('/verifikasi/{id}/setujui', [KeuanganController::class, 'setujui'])->name('setujui');
        Route::patch('/verifikasi/{id}/tolak', [KeuanganController::class, 'tolak'])->name('tolak');
        // URL: /admin/keuangan/tambah (Untuk menampilkan halaman form)
        Route::get('/tambah', [KeuanganController::class, 'create'])->name('create');

        // URL: /admin/keuangan/simpan (Untuk memproses data form ke database)
        Route::post('/simpan', [KeuanganController::class, 'store'])->name('store');
        // URL: /admin/keuangan/tagihan (Untuk menampilkan form tagihan)
        Route::get('/tagihan', [KeuanganController::class, 'tagihan'])->name('tagihan');

        // URL: /admin/keuangan/tagihan/kirim (Untuk memproses tagihan)
        Route::post('/tagihan/kirim', [KeuanganController::class, 'kirimTagihan'])->name('kirimTagihan');

        // URL: /admin/keuangan/daftar-tagihan (Melihat semua tagihan)
        Route::get('/daftar-tagihan', [KeuanganController::class, 'daftarTagihan'])->name('daftarTagihan');

        // URL: /admin/keuangan/tagihan/acc/{id} (Aksi tombol ACC)
        Route::post('/tagihan/acc/{id_tagihan}', [KeuanganController::class, 'accTagihan'])->name('accTagihan');
    });


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
    }); // tutup walikelas

}); // tutup auth + verified

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
        // 1. Halaman Dashboard Utama
        Route::get('/bendahara', [BendaharaController::class, 'index'])->name('bendahara.index');

        Route::get('/bendahara/siswa', [BendaharaController::class, 'siswa'])->name('bendahara.siswa');

        Route::get('/bendahara/laporan', [BendaharaController::class, 'laporan'])->name('bendahara.laporan');

        Route::post('/bendahara/store', [BendaharaController::class, 'store'])->name('bendahara.store');

        Route::get('/bendahara/transaksi/{id}/edit', [BendaharaController::class, 'edit'])->name('bendahara.transaksi.edit');

        Route::put('/bendahara/update/{id}', [BendaharaController::class, 'update'])->name('bendahara.update');

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

        Route::get('/', [BendaharaController::class, 'index'])
            ->name('index');

        Route::get('/siswa', [BendaharaController::class, 'siswa'])
            ->name('siswa');

        Route::get('/laporan', [BendaharaController::class, 'laporan'])
            ->name('laporan');

        Route::post('/store', [BendaharaController::class, 'store'])
            ->name('store');

        Route::get('/transaksi/{id}/edit', [BendaharaController::class, 'edit'])
            ->name('transaksi.edit');

        Route::put('/update/{id}', [BendaharaController::class, 'update'])
            ->name('update');

        Route::delete('/hapus/{id}', [BendaharaController::class, 'destroy'])
            ->name('transaksi.destroy');

        Route::get('/verifikasi', [BendaharaController::class, 'verifikasi'])
            ->name('verifikasi');

        Route::patch('/verifikasi/{id}/setujui', [BendaharaController::class, 'setujui'])
            ->name('setujui');

        Route::patch('/verifikasi/{id}/tolak', [BendaharaController::class, 'tolak'])
            ->name('tolak');

        Route::get('/{id}', [BendaharaController::class, 'show'])
            ->name('show');
    });
/*
|--------------------------------------------------------------------------
| Auth Routes
|--------------------------------------------------------------------------
*/

require __DIR__ . '/auth.php';
