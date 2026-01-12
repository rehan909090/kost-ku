<?php

namespace App\Http\Controllers;

use App\Models\Kamar; 
use App\Models\Transaksi;
use App\Models\Pengaduan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class CustomerController extends Controller
{
    /**
     * DASHBOARD: Menampilkan status sewa aktif pengguna saat ini.
     */
    public function index()
    {
        // Mengambil transaksi aktif dengan relasi kamar
        $sewaAktif = Transaksi::with('kamar')
            ->where('user_id', auth()->id())
            ->whereIn('status_sewa', ['Aktif', 'Proses Keluar'])
            ->where('status', 'Lunas')
            ->first();

        return view('customer.dashboard', compact('sewaAktif'));
    }

    /**
     * CARI KAMAR: Menampilkan daftar kamar yang tersedia.
     */
    public function cariKamar()
    {
        $kamars = Kamar::where('is_tersedia', true)->get();
        return view('customer.cari-kamar', compact('kamars'));
    }

    /**
     * REVIEW PESANAN: Halaman sebelum melakukan pembayaran.
     */
    public function reviewPesanan($id)
    {
        $kamar = Kamar::findOrFail($id);
        return view('customer.pesanan.detail', compact('kamar'));
    }

    /**
     * CREATE PESANAN: Halaman upload bukti pembayaran.
     */
    public function createPesanan($id)
    {
        $kamar = Kamar::findOrFail($id);
        
        if (!$kamar->is_tersedia) {
            return redirect()->route('customer.cari-kamar')->with('error', 'Maaf, kamar ini sudah tidak tersedia.');
        }
        return view('customer.pesanan.pembayaran', compact('kamar'));
    }

    /**
     * STORE PEMBAYARAN: Menyimpan transaksi baru dengan perbaikan logika tanggal.
     */
    public function storePembayaran(Request $request, $id) 
    {
        $kamar = Kamar::findOrFail($id);

        $request->validate([
            'bukti_pembayaran' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Simpan file bukti pembayaran
        $path = $request->file('bukti_pembayaran')->store('bukti_bayar', 'public');

        // LOGIKA PERBAIKAN TANGGAL:
        // Gunakan startOfDay() agar perhitungan selisih hari di dashboard akurat (tidak nol)
        $tanggalMasuk = Carbon::now()->startOfDay();
        $tanggalSelesai = Carbon::now()->addMonth()->startOfDay();

        Transaksi::create([
            'user_id' => auth()->id(),
            'kamar_id' => $kamar->id,
            'total_harga' => $kamar->harga_per_bulan,
            'status' => 'Menunggu Verifikasi',
            'status_sewa' => 'Menunggu Konfirmasi', 
            'bukti_pembayaran' => $path,
            'tanggal_masuk' => $tanggalMasuk,
            'tanggal_selesai' => $tanggalSelesai,
        ]);

        return redirect()->route('customer.pesan.index')->with('success', 'Bukti bayar berhasil dikirim! Silakan tunggu konfirmasi admin.');
    }

    /**
     * AJUKAN CHECKOUT: Proses berhenti sewa oleh customer.
     */
    public function ajukanCheckout($id) 
    {
        $transaksi = Transaksi::where('user_id', auth()->id())
                              ->where('id', $id)
                              ->firstOrFail();
    
        // Update status transaksi
        $transaksi->update([
            'status_sewa' => 'Proses Keluar',
            'checkout_at' => Carbon::now()
        ]);

        // Notifikasi ke admin melalui tabel pengaduan
        Pengaduan::create([
            'user_id' => auth()->id(),
            'judul' => 'Pengajuan Berhenti Kost',
            'deskripsi' => 'Penghuni mengajukan Check Out untuk Kamar ' . ($transaksi->kamar->nomor_kamar ?? $id),
            'status' => 'Menunggu',
        ]);

        return back()->with('success', 'Permohonan Check Out telah dikirim. Silakan hubungi pengelola untuk pengembalian kunci.');
    }

    /**
     * PESANAN SAYA: Riwayat transaksi user.
     */
    public function pesananSaya()
    {
        $transaksis = Transaksi::with('kamar')
            ->where('user_id', auth()->id())
            ->latest()
            ->get();

        return view('customer.pesanan.index', compact('transaksis'));
    }

    /**
     * PENGADUAN: List pengaduan kerusakan/masalah.
     */
    public function pengaduanIndex() {
        $pengaduans = Pengaduan::where('user_id', auth()->id())->latest()->get();
        return view('customer.pengaduan.index', compact('pengaduans'));
    }

    /**
     * PENGADUAN STORE: Simpan pengaduan baru.
     */
    public function pengaduanStore(Request $request) {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'foto_kerusakan' => 'nullable|image|mimes:jpg,png,jpeg|max:2048'
        ]);

        $path = null;
        if ($request->hasFile('foto_kerusakan')) {
            $path = $request->file('foto_kerusakan')->store('pengaduan', 'public');
        }

        Pengaduan::create([
            'user_id' => auth()->id(),
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'foto_kerusakan' => $path,
            'status' => 'Menunggu'
        ]);

        return redirect()->back()->with('success', 'Pengaduan berhasil dikirim!');
    }
}