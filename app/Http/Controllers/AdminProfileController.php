<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Profile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AdminProfileController extends Controller
{
    public function adminProfile()
    {
        return view('admin.profile.index');
    }

    public function updateProfile(Request $request)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'nip' => 'required|string|max:20',
            'nomor_identitas' => 'required|string|max:50',
            'tempat_lahir' => 'required|string|max:100',
            'tanggal_lahir' => 'required|date',
            'status_perkawinan' => 'required|string|max:50',
            'alamat_lengkap' => 'required|string',
            'kode_pos' => 'required|string|max:10',
            'telepon' => 'required|string|max:15',
            'nama_orang_tua' => 'required|string|max:255',
        ]);

        // Ambil user dan profile terkait
        $user = Auth::user();
        $profile = $user->profile ?? new Profile();

        // Update data user
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

        // Update data profile
        $profile->user_id = $user->id;
        $profile->nip = $request->nip;
        $profile->nomor_identitas = $request->nomor_identitas;
        $profile->tempat_lahir = $request->tempat_lahir;
        $profile->tanggal_lahir = $request->tanggal_lahir;
        $profile->status_perkawinan = $request->status_perkawinan;
        $profile->alamat_lengkap = $request->alamat_lengkap;
        $profile->kode_pos = $request->kode_pos;
        $profile->telepon = $request->telepon;
        $profile->nama_orang_tua = $request->nama_orang_tua;

        $profile->save();

        return redirect()->route('admin.profile')->with('success', 'Profil berhasil diperbarui.');
    }
}
