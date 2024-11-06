<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('anggota_keluarga', function (Blueprint $table) {
            $table->id();
            $table->foreignId('karyawan_id')->constrained('karyawan')->onDelete('cascade'); // Relasi ke tabel karyawan
            $table->string('status_kekeluargaan', 20); // Contoh: ayah, ibu, anak
            $table->string('nama', 100);
            $table->string('nik', 16);
            $table->timestamps();
        });
    }
    
    public function down(): void
    {
        Schema::dropIfExists('anggota_keluarga');
    }
};
