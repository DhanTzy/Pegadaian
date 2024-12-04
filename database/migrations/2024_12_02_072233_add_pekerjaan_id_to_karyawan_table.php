<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPekerjaanIdToKaryawanTable extends Migration
{
    public function up()
    {
        Schema::table('karyawan', function (Blueprint $table) {
            $table->unsignedBigInteger('pekerjaan_id')->nullable()->after('nama_lengkap');
            $table->foreign('pekerjaan_id')->references('id')->on('pekerjaan')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::table('karyawan', function (Blueprint $table) {
            // Menghapus foreign key dan kolom pekerjaan_id
            $table->dropForeign(['pekerjaan_id']);
            $table->dropColumn('pekerjaan_id');
        });
    }
}
