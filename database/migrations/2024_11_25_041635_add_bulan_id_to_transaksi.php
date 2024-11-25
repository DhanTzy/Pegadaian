<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('transaksi', function (Blueprint $table) {
            // Menambahkan kolom 'bulan_id' yang merujuk ke tabel 'pajak'
            $table->unsignedBigInteger('bulan_id')->nullable(); // kolom bulan_id
            $table->foreign('bulan_id')->references('id')->on('pajak')->onDelete('cascade'); // foreign key ke tabel pajak
        });
    }

    public function down(): void
    {
        Schema::table('transaksi', function (Blueprint $table) {
            // Menghapus kolom 'bulan_id' jika migrasi dibatalkan
            $table->dropForeign(['bulan_id']); // Menghapus foreign key
            $table->dropColumn('bulan_id'); // Menghapus kolom bulan_id
        });
    }
};
