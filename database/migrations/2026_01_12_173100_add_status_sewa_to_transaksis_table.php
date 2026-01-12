<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
public function up(): void
{
    // Ubah 'pesanans' menjadi 'transaksis'
    Schema::table('transaksis', function (Blueprint $table) {
        $table->string('status_sewa')->nullable()->after('status');
        $table->timestamp('checkout_at')->nullable()->after('status_sewa');
    });
}

public function down(): void
{
    // Ubah 'pesanans' menjadi 'transaksis'
    Schema::table('transaksis', function (Blueprint $table) {
        $table->dropColumn(['status_sewa', 'checkout_at']);
    });
}
};
