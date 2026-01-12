<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaksi;
use Illuminate\Http\Request;


class TransaksiController extends Controller
{
    public function index()
    {
        // Mengambil semua data transaksi untuk halaman Daftar Transaksi Masuk
        $transaksis = Transaksi::with(['user', 'kamar'])->latest()->get();
        return view('admin.transaksi.index', compact('transaksis'));
    }

    /**
     * Konfirmasi Pembayaran Sewa Baru
     */
    public function konfirmasi($id)
    {
        $transaksi = Transaksi::findOrFail($id);
        
        // 1. Update status pembayaran dan status sewa
        // Menggunakan 'Lunas' agar sinkron dengan pengecekan di Blade
        $transaksi->update([
            'status' => 'Lunas', 
            'status_sewa' => 'Aktif' 
        ]);
        
        // 2. Kamar otomatis jadi tidak tersedia (Sudah Dihuni)
        if ($transaksi->kamar) {
            $transaksi->kamar->update(['is_tersedia' => false]);
        }

        return redirect()->back()->with('success', 'Pembayaran berhasil dikonfirmasi! User kini masuk dalam Daftar Penghuni.');
    }

    /**
     * Konfirmasi Check Out (Berhenti Kos)
     */
    public function konfirmasiCheckout($id)
    {
        $transaksi = Transaksi::findOrFail($id);

        // 1. Pastikan transaksi dalam proses keluar
        if ($transaksi->status_sewa !== 'Proses Keluar') {
            return redirect()->back()->with('error', 'Transaksi ini tidak dalam pengajuan check out.');
        }

        // 2. Update status sewa menjadi Selesai
        $transaksi->update([
            'status_sewa' => 'Selesai'
        ]);

        // 3. Kembalikan status kamar menjadi Tersedia (Kosong)
        if ($transaksi->kamar) {
            $transaksi->kamar->update(['is_tersedia' => true]);
        }

        return redirect()->back()->with('success', 'Check Out berhasil dikonfirmasi. Kamar sekarang tersedia kembali!');
    }
}