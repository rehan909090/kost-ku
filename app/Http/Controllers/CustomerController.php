<?php

namespace App\Http\Controllers;

use App\Models\Kamar; 
use App\Models\Transaksi;
use App\Models\Pengaduan;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {
        $kamars = Kamar::where('is_tersedia', true)->get();
        return view('customer.dashboard', compact('kamars'));
    }

    // STEP 1: Munculkan Detail Kamar (Review)
    public function reviewPesanan($id)
    {
        $kamar = Kamar::findOrFail($id);
        return view('customer.pesanan.detail', compact('kamar'));
    }

    // STEP 2: Tampilkan Form Pembayaran (Inilah fungsi yang hilang)
    public function createPesanan($id)
    {
        $kamar = Kamar::findOrFail($id);
        // Pastikan Anda punya file view di: resources/views/customer/pesanan/pembayaran.blade.php
        return view('customer.pesanan.pembayaran', compact('kamar'));
    }

    // STEP 3: Proses Simpan Data (Checkout)
    public function checkout(Request $request, $id) 
    {
        $kamar = Kamar::findOrFail($id);

        $request->validate([
            'bukti_pembayaran' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $path = $request->file('bukti_pembayaran')->store('bukti_bayar', 'public');

        Transaksi::create([
            'user_id' => auth()->id(),
            'kamar_id' => $kamar->id,
            'total_harga' => $kamar->harga_per_bulan,
            'status' => 'Menunggu Verifikasi',
            'bukti_pembayaran' => $path,
        ]);

        return redirect()->route('customer.dashboard')->with('success', 'Bukti bayar berhasil dikirim! Tunggu konfirmasi admin.');
    }
    public function pesananSaya()
{
    // Mengambil semua transaksi milik user yang sedang login
    $transaksis = Transaksi::with('kamar')
        ->where('user_id', auth()->id())
        ->latest()
        ->get();

    return view('customer.pesanan.index', compact('transaksis'));
}
public function pengaduanIndex() {
    $pengaduans = Pengaduan::where('user_id', auth()->id())->latest()->get();
    return view('customer.pengaduan.index', compact('pengaduans'));
}

public function pengaduanStore(Request $request) {
    $request->validate([
        'judul' => 'required',
        'deskripsi' => 'required',
        'foto_kerusakan' => 'image|mimes:jpg,png,jpeg|max:2048'
    ]);

    $path = $request->hasFile('foto_kerusakan') ? $request->file('foto_kerusakan')->store('pengaduan', 'public') : null;

    Pengaduan::create([
        'user_id' => auth()->id(),
        'judul' => $request->judul,
        'deskripsi' => $request->deskripsi,
        'foto_kerusakan' => $path
    ]);

    return redirect()->back()->with('success', 'Pengaduan berhasil dikirim!');
}
}