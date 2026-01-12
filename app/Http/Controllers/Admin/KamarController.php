<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kamar; 
use App\Models\Transaksi; // Pastikan ini ada untuk menghitung statistik
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class KamarController extends Controller
{
    /**
     * FUNGSI DASHBOARD: Menampilkan Statistik & Grafik
     */
    public function adminDashboard()
    {
        $totalKamar = Kamar::count();
        $kamarTerisi = Kamar::where('is_tersedia', false)->count();
        $kamarKosong = Kamar::where('is_tersedia', true)->count();
        
        // Menghitung transaksi yang statusnya 'Menunggu Verifikasi'
        $transaksiPending = Transaksi::where('status', 'Menunggu Verifikasi')->count();
        
        // Menghitung total pendapatan dari transaksi yang sudah lunas
        $totalPendapatan = Transaksi::where('status', 'Lunas / Terkonfirmasi')->sum('total_harga');

        // Menghitung pengaduan yang belum selesai (Menunggu & Proses)
        $pengaduanPending = \App\Models\Pengaduan::whereIn('status', ['Menunggu', 'Proses'])->count();

        return view('admin.dashboard', compact(
            'totalKamar', 
            'kamarTerisi', 
            'kamarKosong', 
            'transaksiPending',
            'totalPendapatan',
            'pengaduanPending'
            
        ));
    }
    public function index(Request $request)
{
    $query = Kamar::query();

    // Logika Filter
    if ($request->has('status') && $request->status !== '') {
        $query->where('is_tersedia', $request->status);
    }

    // Pagination 5 item per halaman
    // appends(request()->query()) memastikan filter tetap aktif saat pindah halaman
    $kamars = $query->latest()->paginate(5)->withQueryString();

    return view('admin.kamar.index', compact('kamars'));
}

    public function create()
    {
        return view('admin.kamar.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nomor_kamar' => 'required|unique:kamars,nomor_kamar',
            'tipe' => 'required',
            'fasilitas' => 'required',
            'harga_per_bulan' => 'required|numeric',
            'foto_kamar' => 'image|mimes:jpeg,png,jpg|max:2048',
            'ukuran' => 'nullable|string',
            'kamar_mandi' => 'nullable|string',
            'listrik' => 'nullable|string',
            'keamanan' => 'nullable|string',
            'lokasi_akses' => 'nullable|string',
        ]);

        $path = $request->hasFile('foto_kamar') ? $request->file('foto_kamar')->store('kamars', 'public') : null;

        Kamar::create([
            'nomor_kamar' => $request->nomor_kamar,
            'tipe' => $request->tipe,
            'fasilitas' => $request->fasilitas,
            'harga_per_bulan' => $request->harga_per_bulan,
            'foto_kamar' => $path,
            'is_tersedia' => true,
            'ukuran' => $request->ukuran,
            'kamar_mandi' => $request->kamar_mandi,
            'listrik' => $request->listrik,
            'keamanan' => $request->keamanan,
            'lokasi_akses' => $request->lokasi_akses,
        ]);

        return redirect()->route('admin.kamar.index')->with('success', 'Kamar berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $kamar = Kamar::findOrFail($id);
        return view('admin.kamar.edit', compact('kamar'));
    }

    public function update(Request $request, $id)
    {
        $kamar = Kamar::findOrFail($id);

        $request->validate([
            'nomor_kamar' => 'required|unique:kamars,nomor_kamar,'.$id,
            'tipe' => 'required',
            'fasilitas' => 'required',
            'harga_per_bulan' => 'required|numeric',
            'foto_kamar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'ukuran' => 'nullable|string',
            'kamar_mandi' => 'nullable|string',
            'listrik' => 'nullable|string',
            'keamanan' => 'nullable|string',
            'lokasi_akses' => 'nullable|string',
        ]);

        if ($request->hasFile('foto_kamar')) {
            if ($kamar->foto_kamar) {
                Storage::disk('public')->delete($kamar->foto_kamar);
            }
            $kamar->foto_kamar = $request->file('foto_kamar')->store('kamars', 'public');
        }

        $kamar->update([
            'nomor_kamar' => $request->nomor_kamar,
            'tipe' => $request->tipe,
            'fasilitas' => $request->fasilitas,
            'harga_per_bulan' => $request->harga_per_bulan,
            'is_tersedia' => (bool) $request->is_tersedia,
            'ukuran' => $request->ukuran,
            'kamar_mandi' => $request->kamar_mandi,
            'listrik' => $request->listrik,
            'keamanan' => $request->keamanan,
            'lokasi_akses' => $request->lokasi_akses,
        ]);

        return redirect()->route('admin.kamar.index')->with('success', 'Data kamar berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $kamar = Kamar::findOrFail($id);
        if ($kamar->foto_kamar) {
            Storage::disk('public')->delete($kamar->foto_kamar);
        }
        $kamar->delete();

        return redirect()->route('admin.kamar.index')->with('success', 'Kamar berhasil dihapus!');
    }

    public function kelolaPenghuni()
    {
        $penghunis = Transaksi::with(['user', 'kamar'])
            ->where('status', 'Lunas / Terkonfirmasi')
            ->get();

        return view('admin.penghuni.index', compact('penghunis'));
    }
}