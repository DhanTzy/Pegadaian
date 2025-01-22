<?php

namespace App\Http\Controllers\Karyawan;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Karyawan;
use App\Models\Pekerjaan;
use App\Models\AnggotaKeluarga;
use Carbon\Carbon;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\File;

class KaryawanController extends Controller
{
    public function index()
    {
        $pekerjaans = Pekerjaan::all();
        $karyawan = Karyawan::with('pekerjaan')->get();
        return view('karyawan.index', compact('karyawan', 'pekerjaans'));
    }

    public function getData(Request $request)
    {
        $query = Karyawan::with('pekerjaan')
            ->where('status_delete', '1');

        if ($request->has('nama_lengkap') && $request->input('nama_lengkap') != '') {
            $query->where('nama_lengkap', 'LIKE', '%' . $request->input('nama_lengkap') . '%');
        }

        if ($request->has('nip') && $request->input('nip') != '') {
            $query->where('nip', 'LIKE', '%' . $request->input('nip') . '%');
        }

        if ($request->has('pekerjaan_id') && $request->input('pekerjaan_id') != '') {
            $query->where('pekerjaan_id', $request->input('pekerjaan_id'));
        }

        if ($request->has('tanggal_gabung') && $request->input('tanggal_gabung') != '') {
            $query->where('created_at', '>=', $request->input('tanggal_gabung'));
        }

        if ($request->has('tanggal_akhir') && $request->input('tanggal_akhir') != '') {
            $query->where('created_at', '<=', $request->input('tanggal_akhir'));
        }

        return DataTables::of($query)
            ->addIndexColumn()
            ->addColumn('posisi_pekerjaan', function ($karyawan) {
                return $karyawan->pekerjaan ? $karyawan->pekerjaan->posisi_pekerjaan : '-';
            })
            ->addColumn('action', function ($karyawan) {
                $anggotaKeluarga = $karyawan->anggotaKeluarga->map(function ($anggota) {
                    return [
                        'status_kekeluargaan' => $anggota->status_kekeluargaan,
                        'nama' => $anggota->nama,
                        'nik' => $anggota->nik,
                    ];
                });
                return '
            <button class="btn btn-info btn-sm me-2" data-bs-toggle="modal" data-bs-target="#karyawanDetailModal"
                    data-nip="' . $karyawan->nip . '"
                    data-no_identitas="' . $karyawan->no_identitas . '"
                    data-nama_lengkap="' . $karyawan->nama_lengkap . '"
                    data-posisi_pekerjaan="' . $karyawan->pekerjaan->posisi_pekerjaan . '"
                    data-jenis_kelamin="' . $karyawan->jenis_kelamin . '"
                    data-tempat_lahir="' . $karyawan->tempat_lahir . '"
                    data-tanggal_lahir="' .  Carbon::parse($karyawan->tanggal_lahir)->format('d-m-Y') . '"
                    data-agama="' . $karyawan->agama . '"
                    data-no_telepon="' . $karyawan->no_telepon . '"
                    data-kewarganegaraan="' . $karyawan->kewarganegaraan . '"
                    data-status_perkawinan="' . $karyawan->status_perkawinan . '"
                    data-alamat_lengkap="' . $karyawan->alamat_lengkap . '"
                    data-kode_pos="' . $karyawan->kode_pos . '"
                    data-created_at="' . Carbon::parse($karyawan->created_at)->format('d-m-Y') . '"
                    data-foto_ktp="' . asset('storage/' . $karyawan->foto_ktp) . '">
                <i class="fas fa-info-circle"></i>
            </button>
            <a href="' . route('karyawan.edit', $karyawan->id) . '" class="btn btn-success btn-sm me-2"><i class="fas fa-edit"></i></a>
            <form action="' . route('karyawan.destroy', $karyawan->id) . '" method="POST" style="display:inline;">
                ' . csrf_field() . '
                ' . method_field('DELETE') . '
                <button type="submit" class="btn btn-danger btn-sm me-2" onclick="return confirm(\'Yakin ingin menghapus data ini?\')"><i class="fas fa-trash-alt"></i></button>
            </form>
        ';
            })->editColumn('tanggal_lahir', function ($karyawan) {
                return Carbon::parse($karyawan->tanggal_lahir)->format('d-m-Y');
            })->rawColumns(['action'])->make(true);
    }

    public function create()
    {
        $pekerjaans = Pekerjaan::all();
        return view('karyawan.create', compact('pekerjaans'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nip' => 'required|string|max:18|unique:karyawan,nip',
            'no_identitas' => 'required|string|max:16|unique:karyawan,no_identitas',
            'nama_lengkap' => 'required|string',
            'pekerjaan_id' => 'required|exists:pekerjaan,id',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'tempat_lahir' => 'required|string',
            'tanggal_lahir' => 'required|date',
            'agama' => 'required|string',
            'kewarganegaraan' => 'required|string',
            'status_perkawinan' => 'required|in:Belum Menikah,Menikah',
            'no_telepon' => 'required|string|max:13|unique:karyawan,no_telepon',
            'alamat_lengkap' => 'required|string',
            'kode_pos' => 'required|digits:5',
            'foto_ktp' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            // 'foto_kk' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            // 'anggota_keluarga.*.status_kekeluargaan' => 'required|string',
            // 'anggota_keluarga.*.nama' => 'required|string',
            // 'anggota_keluarga.*.nik' => 'required|string',
        ], [
            'nip.required' => 'NIP wajib diisi.',
            'nip.string' => 'NIP harus berupa teks.',
            'nip.max' => 'NIP tidak boleh lebih dari 18 karakter.',
            'nip.unique' => 'NIP sudah ada. Mohon masukkan nomor NIP anda dengan benar.',
            'no_identitas.required' => 'Nomor identitas wajib diisi.',
            'no_identitas.max' => 'Nomor identitas tidak boleh lebih dari 16 karakter.',
            'no_identitas.unique' => 'Nomor identitas sudah terdaftar. Mohon masukkan nomor indentitas anda dengan benar.',
            'nama_lengkap.required' => 'Nama lengkap wajib diisi.',
            'jenis_kelamin.required' => 'Jenis kelamin wajib diisi.',
            'jenis_kelamin.in' => 'Jenis kelamin hanya boleh Laki-laki atau Perempuan.',
            'tempat_lahir.required' => 'Tempat lahir wajib diisi.',
            'tanggal_lahir.required' => 'Tanggal lahir wajib diisi.',
            'tanggal_lahir.date' => 'Tanggal lahir harus berupa tanggal yang valid.',
            'agama.required' => 'Agama wajib diisi.',
            'kewarganegaraan.required' => 'Kewarganegaraan wajib diisi.',
            'status_perkawinan.required' => 'Status perkawinan wajib diisi.',
            'status_perkawinan.in' => 'Status perkawinan hanya boleh Belum Menikah atau Menikah.',
            'no_telepon.required' => 'Nomor telepon wajib diisi.',
            'no_telepon.unique' => 'Telepon sudah terdaftar. Mohon masukkan nomor telepon anda dengan benar.',
            'alamat_lengkap.required' => 'Alamat lengkap wajib diisi.',
            'alamat_lengkap.string' => 'Alamat lengkap harus berupa teks.',
            'kode_pos.required' => 'Kode pos wajib diisi.',
            'kode_pos.digits' => 'Kode pos harus terdiri dari 5 digit.',
            'foto_ktp.required' => 'Foto KTP wajib diunggah.',
            'foto_ktp.image' => 'Foto KTP harus berupa gambar.',
            'foto_ktp.mimes' => 'Foto KTP harus berformat jpeg, png, jpg, atau gif.',
            'foto_ktp.max' => 'Foto KTP tidak boleh lebih dari 2MB.',
            'foto_kk.required' => 'Foto KK wajib diunggah.',
            // 'foto_kk.image' => 'Foto KK harus berupa gambar.',
            // 'foto_kk.mimes' => 'Foto KK harus berformat jpeg, png, jpg, atau gif.',
            // 'foto_kk.max' => 'Foto KK tidak boleh lebih dari 2MB.',
            // 'anggota_keluarga.*.status_kekeluargaan.required' => 'Status kekeluargaan wajib diisi untuk setiap anggota keluarga.',
            // 'anggota_keluarga.*.status_kekeluargaan.string' => 'Status kekeluargaan harus berupa teks.',
            // 'anggota_keluarga.*.nama.required' => 'Nama anggota keluarga wajib diisi.',
            // 'anggota_keluarga.*.nama.string' => 'Nama anggota keluarga harus berupa teks.',
            // 'anggota_keluarga.*.nik.required' => 'NIK anggota keluarga wajib diisi.',
        ]);


        // Upload foto
        $ktpPath = $request->file('foto_ktp')->store('karyawan/foto', 'public');
        // $kkPath = $request->file('foto_kk')->store('karyawan/foto', 'public');

        // Simpan data karyawan ke database
        $karyawan = Karyawan::create(array_merge($validatedData, [
            'foto_ktp' => $ktpPath,
            // 'foto_kk' => $kkPath,
        ]));

        // Simpan data anggota keluarga jika ada
        // if ($request->has('anggota_keluarga')) {
        //     foreach ($request->anggota_keluarga as $anggota) {
        //         AnggotaKeluarga::create([
        //             'karyawan_id' => $karyawan->id,
        //             'status_kekeluargaan' => $anggota['status_kekeluargaan'],
        //             'nama' => $anggota['nama'],
        //             'nik' => $anggota['nik'],
        //         ]);
        //     }
        // }
        return redirect()->route('karyawan.index')->with('success', 'Karyawan berhasil ditambahkan.');
    }


    public function show(string $id)
    {
        $karyawan = Karyawan::findOrFail($id);
        $karyawan->tanggal_lahir = Carbon::parse($karyawan->tanggal_lahir)->format('d-m-y');
        return view('karyawan.edit', compact('karyawan'));
    }

    public function edit(string $id)
    {
        $karyawan = Karyawan::findOrFail($id);
        $pekerjaans = Pekerjaan::all();
        return view('karyawan.edit', compact('karyawan', 'pekerjaans'));
    }

    public function update(Request $request, string $id)
    {
        $karyawan = Karyawan::findOrFail($id);

        $validatedData = $request->validate([
            'nip' => 'required|string|max:18|unique:karyawan,nip,' . $karyawan->id,
            'no_identitas' => 'required|string|max:16|unique:karyawan,no_identitas,' . $karyawan->id,
            'no_telepon' => 'required|string|max:13|unique:karyawan,no_telepon,' . $karyawan->id,
            'nama_lengkap' => 'required|string',
            'pekerjaan_id' => 'required|exists:pekerjaan,id',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'tempat_lahir' => 'required|string',
            'tanggal_lahir' => 'required|date',
            'agama' => 'required|string',
            'kewarganegaraan' => 'required|string',
            'status_perkawinan' => 'required|in:Belum Menikah,Menikah',
            'alamat_lengkap' => 'required|string',
            'kode_pos' => 'required|digits:5',
            'foto_ktp' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            // 'foto_kk' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            // 'anggota_keluarga.*.id' => 'nullable|exists:anggota_keluarga,id',
            // 'anggota_keluarga.*.status_kekeluargaan' => 'required|string',
            // 'anggota_keluarga.*.nama' => 'required|string',
            // 'anggota_keluarga.*.nik' => 'required|string',
        ], [
            'nip.unique' => 'NIP sudah ada. Mohon masukkan nomor NIP anda dengan benar.',
            'no_identitas.unique' => 'Nomor identitas sudah terdaftar. Mohon masukkan nomor indentitas anda dengan benar.',
            'no_telepon.unique' => 'Telepon sudah terdaftar. Mohon masukkan nomor telepon anda dengan benar.',
        ]);

        // $karyawan = Karyawan::findOrFail($id);

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

        // if ($request->hasFile('foto_kk')) {
        //     if ($karyawan->foto_kk) {
        //         $oldKKPath = public_path('storage/' . $karyawan->foto_kk);
        //         if (File::exists($oldKKPath)) {
        //             File::delete($oldKKPath);
        //         }
        //     }
        //     $kkPath = $request->file('foto_kk')->store('karyawan/foto', 'public');
        //     $validatedData['foto_kk'] = $kkPath;
        // }

        // Update data karyawan
        $karyawan->update($validatedData);

        // Mengupdate anggota keluarga
        // if ($request->has('anggota_keluarga')) {
        //     // Menyaring anggota keluarga berdasarkan ID
        //     $anggotaKeluarga = collect($request->anggota_keluarga);

        //     // Menghapus anggota keluarga yang sudah tidak ada di form
        //     $existingIds = $anggotaKeluarga->pluck('id')->filter();
        //     AnggotaKeluarga::where('karyawan_id', $karyawan->id)
        //         ->whereNotIn('id', $existingIds)
        //         ->delete();

        //     foreach ($anggotaKeluarga as $anggota) {
        //         // Update anggota keluarga yang ada
        //         if (isset($anggota['id']) && $anggota['id']) {
        //             $existingAnggota = AnggotaKeluarga::find($anggota['id']);
        //             if ($existingAnggota) {
        //                 $existingAnggota->update([
        //                     'status_kekeluargaan' => $anggota['status_kekeluargaan'],
        //                     'nama' => $anggota['nama'],
        //                     'nik' => $anggota['nik'],
        //                 ]);
        //             }
        //         } else {
        //             // Tambah anggota keluarga baru jika tidak ada ID
        //             AnggotaKeluarga::create([
        //                 'karyawan_id' => $karyawan->id,
        //                 'status_kekeluargaan' => $anggota['status_kekeluargaan'],
        //                 'nama' => $anggota['nama'],
        //                 'nik' => $anggota['nik'],
        //             ]);
        //         }
        //     }
        // }

        return redirect()->route('karyawan.index')->with('success', 'Karyawan updated successfully');
    }


    public function destroy($id)
    {
        $karyawan = Karyawan::find($id);

        if ($karyawan) {
            $karyawan->status_delete = '0';
            $karyawan->save();
            return redirect()->route('karyawan.index')->with('success', 'Data berhasil dihapus.');
        }

        return redirect()->route('karyawan.index')->with('error', 'Data tidak ditemukan.');
    }
}
