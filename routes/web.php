<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\KamarController; 
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\Admin\TransaksiController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () { return view('welcome'); });

Route::get('/dashboard', function () {
    if (auth()->user()->role === 'admin') { return redirect()->route('admin.dashboard'); }
    return redirect()->route('customer.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// AREA ADMIN
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [KamarController::class, 'adminDashboard'])->name('dashboard');
    Route::resource('kamar', KamarController::class);
    Route::get('/pengaduan', [KamarController::class, 'laporanIndex'])->name('pengaduan.index');
    Route::patch('/pengaduan/{id}', [KamarController::class, 'updateStatusLaporan'])->name('pengaduan.update');
    Route::get('/penghuni', [KamarController::class, 'kelolaPenghuni'])->name('penghuni.index');
    
    // ROUTE TRANSAKSI
    Route::get('/transaksi', [TransaksiController::class, 'index'])->name('transaksi.index');
    Route::patch('/transaksi/{id}/konfirmasi', [TransaksiController::class, 'konfirmasi'])->name('transaksi.konfirmasi');
    
    // Perbaikan nama route di sini agar sinkron dengan Blade Anda
    Route::post('/transaksi/{id}/konfirmasi-checkout', [KamarController::class, 'konfirmasiCheckout'])
        ->name('transaksi.konfirmasiCheckout');
});

// AREA CUSTOMER
Route::middleware(['auth', 'role:customer'])->prefix('customer')->name('customer.')->group(function () {
    // 1. Dashboard: Hanya untuk melihat status sewa aktif/sisa waktu
    Route::get('/dashboard', [CustomerController::class, 'index'])->name('dashboard');
    
    // 2. Cari Kamar: Route baru khusus untuk melihat daftar kamar tersedia
    Route::get('/cari-kamar', [CustomerController::class, 'cariKamar'])->name('cari-kamar');
    
    // 3. Proses Pemesanan
    Route::get('/pesan/review/{id}', [CustomerController::class, 'reviewPesanan'])->name('pesan.review');
    Route::get('/pesan/pembayaran/{id}', [CustomerController::class, 'createPesanan'])->name('pesan.create');
    Route::post('/pesan/store/{id}', [CustomerController::class, 'storePembayaran'])->name('store-pembayaran');
    
    // 4. Lainnya
    Route::get('/riwayat', [CustomerController::class, 'pesananSaya'])->name('pesan.index');
    Route::post('/checkout/{id}', [CustomerController::class, 'ajukanCheckout'])->name('checkout');
    Route::get('/pengaduan', [CustomerController::class, 'pengaduanIndex'])->name('pengaduan.index');
    Route::post('/pengaduan', [CustomerController::class, 'pengaduanStore'])->name('pengaduan.store');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';