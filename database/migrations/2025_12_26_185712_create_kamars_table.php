<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
 public function up(): void
{
    Schema::create('kamars', function (Blueprint $table) {
        $table->id();
        $table->string('nomor_kamar');
        $table->string('foto_kamar')->nullable(); // Untuk menyimpan nama file foto
        $table->enum('tipe', ['Reguler', 'VIP', 'VVIP']);
        $table->text('fasilitas'); // Contoh: AC, Kamar Mandi Dalam, Wifi
        $table->integer('harga_per_bulan');
        $table->boolean('is_tersedia')->default(true);
        $table->timestamps();
    });
}
};
