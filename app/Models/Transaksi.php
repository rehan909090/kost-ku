<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Transaksi extends Model
{
    use HasFactory;

    protected $table = 'transaksis';

    /**
     * Pastikan semua kolom baru ditambahkan ke dalam $fillable 
     * agar bisa disimpan ke database.
     */
    protected $fillable = [
        'user_id',
        'kamar_id',
        'status',           // Contoh: 'Menunggu Verifikasi', 'Lunas', 'Dibatalkan'
        'status_sewa',      // Contoh: 'Aktif', 'Proses Keluar', 'Selesai'
        'total_harga',
        'bukti_pembayaran',
        'tanggal_masuk',    // Kolom baru untuk awal sewa
        'tanggal_selesai',  // Kolom baru untuk akhir sewa (Habis Kontrak)
        'checkout_at',      // Untuk mencatat tanggal pengajuan keluar
    ];

    /**
     * Casting kolom ke tipe data tanggal (Carbon)
     * Ini penting agar di Blade Anda bisa menggunakan fungsi ->format() atau ->diffInDays()
     */
    protected $casts = [
        'tanggal_masuk' => 'date',
        'tanggal_selesai' => 'date',
        'checkout_at' => 'datetime',
    ];

    /**
     * Relasi ke User (Penghuni)
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relasi ke Kamar
     */
    public function kamar(): BelongsTo
    {
        return $this->belongsTo(Kamar::class);
    }
}