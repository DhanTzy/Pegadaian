<?php

namespace App\Http\Controllers\Admin\Transaksi;
use App\Http\Controllers\Controller;

use App\Models\TransaksiJaminan;
use Illuminate\Http\Request;

class TransaksiJaminanController extends Controller
{
    public function index()
    {
        $transaksi_jaminan = TransaksiJaminan::all();
        return view('admin.transaksiJaminan.index', compact('transaksi_jaminan'));
    }
}
