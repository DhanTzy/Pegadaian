<?php

namespace App\Http\Controllers\Admin\Transaksi;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Pajak;

class PajakController extends Controller
{
    public function index()
    {
        $pajaks = Pajak::all();
        return view('admin.transaksi.pajak.index', compact('pajaks'));
    }

    public function create()
    {
        $pajaks = Pajak::all();
        return view('admin.transaksi.pajak.create', compact('pajaks'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'bunga' => 'required|string',
            'bulan' => 'required|string|max:20',
        ]);

        Pajak::create($request->all());
        return redirect()->route('admin.transaksi.pajak.index')->with('success', 'Data pajak berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $pajak = Pajak::findOrFail($id);
        return view('admin.transaksi.pajak.edit', compact('pajak'));
    }

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

    public function destroy($id)
    {
        $pajak = Pajak::findOrFail($id);
        $pajak->delete();
        return redirect()->route('admin.transaksi.pajak.index')->with('success', 'Data pajak berhasil dihapus!');
    }
}
