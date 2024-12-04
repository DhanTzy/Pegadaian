<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Karyawan extends Model
{
    use HasFactory;

    protected $table = 'karyawan';

    protected $fillable = [
        'nip',
        'no_identitas',
        'nama_lengkap',
        'pekerjaan_id',
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

    public function pekerjaan()
    {
        return $this->belongsTo(Pekerjaan::class);
    }

    // Relasi ke model Anggota Keluarga
    public function anggotaKeluarga()
    {
        return $this->hasMany(AnggotaKeluarga::class);
    }
}
