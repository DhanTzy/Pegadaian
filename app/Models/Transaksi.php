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
        'pengajuan_pinjaman',
        'bulan_id',
        'bunga',
        'jenis_agunan',
        'nilai_pasar',
        'nilai_likuiditas',
        'catatan',
        'status_delete',
    ];

    public function pajak()
    {
        return $this->belongsTo(Pajak::class, 'bulan_id');
    }

    public function jaminan()
    {
        return $this->hasMany(TransaksiJaminan::class); // Relasi one-to-many ke TransaksiJaminan
    }
}
