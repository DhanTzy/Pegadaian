<?php

namespace App\Http\Controllers\Admin\Approval;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaksi;
use App\Models\TransaksiJaminan;
use Yajra\DataTables\DataTables;

class ApprovalController extends Controller
{
    public function index()
    {
        $transaksi = Transaksi::where('status_transaksi', 'menunggu approval')->get();

        return view('admin.approval.index', compact('transaksi'));
    }

    public function getData(Request $request)
    {
        $query = Transaksi::where('status_transaksi', 'menunggu approval')
            ->where('status_delete', '1');

        return DataTables::of($query)
            ->addIndexColumn()
            ->addColumn('action', function ($transaksi) {
                return '
            <button type="button" class="btn btn-info btn-sm me-2"
                    data-bs-toggle="modal"
                    data-bs-target="#approvalModal"
                    data-id="' . $transaksi->id . '"
                    data-jenis_jaminan="' . $transaksi->jenis_jaminan . '"
                    data-nilai_pasar="' . $transaksi->nilai_pasar . '"
                    data-nilai_likuiditas="' . $transaksi->nilai_likuiditas . '">
                <i class="fas fa-check-circle"></i>
            </button>';
            })->rawColumns(['action'])->make(true);
    }

    public function update(Request $request, $id)
    {
        // Validasi input
        $validated = $request->validate([
            'putusan_pinjaman' => 'nullable|string',
            'bunga' => 'nullable|string',
            'bunga_perbulan' => 'nullable|string',
            'pelunasan' => 'nullable|string',
            'biaya_administrasi' => 'nullable|string',
        ]);

        $transaksi = Transaksi::findOrFail($id);

        // Cek apakah semua data yang diperlukan sudah terisi
        $isComplete = $request->filled(['putusan_pinjaman', 'bunga', 'bunga_perbulan', 'pelunasan', 'biaya_administrasi']);

        // Jika semua data sudah terisi, update status menjadi 'approval selesai', jika tidak, biarkan status tetap 'menunggu approval'
        $statusTransaksi = $isComplete ? 'approval selesai' : 'menunggu approval';

        // Update transaksi
        $transaksi->update($validated + ['status_transaksi' => $statusTransaksi]);

        // Redirect ke halaman approval dengan pesan sukses
        return redirect()->route('admin.approval.index')->with('success', 'Data berhasil disimpan dan status telah di setujui.');
    }
}
