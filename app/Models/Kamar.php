<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kamar extends Model
{
    use HasFactory;

    /**
     * Nama tabel di database (opsional jika nama tabelnya 'kamars')
     */
    protected $table = 'kamars';

    /**
     * Atribut yang boleh diisi secara massal (Mass Assignment)
     * Ini sangat penting agar Kamar::create() berfungsi
     */
    protected $fillable = [
    'nomor_kamar', 'foto_kamar', 'tipe', 'fasilitas', 'harga_per_bulan',
    'is_tersedia', 'ukuran', 'kamar_mandi', 'listrik', 'keamanan', 'lokasi_akses'
];
    /**
     * Casting status tersedia menjadi boolean
     */
    protected $casts = [
        'is_tersedia' => 'boolean',
    ];
}