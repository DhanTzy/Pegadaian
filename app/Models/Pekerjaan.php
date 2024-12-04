<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pekerjaan extends Model
{
    use HasFactory;
    protected $table = 'pekerjaan';

    protected $fillable = [
        'posisi_pekerjaan'
    ];

    public function karyawan()
    {
        return $this->hasMany(Karyawan::class, 'pekerjaan_id');
    }
}
