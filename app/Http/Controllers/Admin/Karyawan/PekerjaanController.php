<?php

namespace App\Http\Controllers\Admin\Karyawan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pekerjaan;

class PekerjaanController extends Controller
{
    public function index()
    {
        $pekerjaans = Pekerjaan::all();
        return view('admin.karyawan.pekerjaan.index', compact('pekerjaans'));
    }

    public function create()
    {
        return view('admin.karyawan.pekerjaan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'posisi_pekerjaan' => 'required|string|max:255|unique:pekerjaan,posisi_pekerjaan',
        ]);

        Pekerjaan::create($request->all());
        return redirect()->route('admin.karyawan.pekerjaan.index')->with('success', 'Pekerjaan berhasil ditambahkan');
    }

    public function edit($id)
    {
        $pekerjaan = Pekerjaan::findOrFail($id);
        return view('admin.karyawan.pekerjaan.edit', compact('pekerjaan'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'posisi_pekerjaan' => 'required|string|max:255|unique:pekerjaan,posisi_pekerjaan,' . $id,
        ]);

        $pekerjaan = Pekerjaan::findOrFail($id);
        $pekerjaan->update($request->all());
        return redirect()->route('admin.karyawan.pekerjaan.index')->with('success', 'Pekerjaan berhasil diperbarui');
    }

    public function destroy($id)
    {
        $pekerjaan = Pekerjaan::findOrFail($id);
        $pekerjaan->delete();
        return redirect()->route('admin.karyawan.pekerjaan.index')->with('success', 'Pekerjaan berhasil dihapus');
    }
}
