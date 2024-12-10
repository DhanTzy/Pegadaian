<?php

namespace App\Http\Controllers\Admin\Transaksi;
use App\Http\Controllers\Controller;

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
        $pajaks = Pajak::all();
        return view('admin.transaksi.index', compact('pajaks'));
    }

    public function getData(Request $request)
    {
        $query = Transaksi::with(['jaminan', 'pajak'])->where('status_delete', '1');

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

        if ($request->has('pajak_id') && $request->input('pajak_id') != '') {
            $query->where('pajak_id', 'LIKE', '%' . $request->input('pajak_id') . '%');
        }

        return DataTables::of($query)
            ->addIndexColumn()
            ->addColumn('bulan', function ($transaksi) {
                return $transaksi->pajak ? $transaksi->pajak->bulan : '-';
            })
            ->addColumn('bunga', function ($transaksi) {
                return $transaksi->pajak ? $transaksi->pajak->bunga : '-';
            })
            ->addColumn('action', function ($transaksi) {
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
                    data-bulan="' . $transaksi->pajak->bulan . '"
                    data-bunga="' . $transaksi->pajak->bunga . '"
                    data-jumlah_bayar="' . $transaksi->jumlah_bayar . '"
                    data-per_bulan="' . $transaksi->per_bulan . '"
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
        $pajaks = Pajak::all();
        return view('admin.transaksi.create', compact('pajaks'));
    }

    public function store(Request $request)
    {
        $rules = [
            'nama_nasabah' => 'required|string',
            'tanggal' => 'required|date',
            'metode_pencairan' => 'required|string|in:Cash,Transfer',
            'pengajuan_pinjaman' => 'required|string',
            'pajak_id' => 'required|exists:pajak,id',
            'jumlah_bayar' => 'nullable',
            'per_bulan' => 'nullable',
            'jenis_agunan' => 'required|string',
            'nilai_pasar' => 'required|string',
            'nilai_likuiditas' => 'required|string',
            'catatan' => 'required|string',
            'foto_jaminan.*' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ];

        if ($request->metode_pencairan === 'Transfer') {
            $rules['no_rekening'] = 'required|string';
            $rules['bank'] = 'required|string';
        } else {
            $rules['no_rekening'] = 'nullable|string';
            $rules['bank'] = 'nullable|string';
        }

        $message = [
            'nama_nasabah.required' => 'Nama Nasabah Wajib Diisi.',
            'tanggal.required' => 'Tanggal Transaksi Harus Diisi.',
            'metode_pencairan.required' => 'Metode Pencairan Wajib Di Pilih.',
            'no_rekening.required' => 'Nomor Rekening Wajib Diisi.',
            'bank.required' => 'Bank Wajib Diisi.',
            'pengajuan_pinjaman.required' => 'Pengajuan Pinjaman Wajib Diisi.',
            'jenis_agunan.required' => 'Jenis Agunan Wajib Diisi.',
            'nilai_pasar.required' => 'Nilai Pasar Wajib Diisi.',
            'nilai_likuiditas.required' => 'Nilai Likuiditas Wajib Diisi.',
            'catatan.required' => 'Catatan Wajib Diisi.',
        ];

        $request->validate($rules, $message);

        // Simpan data transaksi
        $transaksi = Transaksi::create($request->only([
            'nama_nasabah',
            'tanggal',
            'metode_pencairan',
            'no_rekening',
            'bank',
            'pengajuan_pinjaman',
            'pajak_id',
            'jumlah_bayar',
            'per_bulan',
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
        $rules = [
            'nama_nasabah' => 'required|string',
            'tanggal' => 'required|date',
            'metode_pencairan' => 'required|string|in:Cash,Transfer',
            'pengajuan_pinjaman' => 'required|string',
            'pajak_id' => 'required|exists:pajak,id',
            'jumlah_bayar' => 'nullable',
            'per_bulan' => 'nullable',
            'jenis_agunan' => 'required|string',
            'nilai_pasar' => 'required|string',
            'nilai_likuiditas' => 'required|string',
            'catatan' => 'required|string',
            'foto_jaminan.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ];

        if ($request->metode_pencairan === 'Transfer') {
            $rules['no_rekening'] = 'required|string';
            $rules['bank'] = 'required|string';
        } else {
            $request->merge([
                'no_rekening' => null,
                'bank' => null,
            ]);
        }
        $request->validate($rules);

        $transaksi = Transaksi::findOrFail($id); // Ambil transaksi berdasarkan ID

        // Update informasi transaksi
        $transaksi->update($request->only([
            'nama_nasabah',
            'tanggal',
            'metode_pencairan',
            'no_rekening',
            'bank',
            'pengajuan_pinjaman',
            'pajak_id',
            'jumlah_bayar',
            'per_bulan',
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
