<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('karyawan', function (Blueprint $table) {
            $table->id();
            $table->string('nama_lengkap');
            $table->string('posisi_pekerjaan');
            $table->string('jenis_kelamin');
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->string('agama');
            $table->string('kewarganegaraan');
            $table->string('status_perkawinan');
            $table->string('no_telepon');
            $table->string('email');
            $table->text('alamat_lengkap');
            $table->string('kode_pos');
            $table->string('foto_ktp')->nullable();
            $table->string('foto_kk')->nullable();
            $table->string('status_delete')->default('1');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('karyawan');
    }
};
