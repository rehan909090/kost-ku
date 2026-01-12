<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaksi;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    public function index()
    {
        // Mengambil data transaksi beserta info user dan kamar
        $transaksis = Transaksi::with(['user', 'kamar'])->latest()->get();
        return view('admin.transaksi.index', compact('transaksis'));
    }

    public function konfirmasi($id)
    {
        $transaksi = Transaksi::findOrFail($id);
        $transaksi->update(['status' => 'Lunas / Terkonfirmasi']);
        
        // Kamar otomatis jadi tidak tersedia
        $transaksi->kamar->update(['is_tersedia' => false]);

        return redirect()->back()->with('success', 'Pembayaran berhasil dikonfirmasi!');
    }
}