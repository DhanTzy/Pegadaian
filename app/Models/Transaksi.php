<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $table = 'transaksi'; // Nama tabel
    protected $fillable = [
        'nama_nasabah',
        'tanggal',
        'metode_pencairan',
        'no_rekening',
        'bank',
        'jumlah_pinjaman',
        'bunga',
        'jangka_waktu',
        'status_delete',
    ];

    public function jaminan()
    {
        return $this->hasMany(TransaksiJaminan::class); // Relasi one-to-many ke TransaksiJaminan
    }
}
