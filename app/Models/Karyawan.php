<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Karyawan extends Model
{
    use HasFactory;

    protected $table = 'karyawan';

    protected $fillable = [
        'nama_lengkap',
        'posisi_pekerjaan',
        'jenis_kelamin',
        'tempat_lahir',
        'tanggal_lahir',
        'agama',
        'kewarganegaraan',
        'status_perkawinan',
        'no_telepon',
        'email',
        'alamat_lengkap',
        'kode_pos',
        'foto_ktp',
        'foto_kk',
        'status_delete',
    ];

    // Relasi ke model RiwayatPendidikan
    public function riwayatPendidikan()
    {
        return $this->hasMany(RiwayatPendidikan::class);
    }
}
