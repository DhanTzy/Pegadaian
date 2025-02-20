<?php

namespace App\Http\Controllers\Transaksi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaksi;
use App\Models\TransaksiJaminan;
use Yajra\DataTables\DataTables;

class ApprovalController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:admin|approval');
    }

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
                    $fotoJaminan .= '<a href="' . asset('storage/' . $jaminan->foto_jaminan) . '" target="_blank" class="me-2 text-decoration-none">
                                <i class="bi bi-image"></i> Foto Jaminan
                            </a>';
                }
                return '
            <button type="button" class="btn btn-success btn-sm me-2"
                    data-bs-toggle="modal"
                    data-bs-target="#approvalModal"
                    data-id="' . $transaksi->id . '"
                    data-jenis_jaminan="' . $transaksi->jenis_jaminan . '"
                    data-nilai_pasar_aps="' . $transaksi->nilai_pasar_aps . '"
                    data-nilai_likuiditas_aps="' . $transaksi->nilai_likuiditas_aps . '"
                    data-foto_jaminan="' . e($fotoJaminan) . '">
                <i class="fas fa-check-circle"></i>
            </button>';
            })->rawColumns(['action'])->make(true);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nilai_pasar_apv' => 'nullable|string',
            'nilai_likuiditas_apv' => 'nullable|string',
            'putusan_pinjaman' => 'nullable|string',
            'bunga' => 'nullable|string',
            'bunga_perbulan' => 'nullable|string',
            'pelunasan' => 'nullable|string',
            'biaya_administrasi' => 'nullable|string',
            'status_transaksi' => 'nullable|in:Menunggu Appraisal,Appraisal Selesai,Menunggu Approval,Approval Selesai,Ditolak',
        ]);

        $transaksi = Transaksi::findOrFail($id);

        // Cek apakah semua data yang diperlukan sudah terisi
        $isComplete = $request->filled(['nilai_pasar_apv', 'nilai_likuiditas_apv', 'putusan_pinjaman', 'bunga', 'bunga_perbulan', 'pelunasan', 'biaya_administrasi']);
        if (!$isComplete) {
            return redirect()->back()->with('error', 'Lengkapi semua data terlebih dahulu!');
        }

        $statusTransaksi = $isComplete ? 'Approval selesai' : 'Menunggu approval';

        $transaksi->update($validated + ['status_transaksi' => $statusTransaksi]);

        return redirect()->route('approval.index')->with('success', 'Data Berhasil Disimpan Dan Pengajuan Pinjaman Telah Di Setujui.');
    }
}
