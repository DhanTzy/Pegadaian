<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Karyawan;
use App\Models\RiwayatPendidikan;
use Carbon\Carbon;
use Illuminate\Support\Facades\File;

class KaryawanController extends Controller
{
    public function index(Request $request)
    {
        $karyawan = Karyawan::where('status_delete', '1')->orderBy('created_at', 'ASC')->get();

        foreach ($karyawan as $item) {
            $item->tanggal_lahir = Carbon::parse($item->tanggal_lahir)->format('d/m/y');
        }
        return view('admin.karyawan.index', compact('karyawan'));
    }


    public function create()
    {
        return view('admin.karyawan.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama_lengkap' => 'required',
            'posisi_pekerjaan' => 'required',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required|date',
            'agama' => 'required',
            'kewarganegaraan' => 'required',
            'status_perkawinan' => 'required|in:Belum Menikah,Menikah',
            'no_telepon' => 'required',
            'email' => 'required|email',
            'alamat_lengkap' => 'required|string',
            'kode_pos' => 'required|digits:5',
            'foto_ktp' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'foto_kk' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'riwayat_pendidikan' => 'nullable|array', // Ubah menjadi opsional
            'riwayat_pendidikan.*.pendidikan' => 'string|max:255|required',
            'riwayat_pendidikan.*.jurusan' => 'string|max:255|nullable',
            'riwayat_pendidikan.*.jenjang_pendidikan' => 'string|max:255|nullable',
            'riwayat_pendidikan.*.tahun_lulus' => 'string|max:4|required',
            'riwayat_pendidikan.*.ipk_nilai' => 'numeric|nullable',
        ]);

        $ktpPath = $request->file('foto_ktp')->store('karyawan/foto', 'public');
        $kkPath = $request->file('foto_kk')->store('karyawan/foto', 'public');

        // Simpan ke database
        $karyawan = Karyawan::create(array_merge($validatedData, [
            'foto_ktp' => $ktpPath,
            'foto_kk' => $kkPath,
        ]));

        // Simpan riwayat pendidikan jika ada
        if ($request->has('riwayat_pendidikan')) {
            foreach ($request->riwayat_pendidikan as $pendidikan) {
                RiwayatPendidikan::create([
                    'karyawan_id' => $karyawan->id,
                    'pendidikan' => $pendidikan['pendidikan'],
                    'jurusan' => $pendidikan['jurusan'] ?? null,
                    'jenjang_pendidikan' => $pendidikan['jenjang_pendidikan'] ?? null,
                    'tahun_lulus' => $pendidikan['tahun_lulus'],
                    'ipk_nilai' => $pendidikan['ipk_nilai'] ?? null,
                ]);
            }
        }

        return redirect()->route('admin.karyawan')->with('success', 'Karyawan added successfully');
    }

    public function show(string $id)
    {
        $karyawan = Karyawan::findOrFail($id);
        $karyawan->tanggal_lahir = Carbon::parse($karyawan->tanggal_lahir)->format('d/m/y');
        return view('admin.karyawan.show', compact('karyawan'));
    }

    public function edit(string $id)
    {
        $karyawan = Karyawan::findOrFail($id);
        return view('admin.karyawan.edit', compact('karyawan'));
    }

    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'nama_lengkap' => 'required',
            'posisi_pekerjaan' => 'required',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required|date',
            'agama' => 'required',
            'kewarganegaraan' => 'required',
            'status_perkawinan' => 'required|in:Belum Menikah,Menikah',
            'no_telepon' => 'required',
            'email' => 'required|email',
            'alamat_lengkap' => 'required',
            'kode_pos' => 'required|digits:5',
            'foto_ktp' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'foto_kk' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'riwayat_pendidikan' => 'nullable|array',
            'riwayat_pendidikan.*.pendidikan' => 'string|max:255|required',
            'riwayat_pendidikan.*.jurusan' => 'string|max:255|nullable',
            'riwayat_pendidikan.*.jenjang_pendidikan' => 'string|max:255|nullable',
            'riwayat_pendidikan.*.tahun_lulus' => 'string|max:4|required',
            'riwayat_pendidikan.*.ipk_nilai' => 'numeric|nullable',
        ]);

        $karyawan = Karyawan::findOrFail($id);

        // Penanganan foto
        if ($request->hasFile('foto_ktp')) {
            if ($karyawan->foto_ktp) {
                $oldFilePath = public_path('storage/' . $karyawan->foto_ktp);
                if (File::exists($oldFilePath)) {
                    File::delete($oldFilePath);
                }
            }
            $filePath = $request->file('foto_ktp')->store('karyawan/foto', 'public');
            $validatedData['foto_ktp'] = $filePath;
        }

        if ($request->hasFile('foto_kk')) {
            if ($karyawan->foto_kk) {
                $oldKKPath = public_path('storage/' . $karyawan->foto_kk);
                if (File::exists($oldKKPath)) {
                    File::delete($oldKKPath);
                }
            }
            $kkPath = $request->file('foto_kk')->store('karyawan/foto', 'public');
            $validatedData['foto_kk'] = $kkPath;
        }

        // Update data karyawan
        $karyawan->update($validatedData);

        if ($request->has('riwayat_pendidikan')) {
            foreach ($request->riwayat_pendidikan as $index => $pendidikan) {
                if (isset($pendidikan['id'])) {
                    // Update riwayat pendidikan yang sudah ada
                    $riwayat = RiwayatPendidikan::find($pendidikan['id']);
                    $riwayat->update([
                        'pendidikan' => $pendidikan['pendidikan'],
                        'jurusan' => $pendidikan['jurusan'] ?? null,
                        'jenjang_pendidikan' => $pendidikan['jenjang_pendidikan'] ?? null,
                        'tahun_lulus' => $pendidikan['tahun_lulus'],
                        'ipk_nilai' => $pendidikan['ipk_nilai'] ?? null,
                    ]);
                }
            }
        }

        return redirect()->route('admin.karyawan')->with('success', 'Karyawan updated successfully');
    }

    public function destroy($id)
    {
        $karyawan = Karyawan::find($id);

        if ($karyawan)
        {
            $karyawan->status_delete = '0';
            $karyawan->save();
            return redirect()->route('admin.karyawan')->with('success', 'Data berhasil dihapus.');
        }

        return redirect()->route('admin.karyawan')->with('error', 'Data tidak ditemukan.');
    }
}
