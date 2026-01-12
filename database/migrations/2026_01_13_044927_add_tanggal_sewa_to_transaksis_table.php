<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   public function up()
{
    Schema::table('transaksis', function (Blueprint $table) {
        $table->date('tanggal_masuk')->nullable()->after('bukti_pembayaran');
        $table->date('tanggal_selesai')->nullable()->after('tanggal_masuk');
    });
}

public function down()
{
    Schema::table('transaksis', function (Blueprint $table) {
        $table->dropColumn(['tanggal_masuk', 'tanggal_selesai']);
    });
}
};
