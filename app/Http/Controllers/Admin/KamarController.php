<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kamar; 
use App\Models\Transaksi;
use App\Models\Pengaduan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class KamarController extends Controller
{
    /**
     * FUNGSI DASHBOARD: Statistik Pendapatan & Laporan Baru
     */
    public function adminDashboard()
    {
        $totalKamar = Kamar::count();
        // Menggunakan kolom 'is_tersedia' sesuai dengan database Anda
        $kamarTerisi = Kamar::where('is_tersedia', false)->count();
        $kamarKosong = Kamar::where('is_tersedia', true)->count();
        
        $transaksiPending = Transaksi::where('status', 'Menunggu Verifikasi')->count();
        $totalPendapatan = Transaksi::where('status', 'Lunas')->sum('total_harga');

        // Menghitung pengaduan yang butuh tindakan (Status: Menunggu atau Proses)
        $pengaduanPending = Pengaduan::whereIn('status', ['Menunggu', 'Proses'])->count();

        return view('admin.dashboard', compact(
            'totalKamar', 
            'kamarTerisi', 
            'kamarKosong', 
            'transaksiPending',
            'totalPendapatan',
            'pengaduanPending'
        ));
    }

    /**
     * FUNGSI KELOLA PENGHUNI: Menampilkan Daftar Penghuni Aktif
     */
    public function kelolaPenghuni()
    {
        $penghunis = Transaksi::with(['user', 'kamar'])
            ->where('status', 'Lunas')
            ->whereIn('status_sewa', ['Aktif', 'Proses Keluar'])
            ->latest()
            ->get();

        return view('admin.penghuni.index', compact('penghunis'));
    }

    /**
     * FUNGSI KONFIRMASI CHECKOUT (PENTING: Menangani Error 500 Anda)
     */
    public function konfirmasiCheckout($id)
    {
        // 1. Cari transaksi berdasarkan ID
        $transaksi = Transaksi::findOrFail($id);

        // 2. Update status sewa menjadi Selesai
        $transaksi->update([
            'status_sewa' => 'Selesai'
        ]);

        // 3. Update status kamar menjadi Tersedia kembali (is_tersedia = true)
        if ($transaksi->kamar) {
            $transaksi->kamar->update([
                'is_tersedia' => true
            ]);
        }

        return redirect()->route('admin.transaksi.index')
                         ->with('success', 'Check-out berhasil dikonfirmasi. Kamar nomor ' . $transaksi->kamar->nomor_kamar . ' sekarang tersedia kembali.');
    }

    /**
     * FUNGSI LAPORAN: Menampilkan Laporan Kerusakan
     */
    public function laporanIndex()
    {
        $pengaduans = Pengaduan::with('user')->latest()->get();
        return view('admin.pengaduan.index', compact('pengaduans'));
    }

    /**
     * Update status laporan pengaduan
     */
    public function updateStatusLaporan(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:Menunggu,Proses,Selesai'
        ]);

        $laporan = Pengaduan::findOrFail($id);
        $laporan->update(['status' => $request->status]);
        
        return back()->with('success', 'Status laporan berhasil diperbarui menjadi ' . $request->status);
    }

    /**
     * MANAJEMEN DATA KAMAR (CRUD)
     */
    public function index(Request $request)
    {
        $query = Kamar::query();
        if ($request->has('status') && $request->status !== '') {
            $query->where('is_tersedia', $request->status);
        }
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
        ]);

        $path = $request->hasFile('foto_kamar') ? $request->file('foto_kamar')->store('kamars', 'public') : null;

        Kamar::create([
            'nomor_kamar' => $request->nomor_kamar,
            'tipe' => $request->tipe,
            'fasilitas' => $request->fasilitas,
            'harga_per_bulan' => $request->harga_per_bulan,
            'foto_kamar' => $path,
            'is_tersedia' => true, // Default tersedia untuk kamar baru
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
}