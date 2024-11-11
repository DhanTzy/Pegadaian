<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $table = 'profile';
    protected $fillable = [
        'user_id',
        'nip',
        'nomor_identitas',
        'tempat_lahir',
        'tanggal_lahir',
        'status_perkawinan',
        'alamat_lengkap',
        'kode_pos',
        'posisi_pekerjaan',
        'telepon',
        'nama_orang_tua',
    ];

    // Relasi dengan tabel users
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
