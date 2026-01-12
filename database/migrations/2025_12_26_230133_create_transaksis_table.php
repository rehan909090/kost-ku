<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   public function up(): void
{
    Schema::create('transaksis', function (Blueprint $table) {
        $table->id();
        // Pastikan baris ini ada untuk merekam siapa yang memesan
        $table->foreignId('user_id')->constrained()->onDelete('cascade');
        // Pastikan baris ini ada untuk merekam kamar mana yang dipesan
        $table->foreignId('kamar_id')->constrained('kamars')->onDelete('cascade');
        
        $table->integer('total_harga');
        $table->string('status')->default('Menunggu Verifikasi');
        $table->string('bukti_pembayaran')->nullable();
        $table->timestamps();
    });
}
};
