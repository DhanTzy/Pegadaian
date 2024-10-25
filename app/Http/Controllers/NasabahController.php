<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Nasabah;
use Illuminate\Support\Facades\File;
use Yajra\DataTables\DataTables;
use Carbon\Carbon;

class NasabahController extends Controller
{
    public function index(Request $request)
    {
        return view('admin.nasabah.index');
    }

    public function getData(Request $request)
    {
        $nasabah = Nasabah::where('status_delete', '1');

        return DataTables::of($nasabah)
            ->addColumn('action', function ($nasabah) {
                return '
                <button type="button" class="btn btn-info btn-sm me-2"
                        data-bs-toggle="modal"
                        data-bs-target="#nasabahDetailModal"
                        data-alamat_lengkap="' . $nasabah->alamat_lengkap . '"
                        data-kode_pos="' . $nasabah->kode_pos . '"
                        data-email="' . $nasabah->email . '"
                        data-telepon="' . $nasabah->telepon . '"
                        data-nama_orang_tua="' . $nasabah->nama_orang_tua . '"
                        data-foto_ktp_sim="' . asset('storage/' . $nasabah->foto_ktp_sim) . '">
                    Detail
                </button>
                <a href="' . route('admin.nasabah.edit', $nasabah->id) . '" class="btn btn-success btn-sm me-2">Edit</a>
                <form action="' . route('admin.nasabah.destroy', $nasabah->id) . '" method="POST"
                      onsubmit="return confirm(\'Apakah Anda Yakin Menghapus Data Ini?\')" class="d-inline">
                    ' . csrf_field() . '
                    ' . method_field('DELETE') . '
                    <button class="btn btn-danger btn-sm">Delete</button>
                </form>
            ';
            })->editColumn('tanggal_lahir', function ($nasabah){
            return Carbon::parse($nasabah->tanggal_lahir)->format('d/m/y');
        })->rawColumns(['action'])->make(true);
    }

    public function create()
    {
        return view('admin.nasabah.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'identitas' => 'required',
            'nomor_identitas' => 'required|string|max:20',
            'nama_lengkap' => 'required|string|max:255',
            'tempat_lahir' => 'required|string|max:100',
            'tanggal_lahir' => 'required|date',
            'status_perkawinan' => 'required|in:Belum Menikah,Menikah',
            'alamat_lengkap' => 'required|string',
            'kode_pos' => 'required|digits:5',
            'pekerjaan' => 'required|string|max:100',
            'email' => 'required|email|max:255',
            'telepon' => 'required|numeric|digits_between:10,13',
            'nama_orang_tua' => 'required|string|max:255',
            'foto_ktp_sim' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $path = $request->file('foto_ktp_sim')->store('nasabah/foto', 'public');

        // Simpan ke database
        Nasabah::create(array_merge($validatedData, [
            'foto_ktp_sim' => $path,
        ]));

        return redirect()->route('admin.nasabah')->with('success', 'Nasabah added successfully');
    }

    public function show(string $id)
    {
        $nasabah = Nasabah::findOrFail($id);
        $nasabah->tanggal_lahir = Carbon::parse($nasabah->tanggal_lahir)->format('d/m/Y');
        return view('admin.nasabah.show', compact('nasabah'));
    }

    public function edit(string $id)
    {
        $nasabah = Nasabah::findOrFail($id);
        return view('admin.nasabah.edit', compact('nasabah'));
    }

    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'identitas' => 'required',
            'nomor_identitas' => 'required|string|max:20',
            'nama_lengkap' => 'required|string|max:255',
            'tempat_lahir' => 'required|string|max:100',
            'tanggal_lahir' => 'required|date',
            'status_perkawinan' => 'required|in:Belum Menikah,Menikah',
            'alamat_lengkap' => 'required|string',
            'kode_pos' => 'required|digits:5',
            'pekerjaan' => 'required|string|max:100',
            'email' => 'required|email|max:255',
            'telepon' => 'required|numeric|digits_between:10,13',
            'nama_orang_tua' => 'required|string|max:255',
            'foto_ktp_sim' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $nasabah = Nasabah::findOrFail($id);
        if ($request->hasFile('foto_ktp_sim')) {
            if ($nasabah->foto_ktp_sim) {
                $oldFilePath = public_path('storage/' . $nasabah->foto_ktp_sim);
                if (File::exists($oldFilePath)) {
                    File::delete($oldFilePath);
                }
            }
            $filePath = $request->file('foto_ktp_sim')->store('nasabah/foto', 'public');
            $validatedData['foto_ktp_sim'] = $filePath;
        }
        $nasabah->update($validatedData);

        return redirect()->route('admin.nasabah')->with('success', 'Nasabah updated successfully');
    }

    public function destroy($id)
    {
        $nasabah = Nasabah::find($id);

        if ($nasabah) {
            $nasabah->status_delete = '0';
            $nasabah->save();
            return redirect()->route('admin.nasabah')->with('success', 'Data berhasil dihapus.');
        }

        return redirect()->route('admin.nasabah')->with('error', 'Data tidak ditemukan.');
    }
}
