<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('transaksi', function (Blueprint $table) {
            // Menghapus kolom 'jangka_waktu' dan 'bunga'
            $table->dropColumn(['jangka_waktu', 'bunga']);
        });
    }

    public function down(): void
    {
        Schema::table('transaksi', function (Blueprint $table) {
            // Menambahkan kembali kolom yang dihapus jika migrasi dibatalkan
            $table->string('jangka_waktu');
            $table->string('bunga');
        });
    }
};
