<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    // Tambahkan ini jika nama tabel di database Anda adalah 'transaksis'
    protected $table = 'transaksis';

    protected $fillable = [
        'user_id',
        'kamar_id',
        'status',
        'total_harga',
        'bukti_pembayaran',
    ];

    /**
     * Relasi ke User (Penghuni)
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relasi ke Kamar
     */
    public function kamar()
    {
        return $this->belongsTo(Kamar::class);
    }
}