<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\KamarController; 
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\Admin\TransaksiController;
use Illuminate\Support\Facades\Route;

// 1. Landing Page
Route::get('/', function () {
    return view('welcome');
});

// 2. Dashboard Redirector (Logika pengalihan setelah login)
Route::get('/dashboard', function () {
    if (auth()->user()->role === 'admin') {
        return redirect()->route('admin.dashboard');
    }
    return redirect()->route('customer.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// 3. AREA ADMIN
Route::middleware(['auth', 'role:admin'])->group(function () {
    // Route Dashboard Admin (Hanya satu ini saja, panggil fungsi adminDashboard)
    Route::get('/admin/dashboard', [KamarController::class, 'adminDashboard'])->name('admin.dashboard');

    // CRUD Kamar
    Route::resource('admin/kamar', KamarController::class)->names([
        'index'   => 'admin.kamar.index',
        'create'  => 'admin.kamar.create',
        'store'   => 'admin.kamar.store',
        'edit'    => 'admin.kamar.edit',
        'update'  => 'admin.kamar.update',
        'destroy' => 'admin.kamar.destroy',
    ]);
    
    //Kelola Pengaduan
    Route::get('/admin/pengaduan', [App\Http\Controllers\Admin\PengaduanController::class, 'index'])->name('admin.pengaduan.index');
    Route::patch('/admin/pengaduan/{id}', [App\Http\Controllers\Admin\PengaduanController::class, 'update'])->name('admin.pengaduan.update');
    
    // Kelola Transaksi & Penghuni
    Route::get('/admin/transaksi', [TransaksiController::class, 'index'])->name('admin.transaksi.index');
    Route::get('/admin/kelola-penghuni', [KamarController::class, 'kelolaPenghuni'])->name('admin.kelola.penghuni');
    Route::patch('/admin/transaksi/{id}/konfirmasi', [TransaksiController::class, 'konfirmasi'])->name('admin.transaksi.konfirmasi');
});

// 4. AREA CUSTOMER
Route::middleware(['auth', 'role:customer'])->group(function () {
    // Halaman utama daftar kamar
    Route::get('/customer/dashboard', [CustomerController::class, 'index'])->name('customer.dashboard');
    
    // Alur Pesan: Review Detail -> Form Pembayaran -> Checkout
    Route::get('/pesan/review/{id}', [CustomerController::class, 'reviewPesanan'])->name('pesan.review');
    Route::get('/pesan/create/{id}', [CustomerController::class, 'createPesanan'])->name('customer.pesan.create');
    Route::post('/customer/checkout/{id}', [CustomerController::class, 'checkout'])->name('customer.checkout');
    
    // Riwayat Pesanan Customer
    Route::get('/customer/pesanan', [CustomerController::class, 'pesananSaya'])->name('customer.pesan.index');

    //Pengaduan Kost
    Route::get('/customer/pengaduan', [App\Http\Controllers\CustomerController::class, 'pengaduanIndex'])->name('customer.pengaduan.index');
    Route::post('/customer/pengaduan', [App\Http\Controllers\CustomerController::class, 'pengaduanStore'])->name('customer.pengaduan.store');
});

// 5. Profile Management
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';