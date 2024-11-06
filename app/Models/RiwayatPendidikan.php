<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RiwayatPendidikan extends Model
{
    use HasFactory;

    protected $table = 'riwayat_pendidikan';
    protected $fillable = [
        'karyawan_id', // ID karyawan yang berelasi
        'pendidikan',
        'jurusan',
        'jenjang_pendidikan',
        'tahun_lulus',
        'ipk_nilai',
    ];

    // // Relasi ke model Karyawan
    // public function karyawan()
    // {
    //     return $this->belongsTo(Karyawan::class, 'karyawan_id');
    // }
}
