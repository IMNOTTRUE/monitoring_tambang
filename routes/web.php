<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserDashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PengirimanController;
use App\Http\Controllers\PenerimaanController;
use App\Http\Controllers\PengeringanController;
use App\Http\Controllers\SerahTerimaController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\KasKeuanganController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\PekerjaController;
use App\Http\Controllers\CctvController;
use App\Http\Controllers\PembayaranOperasionalController;
use App\Http\Controllers\PembayaranGajiController;
/*
|--------------------------------------------------------------------------
| HOME
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return redirect()->route('login');
});

require __DIR__.'/auth.php';

/*
|--------------------------------------------------------------------------
| SEMUA USER LOGIN (ADMIN + PEKERJA)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {

    Route::resource('pengiriman', PengirimanController::class);
    Route::resource('penerimaan', PenerimaanController::class);
    Route::resource('pengeringan', PengeringanController::class);
    Route::resource('serah-terima', SerahTerimaController::class);

    Route::resource('cctv', CctvController::class)->only(['index']);

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    
});

/*
|--------------------------------------------------------------------------
| ADMIN ONLY
|--------------------------------------------------------------------------
*/
Route::middleware(['auth','role:admin'])->group(function () {
Route::get('/notif-data', function () {
    return \App\Models\Notifikasi::latest()->take(5)->get();
});
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');
    Route::post('/notif/{id}/baca', function ($id) {
    \App\Models\Notifikasi::find($id)->update([
        'dibaca' => true
    ]);

    return back();
})->name('notif.baca');
    Route::get('/dashboard-export', [DashboardController::class, 'export'])->name('dashboard.export');
    Route::get('/pembayaran', [PembayaranController::class, 'index'])->name('pembayaran.index');
    Route::get('/pembayaran/create/{id}', [PembayaranController::class, 'create'])->name('pembayaran.create');
    Route::post('/pembayaran', [PembayaranController::class, 'store'])->name('pembayaran.store');
    
    Route::resource('kas', KasKeuanganController::class);
    Route::get('/kas', [KasKeuanganController::class, 'index'])->name('kas.index');
    Route::get('/kas/create', [KasKeuanganController::class, 'create'])->name('kas.create');
    Route::post('/kas', [KasKeuanganController::class, 'store'])->name('kas.store');
    Route::get('/kas-export', [KasKeuanganController::class, 'export'])->name('kas.export');
    
    Route::resource('pekerja', PekerjaController::class);
    Route::resource('cctv', CctvController::class)->only(['create','store','destroy']);

    Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');
    Route::resource('operasional', PembayaranOperasionalController::class);
    Route::resource('gaji', PembayaranGajiController::class);
    Route::post('/gaji', [PembayaranGajiController::class, 'store'])->name('gaji.store');

});

/*
|--------------------------------------------------------------------------
| USER / PEKERJA ONLY
|--------------------------------------------------------------------------
*/
Route::middleware(['auth','role:user'])->group(function () {

    Route::get('/user-dashboard', [UserDashboardController::class, 'index'])
        ->name('user.dashboard');

});