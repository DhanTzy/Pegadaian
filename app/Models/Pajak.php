<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pajak extends Model
{
    use HasFactory;
    protected $table = 'pajak';

    protected $fillable = [
        'bulan',
        'bunga',
    ];

    public function transaksi()
    {
        return $this->hasMany(Transaksi::class);
    }
}
