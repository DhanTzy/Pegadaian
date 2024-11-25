<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pajak extends Model
{
    use HasFactory;
    protected $table = 'pajak';

    protected $fillable = [
        'bunga',
        'bulan',
    ];

    public function transaksi()
    {
        return $this->hasMany(Transaksi::class);
    }

}
