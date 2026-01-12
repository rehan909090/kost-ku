<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pengaduan;
use Illuminate\Http\Request;

class PengaduanController extends Controller
{
    public function index()
    {
        // Mengambil semua pengaduan dari semua user
        $pengaduans = Pengaduan::with('user')->latest()->get();
        return view('admin.pengaduan.index', compact('pengaduans'));
    }

    public function update(Request $request, $id)
    {
        $pengaduan = Pengaduan::findOrFail($id);
        
        // Admin hanya mengubah status saja
        $pengaduan->update([
            'status' => $request->status
        ]);

        return redirect()->back()->with('success', 'Status pengaduan berhasil diperbarui!');
    }
    public function ajukanBerhenti(Request $request)
{
    $transaksi = Transaksi::findOrFail($request->transaksi_id);

    // 1. Update status sewa menjadi 'Proses Keluar'
    $transaksi->update(['status_sewa' => 'Proses Keluar']);

    // 2. Buat Laporan Otomatis ke Admin
    \App\Models\Pengaduan::create([
        'user_id' => auth()->id(),
        'masalah' => 'Pengajuan Berhenti Kost - Kamar ' . $transaksi->kamar->nomor_kamar,
        'status' => 'Menunggu',
        'kategori' => 'Check Out' // Opsional jika ada kolom kategori
    ]);

    return redirect()->back()->with('success', 'Permohonan Berhenti Kost telah dikirim ke Admin.');
}
}