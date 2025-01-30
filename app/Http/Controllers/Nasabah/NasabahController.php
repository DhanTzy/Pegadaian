<?php

namespace App\Http\Controllers\Nasabah;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Nasabah;
use App\Models\Transaksi;
use Illuminate\Support\Facades\File;
use Yajra\DataTables\DataTables;
use Carbon\Carbon;

class NasabahController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:admin|customer service');
    }

    public function index()
    {
        return view('nasabah.index');
    }

    public function getData(Request $request)
    {
        $query = Nasabah::where('status_delete', '1 Restore ')->orderBy('created_at', 'desc');

        if ($request->has('nama_lengkap') && $request->input('nama_lengkap') != '') {
            $query->where('nama_lengkap', 'LIKE', '%' . $request->input('nama_lengkap') . '%');
        }

        if ($request->has('nomor_identitas') && $request->input('nomor_identitas') != '') {
            $query->where('nomor_identitas', 'LIKE', '%' . $request->input('nomor_identitas') . '%');
        }

        if ($request->has('tanggal_daftar') && $request->input('tanggal_daftar') != '') {
            $query->where('created_at', '>=', $request->input('tanggal_daftar'));
        }

        if ($request->has('tanggal_akhir') && $request->input('tanggal_akhir') != '') {
            $query->where('created_at', '<=', $request->input('tanggal_akhir'));
        }

        return DataTables::of($query)
            ->addIndexColumn()
            ->addColumn('action', function ($nasabah) {
                $transaksi = $nasabah->transaksi()->first();
                return '
                <button type="button" class="btn btn-info btn-sm me-2"
                        data-bs-toggle="modal"
                        data-bs-target="#nasabahDetailModal"
                        data-nama_lengkap="' . $nasabah->nama_lengkap . '"
                        data-nomor_identitas="' . $nasabah->nomor_identitas . '"
                        data-alamat_lengkap="' . $nasabah->alamat_lengkap . '"
                        data-kelurahan="' . $nasabah->kelurahan . '"
                        data-kecamatan="' . $nasabah->kecamatan . '"
                        data-kabupaten="' . $nasabah->kabupaten . '"
                        data-propinsi="' . $nasabah->propinsi . '"
                        data-tempat_lahir="' . $nasabah->tempat_lahir . '"
                        data-tanggal_lahir="' . Carbon::parse($nasabah->tanggal_lahir)->format('d-m-Y') . '"
                        data-telepon="' . $nasabah->telepon . '"
                        data-created_at="' . Carbon::parse($nasabah->created_at)->format('d-m-Y') . '"
                        data-pengajuan_pinjaman="' . ($transaksi ? $transaksi->pengajuan_pinjaman : '') . '"
                        data-jangka_waktu="' . ($transaksi ? $transaksi->jangka_waktu : '') . '"
                        data-jenis_jaminan="' . ($transaksi ? $transaksi->jenis_jaminan : '') . '"
                        data-foto_ktp="' . asset('storage/' . $nasabah->foto_ktp) . '">
                    <i class="fas fa-info-circle"></i>
                </button>
                <form action="' . route('nasabah.destroy', $nasabah->id) . '" method="POST"
                      onsubmit="return confirm(\'Apakah Anda Yakin Menghapus Data Ini?\')" class="d-inline">
                    ' . csrf_field() . '
                    ' . method_field('DELETE') . '
                    <button class="btn btn-danger btn-sm me-2"><i class="fas fa-trash-alt"></i></button>
                </form>
            ';
            })->editColumn('tanggal_lahir', function ($nasabah) {
                return Carbon::parse($nasabah->tanggal_lahir)->format('d-m-Y');
            })->rawColumns(['action'])->make(true);
    }

    public function create()
    {
        return view('nasabah.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'nomor_identitas' => 'required|string|max:16|unique:nasabahs,nomor_identitas',
            'alamat_lengkap' => 'required|string',
            'kelurahan' => 'required|string|max:100',
            'kecamatan' => 'required|string|max:100',
            'kabupaten' => 'required|string|max:100',
            'propinsi' => 'required|string|max:100',
            'tempat_lahir' => 'required|string|max:100',
            'tanggal_lahir' => 'required|date',
            'telepon' => 'required|numeric|digits_between:10,13|unique:nasabahs,telepon',
            'foto_ktp' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $path = $request->file('foto_ktp')->store('nasabah/foto', 'public');

        Nasabah::create(array_merge($validatedData, [
            'foto_ktp' => $path,
        ]));

        return redirect()->route('nasabah.index')->with('success', 'Nasabah added successfully');
    }

    public function show(string $id)
    {
        $nasabah = Nasabah::findOrFail($id);
        $nasabah->tanggal_lahir = Carbon::parse($nasabah->tanggal_lahir)->format('d-m-Y');
        return view('nasabah.show', compact('nasabah'));
    }

    public function edit(string $id)
    {
        $nasabah = Nasabah::findOrFail($id);
        return view('nasabah.edit', compact('nasabah'));
    }

    public function update(Request $request, string $id)
    {
        $nasabah = Nasabah::findOrFail($id);

        $validatedData = $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'nomor_identitas' => 'required|string|max:16|unique:nasabahs,nomor_identitas,' . $nasabah->id,
            'alamat_lengkap' => 'required|string',
            'kelurahan' => 'required|string|max:100',
            'kecamatan' => 'required|string|max:100',
            'kabupaten' => 'required|string|max:100',
            'propinsi' => 'required|string|max:100',
            'tempat_lahir' => 'required|string|max:100',
            'tanggal_lahir' => 'required|date',
            'telepon' => 'required|numeric|digits_between:10,13|unique:nasabahs,telepon,' . $nasabah->id,
            'foto_ktp' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);


        if ($request->hasFile('foto_ktp')) {
            if ($nasabah->foto_ktp) {
                $oldFilePath = public_path('storage/' . $nasabah->foto_ktp);
                if (File::exists($oldFilePath)) {
                    File::delete($oldFilePath);
                }
            }
            $filePath = $request->file('foto_ktp')->store('nasabah/foto', 'public');
            $validatedData['foto_ktp'] = $filePath;
        }
        $nasabah->update($validatedData);

        return redirect()->route('nasabah.index')->with('success', 'Nasabah updated successfully');
    }

    public function destroy($id)
    {
        $nasabah = Nasabah::find($id);

        if ($nasabah) {
            $nasabah->status_delete = '0 Delete';
            $nasabah->save();
            Transaksi::where('nasabah_id', $id)->update(['status_delete' => '0 Delete']);
            return redirect()->route('nasabah.index')->with('success', 'Data berhasil dihapus.');
        }

        return redirect()->route('nasabah.index')->with('error', 'Data tidak ditemukan.');
    }
}
