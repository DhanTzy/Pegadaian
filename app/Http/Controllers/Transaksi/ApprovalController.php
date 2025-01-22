<?php

namespace App\Http\Controllers\Transaksi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaksi;
use App\Models\TransaksiJaminan;
use Yajra\DataTables\DataTables;

class ApprovalController extends Controller
{
    public function index()
    {
        $transaksi = Transaksi::where('status_transaksi', 'Menunggu Approval')->get();

        return view('approval.index', compact('transaksi'));
    }

    public function getData(Request $request)
    {
        $query = Transaksi::with('jaminan')
            ->where('status_transaksi', 'Menunggu Approval')
            ->where('status_delete', '1 Restore');

        return DataTables::of($query)
            ->addIndexColumn()
            ->addColumn('action', function ($transaksi) {
                $fotoJaminan = '';
                foreach ($transaksi->jaminan as $jaminan) {
                    $fotoJaminan .= '<img src="' . asset('storage/' . $jaminan->foto_jaminan) . '" style="width: 100px; margin: 5px;">';
                }
                return '
            <button type="button" class="btn btn-success btn-sm me-2"
                    data-bs-toggle="modal"
                    data-bs-target="#approvalModal"
                    data-id="' . $transaksi->id . '"
                    data-jenis_jaminan="' . $transaksi->jenis_jaminan . '"
                    data-foto_jaminan="' . e($fotoJaminan) . '"
                    data-nilai_pasar="' . $transaksi->nilai_pasar . '"
                    data-nilai_likuiditas="' . $transaksi->nilai_likuiditas . '">
                <i class="fas fa-check-circle"></i>
            </button>';
            })->rawColumns(['action'])->make(true);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'putusan_pinjaman' => 'nullable|string',
            'bunga' => 'nullable|string',
            'bunga_perbulan' => 'nullable|string',
            'pelunasan' => 'nullable|string',
            'biaya_administrasi' => 'nullable|string',
            'status_transaksi' => 'nullable|in:Menunggu Appraisal,Appraisal Selesai,Menunggu Approval,Approval Selesai,Ditolak',
        ]);

        $transaksi = Transaksi::findOrFail($id);

        // Cek apakah semua data yang diperlukan sudah terisi
        $isComplete = $request->filled(['putusan_pinjaman', 'bunga', 'bunga_perbulan', 'pelunasan', 'biaya_administrasi']);
        if (!$isComplete) {
            return redirect()->back()->with('error', 'Lengkapi semua data terlebih dahulu!');
        }

        // Jika semua data sudah terisi, update status menjadi 'approval selesai', jika tidak, biarkan status tetap 'menunggu approval'
        $statusTransaksi = $isComplete ? 'Approval selesai' : 'Menunggu approval';

        // Update transaksi
        $transaksi->update($validated + ['status_transaksi' => $statusTransaksi]);

        return redirect()->route('approval.index')->with('success', 'Data Berhasil Disimpan Dan Pengajuan Pinjaman Telah Di Setujui.');
    }
}
