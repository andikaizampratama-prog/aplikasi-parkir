
<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ParkirController;
use App\Http\Controllers\KendaraanController;
use App\Http\Controllers\TarifController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\ValidasiController;
use App\Http\Controllers\NotifikasiController;
use App\Http\Controllers\LogAktivitasController;
use App\Http\Controllers\AreaParkirController;
use App\Http\Controllers\Admin\UserController;

/*
|--------------------------------------------------------------------------
| Halaman Utama
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    if (!Auth::check()) {
        return redirect()->route('login');
    }

    $role = Auth::user()->role;

    if ($role === 'admin') {
        return redirect()->route('admin.dashboard');
    }

    if ($role === 'petugas') {
        return redirect()->route('petugas.dashboard');
    }

    if ($role === 'owner') {
        return redirect()->route('owner.dashboard');
    }

    Auth::logout();

    return redirect()->route('login');
});

/*
|--------------------------------------------------------------------------
| Authentication
|--------------------------------------------------------------------------
*/

Route::middleware('guest')->group(function () {

    Route::get('/login', [AuthController::class, 'login'])
        ->name('login');

    Route::post('/login', [AuthController::class, 'authenticate'])
        ->name('login.process');

    Route::get('/register', [AuthController::class, 'register'])
        ->name('register');

    Route::post('/register', [AuthController::class, 'store'])
        ->name('register.process');

});

Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

/*
|--------------------------------------------------------------------------
| Notifikasi Semua Role
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    Route::get('/notifikasi', [NotifikasiController::class, 'index'])
        ->name('notifikasi.index');

    Route::post('/notifikasi/{notifikasi}/baca', [NotifikasiController::class, 'baca'])
        ->name('notifikasi.baca');

    Route::post('/notifikasi/baca-semua', [NotifikasiController::class, 'bacaSemua'])
        ->name('notifikasi.baca-semua');

});

/*
|--------------------------------------------------------------------------
| ADMIN
|--------------------------------------------------------------------------
*/

Route::prefix('admin')
    ->name('admin.')
    ->middleware(['auth', 'role:admin'])
    ->group(function () {

        // Dashboard
        Route::get('/dashboard', [DashboardController::class, 'index'])
            ->name('dashboard');

        // CRUD Anggota / User
        Route::resource('anggota', UserController::class)
            ->parameters(['anggota' => 'anggota']);

        // Data Kendaraan
        Route::resource('kendaraan', KendaraanController::class);

        // CRUD Area Parkir
        Route::resource('area-parkir', AreaParkirController::class)
            ->parameters(['area-parkir' => 'areaParkir'])
            ->names('area-parkir');

        // Data Parkir
        Route::resource('parkir', ParkirController::class);

        // Kendaraan Keluar
        Route::post('/parkir/{parkir}/keluar', [ParkirController::class, 'keluar'])
            ->name('parkir.keluar');

        // Cetak Tiket
        Route::get('/parkir/{parkir}/cetak', [ParkirController::class, 'cetak'])
            ->name('parkir.cetak');

        // Tarif
        Route::get('/tarif', [TarifController::class, 'index'])
            ->name('tarif.index');

        Route::put('/tarif/{tarif}', [TarifController::class, 'update'])
            ->name('tarif.update');

        // Laporan
        Route::get('/laporan', [LaporanController::class, 'index'])
            ->name('laporan.index');

        // Validasi Transaksi
        Route::get('/validasi', [ValidasiController::class, 'index'])
            ->name('validasi.index');

        Route::post('/validasi/{validasi}/setujui', [ValidasiController::class, 'setujui'])
            ->name('validasi.setujui');

        Route::post('/validasi/{validasi}/tolak', [ValidasiController::class, 'tolak'])
            ->name('validasi.tolak');

        // Log Aktivitas
        Route::get('/log-aktivitas', [LogAktivitasController::class, 'index'])
            ->name('log-aktivitas.index');

});

/*
|--------------------------------------------------------------------------
| PETUGAS
|--------------------------------------------------------------------------
*/

Route::prefix('petugas')
    ->name('petugas.')
    ->middleware(['auth', 'role:petugas'])
    ->group(function () {

        // Dashboard
        Route::get('/dashboard', [DashboardController::class, 'index'])
            ->name('dashboard');

        // Data Parkir
        Route::get('/parkir', [ParkirController::class, 'index'])
            ->name('parkir.index');

        // Kendaraan Masuk
        Route::get('/parkir/create', [ParkirController::class, 'create'])
            ->name('parkir.create');

        Route::post('/parkir', [ParkirController::class, 'store'])
            ->name('parkir.store');

        // Detail Parkir
        Route::get('/parkir/{parkir}', [ParkirController::class, 'show'])
            ->name('parkir.show');

        // Kendaraan Keluar
        Route::post('/parkir/{parkir}/keluar', [ParkirController::class, 'keluar'])
            ->name('parkir.keluar');

        // Cetak Tiket
        Route::get('/parkir/{parkir}/cetak', [ParkirController::class, 'cetak'])
            ->name('parkir.cetak');

});

/*
|--------------------------------------------------------------------------
| OWNER
|--------------------------------------------------------------------------
*/

Route::prefix('owner')
    ->name('owner.')
    ->middleware(['auth', 'role:owner'])
    ->group(function () {

        // Dashboard
        Route::get('/dashboard', [DashboardController::class, 'index'])
            ->name('dashboard');

        // Laporan Parkir
        Route::get('/laporan', [LaporanController::class, 'index'])
            ->name('laporan.index');

        // Rekap Transaksi
        Route::get('/rekap-transaksi', [LaporanController::class, 'rekapTransaksi'])
            ->name('rekap-transaksi.index');

});
