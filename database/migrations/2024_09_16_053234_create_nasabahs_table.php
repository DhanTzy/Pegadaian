<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('nasabahs', function (Blueprint $table) {
            $table->id(); // ID Nasabah
            $table->string('identitas');
            $table->string('nomor_identitas')->unique(); // Nomor Identitas (KTP/SIM)
            $table->string('nama_lengkap'); // Nama Lengkap
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->string('status_perkawinan');
            $table->text('alamat_lengkap'); // Alamat Lengkap
            $table->string('kode_pos'); // Kode Pos
            $table->string('pekerjaan'); // Pekerjaan
            $table->string('email')->unique(); // Email
            $table->string('telepon');
            $table->string('nama_orang_tua'); // Nama Orang Tua (Ayah/Ibu)
            $table->string('status_delete')->default('1');
            $table->timestamps();
        });
    }
    
    public function down(): void
    {
        Schema::dropIfExists('nasabahs');
    }
};
