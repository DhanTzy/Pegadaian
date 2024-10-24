<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;
use App\Models\TransaksiJaminan;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\File;
use Carbon\Carbon;

class TransaksiController extends Controller
{
    public function index(Request $request)
    {
        return view('admin.transaksi.index');
    }

    public function getData(Request $request)
    {
        $transaksi = Transaksi::with('jaminan')->where('status_delete', '1')->get();

        return DataTables::of($transaksi)
            ->addColumn('action', function ($transaksi) {
                // Ambil semua foto jaminan
                $fotoJaminan = '';
                foreach ($transaksi->jaminan as $jaminan) {
                    $fotoJaminan .= '<img src="' . asset('storage/' . $jaminan->foto_jaminan) . '" style="width: 100px; height: auto; margin: 5px;">';
                }
                return '
            <button type="button" class="btn btn-info btn-sm me-2"
                    data-bs-toggle="modal"
                    data-bs-target="#transaksiDetailModal"
                    data-no_rekening="' . $transaksi->no_rekening . '"
                    data-bank="' . $transaksi->bank . '"
                    data-foto_jaminan="' . htmlspecialchars($fotoJaminan) . '">
                Detail
            </button>
            <a href="' . route('admin.transaksi.edit', $transaksi->id) . '" class="btn btn-success btn-sm me-2">Edit</a>
            <form action="' . route('admin.transaksi.destroy', $transaksi->id) . '" method="POST"
                  onsubmit="return confirm(\'Apakah Anda Yakin Menghapus Data Ini?\')" class="d-inline">
                ' . csrf_field() . '
                ' . method_field('DELETE') . '
                <button class="btn btn-danger btn-sm">Delete</button>
            </form>
        ';
         })->make(true);
    }

    public function create()
    {
        return view('admin.transaksi.create'); // Buat view create.blade.php
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_nasabah' => 'required|string',
            'tanggal' => 'required|date',
            'metode_pencairan' => 'nullable|string',
            'no_rekening' => 'nullable|string',
            'bank' => 'nullable|string',
            'jumlah_pinjaman' => 'required|string',
            'bunga' => 'required|string',
            'jangka_waktu' => 'required|string',
            'foto_jaminan.*' => 'required|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        // Simpan data transaksi
        $transaksi = Transaksi::create($request->only([
            'nama_nasabah',
            'tanggal',
            'metode_pencairan',
            'no_rekening',
            'bank',
            'jumlah_pinjaman',
            'bunga',
            'jangka_waktu'
        ]));

        // Simpan foto jaminan
        if ($request->hasFile('foto_jaminan')) {
            foreach ($request->file('foto_jaminan') as $file) {
                $path = $file->store('jaminan', 'public');
                TransaksiJaminan::create([
                    'transaksi_id' => $transaksi->id,
                    'foto_jaminan' => $path,
                ]);
            }
        }

        return redirect()->route('admin.transaksi')->with('success', 'Transaksi di tambahkan!');
    }


    public function show($id)
    {
        $transaksi = Transaksi::with('jaminan')->findOrFail($id); // Mengambil data transaksi beserta jaminan
        return view('admin.transaksi.show', compact('transaksi')); // Mengembalikan view dengan data transaksi
    }

    public function edit($id)
    {
        $transaksi = Transaksi::with('jaminan')->findOrFail($id);
        return view('admin.transaksi.edit', compact('transaksi'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_nasabah' => 'required|string',
            'tanggal' => 'required|date',
            'metode_pencairan' => 'required|string',
            'no_rekening' => 'nullable|string',
            'bank' => 'nullable|string',
            'jumlah_pinjaman' => 'required|string',
            'bunga' => 'required|string',
            'jangka_waktu' => 'required|string',
            'foto_jaminan.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validasi foto jaminan
        ]);

        $transaksi = Transaksi::findOrFail($id); // Ambil transaksi berdasarkan ID

        // Update informasi transaksi
        $transaksi->update($request->only([
            'nama_nasabah',
            'tanggal',
            'metode_pencairan',
            'no_rekening',
            'bank',
            'jumlah_pinjaman',
            'bunga',
            'jangka_waktu',
        ]));

        // Mengelola foto jaminan
        if ($request->hasFile('foto_jaminan')) {
            foreach ($transaksi->jaminan as $jaminan) {
                // Hapus foto jaminan yang ada jika perlu
                $jaminan->delete(); // Pastikan Anda menangani penghapusan foto dari storage jika perlu
            }

            // Simpan foto jaminan baru
            foreach ($request->file('foto_jaminan') as $foto) {
                $path = $foto->store('path/to/images', 'public'); // Ganti dengan path penyimpanan yang sesuai
                TransaksiJaminan::create([
                    'transaksi_id' => $transaksi->id,
                    'foto_jaminan' => $path,
                ]);
            }
        }

        return redirect()->route('admin.transaksi')->with('success', 'Transaksi berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $transaksi = Transaksi::find($id);

        if ($transaksi) {
            $transaksi->status_delete = '0';
            $transaksi->save();

            return redirect()->route('admin.transaksi')->with('success', 'Data berhasil dihapus.');
        }

        return redirect()->route('admin.transaksi')->with('error', 'Data tidak ditemukan.');
    }
}
