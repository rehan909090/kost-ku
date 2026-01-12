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
}