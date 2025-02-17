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

    // public function index($nasabahId, $transaksiId)
    // {
    //     $nasabah = Nasabah::find($nasabahId);
    //     $transaksi = Transaksi::where('nasabah_id', $nasabahId)->where('id', $transaksiId)->first();

    //     $user = Auth::user();

    //     $pdf = Pdf::loadView('cetak.index', compact('nasabah', 'transaksi', 'user'));

    //     return $pdf->stream();
    // }

    public function print(Request $request)
    {
        $transaksiId = $request->id_transaksi;
        $nasabahId = $request->id_nasabah;

        if (!$transaksiId || !$nasabahId) {
            return back()->with('error', 'ID Transaksi dan Nasabah diperlukan');
        }

        $nasabah = Nasabah::findOrFail($nasabahId);
        $transaksi = Transaksi::where('nasabah_id', $nasabahId)->where('id', $transaksiId)->firstOrFail();

        $user = Auth::user();

        switch ($request->jenisCetak) {
            case 'data':
                $pdf = Pdf::loadView('cetak.data', compact('nasabah', 'transaksi', 'user'));
                return $pdf->stream();
                break;
            case 'pendaftaran':
                $pdf = Pdf::loadView('cetak.pendaftaran', compact('nasabah', 'transaksi', 'user'));
                return $pdf->stream();
                break;
            case 'sph':
                $pdf = Pdf::loadView('cetak.sph', compact('nasabah', 'transaksi', 'user'));
                return $pdf->stream();
                break;
            case 'gadai':
                $pdf = Pdf::loadView('cetak.gadai', compact('nasabah', 'transaksi', 'user'));
                return $pdf->stream();
                break;

            default:
                break;
        }
    }
}
