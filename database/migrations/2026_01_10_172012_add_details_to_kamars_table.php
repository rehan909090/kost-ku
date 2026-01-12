<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void {
    Schema::table('kamars', function (Blueprint $table) {
        $table->string('ukuran')->nullable(); // Contoh: 3x4 Meter
        $table->string('kamar_mandi')->nullable(); // Contoh: Kamar Mandi Dalam
        $table->string('listrik')->nullable(); // Contoh: Token
        $table->text('keamanan')->nullable(); // Contoh: CCTV, Parkir, Jam Malam
        $table->text('lokasi_akses')->nullable(); // Contoh: Dekat Kampus, Akses Gojek
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('kamars', function (Blueprint $table) {
            //
        });
    }
};
