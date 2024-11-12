<?php

namespace App\Http\Controllers;

use App\Models\RiwayatPendidikan;
use Illuminate\Http\Request;

class RiwayatPendidikanController extends Controller
{
    public function index(Request $request)
    {
        return view('admin.riwayatPendidikan.index');
    }
}
