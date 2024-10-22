<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nasabah extends Model
{
    use HasFactory;
    protected $table = 'nasabahs';

    protected $fillable = [
        'identitas',
        'nomor_identitas',
        'nama_lengkap',
        'tempat_lahir',
        'tanggal_lahir',
        'status_perkawinan',
        'alamat_lengkap',
        'kode_pos',
        'pekerjaan',
        'email',
        'telepon',
        'nama_orang_tua',
        'foto_ktp_sim',
        'status_delete',
    ];
}
