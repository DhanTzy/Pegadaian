<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('profile', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('nip');
            $table->string('nomor_identitas');
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->string('status_perkawinan');
            $table->text('alamat_lengkap');
            $table->string('kode_pos');
            $table->string('posisi_pekerjaan');
            $table->string('telepon');
            $table->string('nama_orang_tua');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profile');
    }
};
