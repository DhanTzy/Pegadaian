<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;


class CetakController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:customer service');
    }

    public function index()
    {
        $pdf = Pdf::loadView('cetak.index');
        return $pdf->stream();
    }
}
