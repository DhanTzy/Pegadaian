<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $table = 'transaksi';
    protected $fillable = [
        'no_pendaftaran',
        'no_pangkal',
        'nasabah_id',
        'pengajuan_pinjaman',
        'jangka_waktu',
        'jenis_jaminan',
        'nilai_pasar_aps',
        'nilai_likuiditas_aps',
        'nilai_pasar_apv',
        'nilai_likuiditas_apv',
        'putusan_pinjaman',
        'bunga',
        'bunga_perbulan',
        'pelunasan',
        'biaya_administrasi',
        'status_transaksi',
        'status_delete',
    ];

    public function jaminan()
    {
        return $this->hasMany(TransaksiJaminan::class);
    }

    public function nasabah()
    {
        return $this->belongsTo(Nasabah::class);
    }
}
