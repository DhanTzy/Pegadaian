<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pajak;

class PajakController extends Controller
{
    /**
     * Tampilkan daftar pajak.
     */
    public function index()
    {
        $pajaks = Pajak::all(); // Ambil semua data pajak
        return view('admin.transaksi.pajak.index', compact('pajaks'));
    }

    /**
     * Tampilkan form untuk membuat pajak baru.
     */
    public function create()
    {
        $pajaks = Pajak::all();
        return view('admin.transaksi.pajak.create', compact('pajaks'));
    }

    /**
     * Simpan data pajak baru.
     */
    public function store(Request $request)
    {
        $request->validate([
            'bunga' => 'required|string',
            'bulan' => 'required|string|max:20',
        ]);

        Pajak::create($request->all());
        return redirect()->route('admin.transaksi.pajak.index')->with('success', 'Data pajak berhasil ditambahkan!');
    }

    /**
     * Tampilkan form untuk edit data pajak.
     */
    public function edit($id)
    {
        $pajak = Pajak::findOrFail($id);
        return view('admin.transaksi.pajak.edit', compact('pajak'));
    }

    /**
     * Update data pajak.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'bunga' => 'required|string',
            'bulan' => 'required|string|max:20',
        ]);

        $pajak = Pajak::findOrFail($id);
        $pajak->update($request->all());
        return redirect()->route('admin.transaksi.pajak.index')->with('success', 'Data pajak berhasil diperbarui!');
    }

    /**
     * Hapus data pajak.
     */
    public function destroy($id)
    {
        $pajak = Pajak::findOrFail($id);
        $pajak->delete();
        return redirect()->route('admin.transaksi.pajak.index')->with('success', 'Data pajak berhasil dihapus!');
    }
}
