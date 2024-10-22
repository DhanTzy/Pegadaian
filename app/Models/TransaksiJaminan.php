<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaksiJaminan extends Model
{
    use HasFactory;

    protected $table = 'transaksi_jaminan'; // Nama tabel
    protected $fillable = [
        'transaksi_id',
        'foto_jaminan',
    ];

    public function transaksi()
    {
        return $this->belongsTo(Transaksi::class); // Relasi ke model Transaksi
    }
}
