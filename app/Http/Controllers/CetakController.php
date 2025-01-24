<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;


class CetakController extends Controller
{
    public function index()
    {
        $pdf = Pdf::loadView('cetak.index');
        return $pdf->stream();
    }
}
