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
        'jenis_kelamin',
        'alamat_lengkap',
        'kode_pos',
        'telepon',
    ];

    // Relasi dengan tabel users
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
