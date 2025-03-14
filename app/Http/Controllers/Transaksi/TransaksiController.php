<?php

namespace App\Http\Controllers\Transaksi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaksi;
use App\Models\Nasabah;
use Yajra\DataTables\DataTables;

class TransaksiController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:admin|customer service');
    }

    public function index()
    {
        $nasabah = Nasabah::where('status_delete', '1 Restore')->orderBy('created_at', 'asc')->get();
        return view('transaksi.index', compact('nasabah'));
    }

    public function getData(Request $request)
    {
        $query = Transaksi::with('nasabah')->where('status_delete', '1 Restore')->orderBy('created_at', 'asc')->get();

        return DataTables::of($query)
            ->addIndexColumn()
            ->addColumn('nasabah', function ($transaksi) {
                return $transaksi->nasabah->nama_lengkap ?? '-';
            })
            ->addColumn('action', function ($transaksi) {
                $fotoJaminan = '';
                foreach ($transaksi->jaminan as $jaminan) {
                    $fotoJaminan .= '<a href="' . asset('storage/' . $jaminan->foto_jaminan) . '" target="_blank" class="me-2 text-decoration-none">
                                <i class="bi bi-image"></i> Foto Jaminan
                            </a>';
                }
                $printButton = '';
                if ($transaksi->status_transaksi == 'Approval Selesai') {
                    $printButton = '
                    <button type="button" class="btn btn-success btn-cetak btn-sm float-left" data-bs-toggle="modal" data-id="' . $transaksi->id . '"
                                data-bs-target="#cetakModal" data-nasabah="'.$transaksi->nasabah_id.'">
                                <i class="fas fa-print"></i>
                        </button>
                    ';
                }
                return '
                <button type="button    " class="btn btn-info btn-sm me-2"
                        data-bs-toggle="modal"
                        data-bs-target="#transaksiDetailModal"
                        data-no_pendaftaran="' . $transaksi->no_pendaftaran . '"
                        data-no_pangkal="' . $transaksi->no_pangkal . '"
                        data-nasabah_id="' . $transaksi->nasabah->nama_lengkap . '"
                        data-pengajuan_pinjaman="' . $transaksi->pengajuan_pinjaman . '"
                        data-jangka_waktu="' . $transaksi->jangka_waktu . '"
                        data-jenis_jaminan="' . $transaksi->jenis_jaminan . '"
                        data-foto_jaminan="' . e($fotoJaminan) . '"
                        data-nilai_pasar_aps="' . $transaksi->nilai_pasar_aps . '"
                        data-nilai_likuiditas_aps="' . $transaksi->nilai_likuiditas_aps . '"
                        data-nilai_pasar_apv="' . $transaksi->nilai_pasar_apv . '"
                        data-nilai_likuiditas_apv="' . $transaksi->nilai_likuiditas_apv . '"
                        data-putusan_pinjaman="' . $transaksi->putusan_pinjaman . '"
                        data-bunga="' . $transaksi->bunga . '"
                        data-bunga_perbulan="' . $transaksi->bunga_perbulan . '"
                        data-pelunasan="' . $transaksi->pelunasan . '"
                        data-biaya_administrasi="' . $transaksi->biaya_administrasi . '">
                    <i class="fas fa-info-circle"></i>
                </button>
                ' . $printButton . '
                <form action="' . route('transaksi.destroy', $transaksi->id) . '" method="POST"
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
        $nasabah = Nasabah::where('status_delete', '1')->orderBy('created_at', 'desc')->get();
        return view('transaksi.create', compact('nasabah'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'no_pendaftaran' => 'required|string',
            'no_pangkal' => 'required|string',
            'nasabah_id' => 'required|exists:nasabahs,id',
            'pengajuan_pinjaman' => 'required|string',
            'jangka_waktu' => 'required|string',
            'jenis_jaminan' => 'required|string',
            'status_transaksi' => 'nullable|in:Menunggu Appraisal,Appraisal Selesai,Menunggu Approval,Approval Selesai,Ditolak',
        ]);

        $existingTransaksi = Transaksi::where('nasabah_id', $validated['nasabah_id'])
            ->where('status_delete', '1 Restore')
            ->first();

        if ($existingTransaksi) {
            return redirect()->back()->with('error', 'Data Nama Nasabah Di Transaksi Yang Anda Input Sudah Ada.')->withInput();
        }

        Transaksi::create($validated);

        return redirect()->route('transaksi.index')->with('success', 'Data Transaksi Berhasil Disimpan Dan Data Di Alihkan Ke Appraisal.');
    }

    public function destroy($id)
    {
        $transaksi = Transaksi::find($id);

        if ($transaksi) {
            $transaksi->status_delete = '0 Delete';
            $transaksi->save();

            return redirect()->route('transaksi.index')->with('success', 'Data berhasil dihapus.');
        }

        return redirect()->route('transaksi.index')->with('error', 'Data tidak ditemukan.');
    }
}
