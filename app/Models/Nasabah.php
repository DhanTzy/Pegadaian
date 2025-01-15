<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nasabah extends Model
{
    use HasFactory;
    protected $table = 'nasabahs';

    protected $fillable = [
        'nama_lengkap',
        'nomor_identitas',
        'alamat_lengkap',
        'kelurahan',
        'kecamatan',
        'kabupaten',
        'propinsi',
        'tempat_lahir',
        'tanggal_lahir',
        'telepon',
        'foto_ktp',
        'status_delete',
    ];

    public function transaksi()
    {
        return $this->hasMany(Transaksi::class);
    }
}
