<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Nasabah;
use App\Models\Transaksi;
use App\Models\Users;
use Illuminate\Support\Facades\Auth;


class CetakController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:admin|customer service');
    }

    public function index($nasabahId, $transaksiId)
    {
        $nasabah = Nasabah::find($nasabahId);
        $transaksi = Transaksi::where('nasabah_id', $nasabahId)->where('id', $transaksiId)->first();

        $user = Auth::user();

        $pdf = Pdf::loadView('cetak.index', compact('nasabah', 'transaksi', 'user'));

        return $pdf->stream();
    }
}
