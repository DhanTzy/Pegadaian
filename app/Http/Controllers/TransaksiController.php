<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;
use App\Models\TransaksiJaminan;
use App\Models\Pajak;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\File;
use Carbon\Carbon;

class TransaksiController extends Controller
{
    public function index()
    {
        return view('admin.transaksi.index');
    }

    public function getData(Request $request)
    {
        $query = Transaksi::with('jaminan')->where('status_delete', '1');

        if ($request->has('nama_nasabah') && $request->input('nama_nasabah') != '') {
            $query->where('nama_nasabah', 'LIKE', '%' . $request->input('nama_nasabah') . '%');
        }

        if ($request->has('tanggal_transaksi') && $request->input('tanggal_transaksi') != '') {
            $query->where('tanggal', '>=', $request->input('tanggal_transaksi'));
        }

        if ($request->has('tanggal') && $request->input('tanggal') != '') {
            $query->where('tanggal', '<=', $request->input('tanggal'));
        }

        if ($request->has('no_rekening') && $request->input('no_rekening') != '') {
            $query->where('no_rekening', 'LIKE', '%' . $request->input('no_rekening') . '%');
        }

        if ($request->has('metode_pencairan') && $request->input('metode_pencairan') != '') {
            $query->where('metode_pencairan', 'LIKE', '%' . $request->input('metode_pencairan') . '%');
        }

        if ($request->has('bulan') && $request->input('bulan') != '') {
            $query->where('bulan', 'LIKE', '%' . $request->input('bulan') . '%');
        }

        return DataTables::of($query)
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
                    data-nama_nasabah="' . $transaksi->nama_nasabah . '"
                    data-tanggal="' . Carbon::parse($transaksi->tanggal_lahir)->format('d-m-Y') . '"
                    data-metode_pencairan="' . $transaksi->metode_pencairan . '"
                    data-no_rekening="' . $transaksi->no_rekening . '"
                    data-bank="' . $transaksi->bank . '"
                    data-pengajuan_pinjaman="' . $transaksi->pengajuan_pinjaman . '"
                    data-bulan="' . $transaksi->bulan . '"
                    data-bunga="' . $transaksi->bunga . '"
                    data-catatan="' . $transaksi->catatan . '"
                    data-jenis_agunan="' . $transaksi->jenis_agunan . '"
                    data-nilai_pasar="' . $transaksi->nilai_pasar . '"
                    data-nilai_likuiditas="' . $transaksi->nilai_likuiditas . '"
                    data-foto_jaminan="' . htmlspecialchars($fotoJaminan) . '">
                Detail
            </button>
            <a href="' . route('admin.transaksi.edit', $transaksi->id) . '" class="btn btn-success btn-sm me-2">Edit</a>
            <form action="' . route('admin.transaksi.destroy', $transaksi->id) . '" method="POST"
                  onsubmit="return confirm(\'Apakah Anda Yakin Menghapus Data Ini?\')" class="d-inline">
                ' . csrf_field() . '
                ' . method_field('DELETE') . '
                <button class="btn btn-danger btn-sm me-2">Delete</button>
            </form>
        ';
            })->editColumn('tanggal', function ($transkasi) {
                return Carbon::parse($transkasi->tanggal)->format('d-m-Y');
            })->rawColumns(['action'])->make(true);
    }

    public function create()
    {
        $pajaks = Pajak::all(); // Ambil data pajak dari database
        return view('admin.transaksi.create', compact('pajaks'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_nasabah' => 'required|string',
            'tanggal' => 'required|date',
            'metode_pencairan' => 'required|string',
            'no_rekening' => 'nullable|string',
            'bank' => 'nullable|string',
            'pengajuan_pinjaman' => 'required|string',
            'bulan' => 'required|string',
            'bunga' => 'required|string',
            'jenis_agunan' => 'required|string',
            'nilai_pasar' => 'required|string',
            'nilai_likuiditas' => 'required|string',
            'catatan' => 'required|string',
            'foto_jaminan.*' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Simpan data transaksi
        $transaksi = Transaksi::create($request->only([
            'nama_nasabah',
            'tanggal',
            'metode_pencairan',
            'no_rekening',
            'bank',
            'pengajuan_pinjaman',
            'bulan',
            'bunga',
            'jenis_agunan',
            'nilai_pasar',
            'nilai_likuiditas',
            'catatan',
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
        $transaksi = Transaksi::findOrFail($id);
        return view('admin.transaksi.edit', compact('transaksi'));
    }

    public function edit($id)
    {
        $transaksi = Transaksi::with('jaminan')->findOrFail($id);
        $pajaks = Pajak::all();
        return view('admin.transaksi.edit', compact('transaksi', 'pajaks'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_nasabah' => 'required|string',
            'tanggal' => 'required|date',
            'metode_pencairan' => 'required|string',
            'no_rekening' => 'nullable|string',
            'bank' => 'nullable|string',
            'pengajuan_pinjaman' => 'required|string',
            'bulan' => 'required|string',
            'bunga' => 'required|string',
            'jenis_agunan' => 'required|string',
            'nilai_pasar' => 'required|string',
            'nilai_likuiditas' => 'required|string',
            'catatan' => 'required|string',
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
            'pengajuan_pinjaman',
            'bulan',
            'bunga',
            'jenis_agunan',
            'nilai_pasar',
            'nilai_likuiditas',
            'catatan',
        ]));

        // Mengelola foto jaminan
        if ($request->hasFile('foto_jaminan')) {
            foreach ($transaksi->jaminan as $jaminan) {
                $jaminan->delete(); // Pastikan Anda menangani penghapusan foto dari storage jika perlu
            }

            // Simpan foto jaminan baru
            foreach ($request->file('foto_jaminan') as $foto) {
                $path = $foto->store('jaminan', 'public');
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
