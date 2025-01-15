<?php

namespace App\Http\Controllers\Admin\Transaksi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaksi;
use App\Models\Nasabah;
use Yajra\DataTables\DataTables;

class TransaksiController extends Controller
{
    public function index()
    {
        $nasabah = Nasabah::all(); 
        return view('admin.transaksi.index', compact('nasabah')); 
    }

    public function getData(Request $request)
    {
        $query = Transaksi::with('nasabah')->where('status_delete', '1');

        return DataTables::of($query)
            ->addIndexColumn()
            ->addColumn('nasabah', function ($transaksi) {
                return $transaksi->nasabah->nama_lengkap ?? '-';
            })
            ->addColumn('action', function ($transaksi) {
                $fotoJaminan = '';
                foreach ($transaksi->jaminan as $jaminan) {
                    $fotoJaminan .= '<img src="' . asset('storage/' . $jaminan->foto_jaminan) . '" style="width: 100px; margin: 5px;">';
                }
                return '
                <button type="button" class="btn btn-info btn-sm me-2"
                        data-bs-toggle="modal"
                        data-bs-target="#transaksiDetailModal"
                        data-nasabah_id="' . $transaksi->nasabah->nama_lengkap . '"
                        data-pengajuan_pinjaman="' . $transaksi->pengajuan_pinjaman . '"
                        data-jangka_waktu="' . $transaksi->jangka_waktu . '"
                        data-jenis_jaminan="' . $transaksi->jenis_jaminan . '"
                        data-foto_jaminan="' . e($fotoJaminan) . '"
                        data-nilai_pasar="' . $transaksi->nilai_pasar . '"
                        data-nilai_likuiditas="' . $transaksi->nilai_likuiditas . '"
                        data-putusan_pinjaman="' . $transaksi->putusan_pinjaman . '"
                        data-bunga="' . $transaksi->bunga . '"
                        data-bunga_perbulan="' . $transaksi->bunga_perbulan . '"
                        data-pelunasan="' . $transaksi->pelunasan . '"
                        data-biaya_administrasi="' . $transaksi->biaya_administrasi . '">
                    <i class="fas fa-info-circle"></i>
                </button>
                <form action="' . route('admin.transaksi.destroy', $transaksi->id) . '" method="POST"
                      onsubmit="return confirm(\'Apakah Anda Yakin Menghapus Data Ini?\')" class="d-inline">
                    ' . csrf_field() . '
                    ' . method_field('DELETE') . '
                    <button class="btn btn-danger btn-sm me-2"><i class="fas fa-trash-alt"></i></button>
                </form>
            ';
            })->rawColumns(['action'])->make(true);
    }

    public function create()
    {
        $nasabah = Nasabah::all();
        return view('admin.transaksi.create', compact('nasabah'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nasabah_id' => 'required|exists:nasabahs,id',
            'pengajuan_pinjaman' => 'required|string',
            'jangka_waktu' => 'required|string',
            'jenis_jaminan' => 'required|string',
            'status_transaksi' => 'nullable|in:menunggu appraisal,appraisal selesai,menunggu approval,approval selesai',
        ]);

        Transaksi::create($validated);

        return redirect()->route('admin.transaksi')->with('success', 'Data transaksi berhasil disimpan.');
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
