<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('transaksi', function (Blueprint $table) {
            $table->id();
            $table->string('nama_nasabah');
            $table->date('tanggal');
            $table->string('metode_pencairan');
            $table->string('no_rekening')->nullable();
            $table->string('bank')->nullable();
            $table->string('pengajuan_pinjaman');
            $table->string('bulan');
            $table->string('bunga');
            $table->string('jenis_agunan');
            $table->string('nilai_pasar');
            $table->string('nilai_likuiditas');
            $table->text('catatan');
            $table->string('status_delete')->default('1');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transaksi');
    }
};
