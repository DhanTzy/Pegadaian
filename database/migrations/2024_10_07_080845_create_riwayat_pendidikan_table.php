<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('riwayat_pendidikan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('karyawan_id')->constrained('karyawan')->onDelete('cascade'); // Relasi ke tabel karyawan
            $table->string('pendidikan');
            $table->string('jurusan');
            $table->string('jenjang_pendidikan');
            $table->year('tahun_lulus');
            $table->decimal('ipk_nilai', 3, 2);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('riwayat_pendidikan');
    }
};
