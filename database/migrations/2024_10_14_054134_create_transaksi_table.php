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
            $table->string('no_pendaftaran')->nullable();
            $table->string('no_pangkal')->nullable();
            $table->string('pengajuan_pinjaman')->nullable();
            $table->string('jangka_waktu')->nullable();
            $table->string('jenis_jaminan')->nullable();
            $table->string('nilai_pasar_aps')->nullable();
            $table->string('nilai_likuiditas_aps')->nullable();
            $table->string('nilai_pasar_apv')->nullable();
            $table->string('nilai_likuiditas_apv')->nullable();
            $table->string('putusan_pinjaman')->nullable();
            $table->string('bunga')->nullable();
            $table->string('bunga_perbulan')->nullable();
            $table->string('pelunasan')->nullable();
            $table->string('biaya_administrasi')->nullable();
            $table->enum('status_delete', ['1 Restore', '0 Delete'])->default('1 Restore');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transaksi');
    }
};
