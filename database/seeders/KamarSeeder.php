<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Kamar;

class KamarSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            // KAMAR REGULER (A1 - A5)
            ['nomor' => 'A1', 'tipe' => 'Reguler', 'harga' => 800000, 'ukuran' => '3x3 M', 'km' => 'Luar'],
            ['nomor' => 'A2', 'tipe' => 'Reguler', 'harga' => 800000, 'ukuran' => '3x3 M', 'km' => 'Luar'],
            ['nomor' => 'A3', 'tipe' => 'Reguler', 'harga' => 850000, 'ukuran' => '3x3 M', 'km' => 'Dalam'],
            ['nomor' => 'A4', 'tipe' => 'Reguler', 'harga' => 850000, 'ukuran' => '3x3 M', 'km' => 'Dalam'],
            ['nomor' => 'A5', 'tipe' => 'Reguler', 'harga' => 900000, 'ukuran' => '3x4 M', 'km' => 'Dalam'],

            // KAMAR VIP (B1 - B5)
            ['nomor' => 'B1', 'tipe' => 'VIP', 'harga' => 1500000, 'ukuran' => '4x4 M', 'km' => 'Dalam'],
            ['nomor' => 'B2', 'tipe' => 'VIP', 'harga' => 1500000, 'ukuran' => '4x4 M', 'km' => 'Dalam'],
            ['nomor' => 'B3', 'tipe' => 'VIP', 'harga' => 1600000, 'ukuran' => '4x4 M', 'km' => 'Dalam'],
            ['nomor' => 'B4', 'tipe' => 'VIP', 'harga' => 1600000, 'ukuran' => '4x4 M', 'km' => 'Dalam'],
            ['nomor' => 'B5', 'tipe' => 'VIP', 'harga' => 1700000, 'ukuran' => '4x5 M', 'km' => 'Dalam'],

            // KAMAR VVIP (C1 - C5)
            ['nomor' => 'C1', 'tipe' => 'VVIP', 'harga' => 2500000, 'ukuran' => '5x5 M', 'km' => 'Dalam'],
            ['nomor' => 'C2', 'tipe' => 'VVIP', 'harga' => 2500000, 'ukuran' => '5x5 M', 'km' => 'Dalam'],
            ['nomor' => 'C3', 'tipe' => 'VVIP', 'harga' => 2700000, 'ukuran' => '5x6 M', 'km' => 'Dalam'],
            ['nomor' => 'C4', 'tipe' => 'VVIP', 'harga' => 2700000, 'ukuran' => '5x6 M', 'km' => 'Dalam'],
            ['nomor' => 'C5', 'tipe' => 'VVIP', 'harga' => 3000000, 'ukuran' => '6x6 M', 'km' => 'Dalam'],
        ];

        foreach ($data as $item) {
            Kamar::create([
                'nomor_kamar' => $item['nomor'],
                'tipe' => $item['tipe'],
                'harga_per_bulan' => $item['harga'],
                'fasilitas' => $item['tipe'] == 'Reguler' ? 'Kasur, Lemari, Meja' : 'AC, TV, Kasur King Size, Water Heater, Meja Kerja',
                'ukuran' => $item['ukuran'],
                'kamar_mandi' => $item['km'],
                'listrik' => $item['tipe'] == 'VVIP' ? 'Sudah Termasuk' : 'Token Mandiri',
                'keamanan' => 'CCTV 24 Jam, Penjaga Kost, Akses Kunci 24 Jam',
                'lokasi_akses' => 'Dekat Minimarket, 5 Menit ke Kampus, Akses Gojek/Grab',
                'is_tersedia' => true,
                'foto_kamar' => null, // Bisa diisi nanti manual lewat admin
            ]);
        }
    }
}