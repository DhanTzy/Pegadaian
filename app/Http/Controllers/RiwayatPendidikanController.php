<?php

namespace App\Http\Controllers;

use App\Models\RiwayatPendidikan;
use Illuminate\Http\Request;

class RiwayatPendidikanController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $riwayatPendidikan = RiwayatPendidikan::with('karyawan')->when($search, function ($query, $search) {
            return $query->whereHas('karyawan', function ($query) use ($search) {
                $query->where('id', 'like', "%{$search}%")
                    ->orWhere('nama_lengkap', 'like', "%{$search}%");
            });
        })->get();

        return view('admin.riwayatPendidikan.index', compact('riwayatPendidikan'));
    }
}
