<?php

namespace App\Http\Controllers\Profile;
use App\Http\Controllers\Controller;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Profile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:admin|customer service|approval|appraisal');
    }

    public function show()
    {
        return view('profile.show');
    }

    public function edit()
    {
        return view('profile.edit');
    }

    public function Update(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Anda perlu login terlebih dahulu.');
        }
        $user = Auth::user();
        $profile = $user->profile;
        // dd($profile);

        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'nip' => 'required|string|max:18|unique:profile,nip,' . ($profile->id ?? 'null'),
            'nomor_identitas' => 'required|string|max:16|unique:profile,nomor_identitas,' . ($profile->id ?? 'null'),
            'tempat_lahir' => 'required|string|max:100',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|string|max:50',
            'alamat_lengkap' => 'required|string',
            'kode_pos' => 'required|string|max:10',
            'telepon' => 'required|string|max:15',
        ], [
            'nip.required' => 'NIP wajib diisi.',
            'nip.max' => 'NIP tidak boleh lebih dari 18 karakter.',
            'nip.unique' => 'NIP sudah ada. Mohon gunakan nomor NIP yang berbeda.',
            'nomor_identitas.required' => 'Nomor identitas wajib diisi.',
            'nomor_identitas.max' => 'Nomor identitas tidak boleh lebih dari 16 karakter.',
            'nomor_identitas.unique' => 'Nomor identitas sudah ada. Mohon gunakan nomor yang berbeda.',
        ]);

        $user->name = $request->name;

        if ($request->hasFile('image')) {
            if ($user->image) {
                Storage::delete('public/profile_images/' . $user->image);
            }

            $file = $request->file('image');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/profile_images', $filename);
            $user->image = $filename;
        }

        $user->save();

        if (!$profile) {
            $profile = new Profile();
            $profile->user_id = $user->id;
        }

        $profile->nip = $request->nip;
        $profile->nomor_identitas = $request->nomor_identitas;
        $profile->tempat_lahir = $request->tempat_lahir;
        $profile->tanggal_lahir = $request->tanggal_lahir;
        $profile->jenis_kelamin = $request->jenis_kelamin;
        $profile->alamat_lengkap = $request->alamat_lengkap;
        $profile->kode_pos = $request->kode_pos;
        $profile->telepon = $request->telepon;

        $profile->save();

        return redirect()->route('profile.show')->with('success', 'Profil berhasil diperbarui.');
    }
}
