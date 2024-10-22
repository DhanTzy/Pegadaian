<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('transaksi_jaminan', function (Blueprint $table) {
            $table->id(); // Primary key di tabel transaksi_jaminan
            $table->foreignId('transaksi_id') ->constrained('transaksi')->onDelete('cascade'); // Foreign key ke tabel transaksi
            $table->string('foto_jaminan'); // Nama file jaminan
            $table->timestamps();
        });

    }

    public function down(): void
    {
        Schema::dropIfExists('transaksi_jaminan');
    }
};
