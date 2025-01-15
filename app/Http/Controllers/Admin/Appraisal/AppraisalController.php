<?php

namespace App\Http\Controllers\Admin\Appraisal;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaksi;
use App\Models\TransaksiJaminan;
use Illuminate\Support\Facades\File;
use Yajra\DataTables\DataTables;

class AppraisalController extends Controller
{
    public function index()
    {
        $transaksiTersedia = Transaksi::where('status_transaksi', 'menunggu appraisal')->exists();

        return view('admin.appraisal.index', compact('transaksiTersedia'));
    }

    public function getData(Request $request)
    {
        $query = Transaksi::with('jaminan')
            ->where('status_delete', '1')
            ->where('status_transaksi', 'menunggu appraisal');

        return DataTables::of($query)
            ->addIndexColumn()
            ->addColumn('action', function ($transaksi) {
                $fotoJaminan = '';
                foreach ($transaksi->jaminan as $jaminan) {
                    $fotoJaminan .= '<img src="' . asset('storage/' . $jaminan->foto_jaminan) . '" style="width: 100px; margin: 5px;">';
                }

                if ($transaksi->status_transaksi === 'menunggu appraisal') {
                    return '
                <button type="button" class="btn btn-info btn-sm me-2"
                        data-bs-toggle="modal"
                        data-bs-target="#appraisalDetailModal"
                        data-id="' . $transaksi->id . '"
                        data-jenis_jaminan="' . e($transaksi->jenis_jaminan) . '"
                        data-nilai_pasar="' . e($transaksi->nilai_pasar) . '"
                        data-nilai_likuiditas="' . e($transaksi->nilai_likuiditas) . '"
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
        if ($transaksi->status_transaksi !== 'menunggu appraisal') {
            return view('admin.appraisal.index', compact('transaksi'));
        }
        return view('admin.appraisal.edit', compact('transaksi'));
    }


    // Memperbarui data appraisal
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nilai_pasar' => 'nullable|string',
            'nilai_likuiditas' => 'nullable|string',
            'foto_jaminan.*' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'status_transaksi' => 'nullable|in:menunggu appraisal,appraisal selesai,menunggu approval,approval selesai',
        ]);

        $transaksi = Transaksi::with('jaminan')->findOrFail($id);

        if ($transaksi->status_transaksi !== 'menunggu appraisal') {
            return redirect()->route('admin.appraisal.index')->with('error', 'Data appraisal sudah diinput dan tidak bisa diubah.');
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
            'nilai_pasar' => $validated['nilai_pasar'],
            'nilai_likuiditas' => $validated['nilai_likuiditas'],
            'status_transaksi' => 'menunggu approval',
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

        // Redirect dengan pesan sukses
        return redirect()->route('admin.appraisal.index')->with('success', 'Data appraisal berhasil di input dan status pengajuan transaksi telah diperbarui menjadi "Menunggu Approval".');
    }
}
