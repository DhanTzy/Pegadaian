<?php

namespace App\Http\Controllers\Transaksi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaksi;
use App\Models\TransaksiJaminan;
use Illuminate\Support\Facades\File;
use Yajra\DataTables\DataTables;

class AppraisalController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:admin|appraisal');
    }

    public function index()
    {
        $transaksiTersedia = Transaksi::where('status_transaksi', 'menunggu appraisal')->exists();

        return view('appraisal.index', compact('transaksiTersedia'));
    }

    public function getData(Request $request)
    {
        $query = Transaksi::with('jaminan')
            ->where('status_delete', '1 Restore')
            ->where('status_transaksi', 'Menunggu Appraisal');

        return DataTables::of($query)
            ->addIndexColumn()
            ->addColumn('action', function ($transaksi) {
                $fotoJaminan = '';
                foreach ($transaksi->jaminan as $jaminan) {
                    $fotoJaminan .= '<img src="' . asset('storage/' . $jaminan->foto_jaminan) . '" style="width: 100px; margin: 5px;">';
                }

                if ($transaksi->status_transaksi === 'Menunggu Appraisal') {
                    return '
                <button type="button" class="btn btn-success btn-sm me-2"
                        data-bs-toggle="modal"
                        data-bs-target="#appraisalDetailModal"
                        data-id="' . $transaksi->id . '"
                        data-jenis_jaminan="' . e($transaksi->jenis_jaminan) . '"
                        data-nilai_pasar_aps="' . e($transaksi->nilai_pasar_aps) . '"
                        data-nilai_likuiditas_aps="' . e($transaksi->nilai_likuiditas_aps) . '"
                        data-foto_jaminan="' . e($fotoJaminan) . '">
                    <i class="fas fa-check-circle"></i>
                </button>';
                }
                return '<span class="text-muted">Appraisal selesai</span>';
            })
            ->addColumn('status_transaksi', function ($transaksi) {
                return ucfirst($transaksi->status_transaksi);
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function edit($id)
    {
        $transaksi = Transaksi::with('jaminan')->findOrFail($id);
        if ($transaksi->status_transaksi !== 'Menunggu Appraisal') {
            return view('appraisal.index', compact('transaksi'));
        }
        return view('appraisal.edit', compact('transaksi'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nilai_pasar_aps' => 'nullable|string',
            'nilai_likuiditas_aps' => 'nullable|string',
            'foto_jaminan.*' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'status_transaksi' => 'nullable|in:Menunggu Appraisal,Appraisal Selesai,Menunggu Approval,Approval Selesai,Ditolak',
        ]);

        $transaksi = Transaksi::with('jaminan')->findOrFail($id);

        if ($transaksi->status_transaksi !== 'Menunggu Appraisal') {
            return redirect()->route('appraisal.index')->with('error', 'Data appraisal sudah diinput dan tidak bisa diubah.');
        }

        if ($transaksi->jaminan->isNotEmpty()) {
            foreach ($transaksi->jaminan as $jaminan) {
                if (File::exists(storage_path('app/public/' . $jaminan->foto_jaminan))) {
                    File::delete(storage_path('app/public/' . $jaminan->foto_jaminan));
                }
                $jaminan->delete();
            }
        }

        $transaksi->update([
            'nilai_pasar_aps' => $validated['nilai_pasar_aps'],
            'nilai_likuiditas_aps' => $validated['nilai_likuiditas_aps'],
            'status_transaksi' => 'Menunggu Approval',
        ]);

        if ($request->hasFile('foto_jaminan')) {
            foreach ($request->file('foto_jaminan') as $file) {
                $path = $file->store('jaminan', 'public');
                TransaksiJaminan::create([
                    'transaksi_id' => $transaksi->id,
                    'foto_jaminan' => $path,
                ]);
            }
        }

        return redirect()->route('appraisal.index')->with('success', 'Data Appraisal Berhasil Di Input Dan Data Di Alihkan Ke Approval');
    }
}
