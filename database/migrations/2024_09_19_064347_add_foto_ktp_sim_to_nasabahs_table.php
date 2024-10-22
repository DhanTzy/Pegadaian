<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('nasabahs', function (Blueprint $table) {
            $table->string('foto_ktp_sim')->nullable()->after('nama_orang_tua');
        });
    }

    public function down(): void
    {
        Schema::table('nasabahs', function (Blueprint $table) {
            //
        });
    }
};
