<?php

namespace App\Http\Controllers\User\Profile;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\User;

class UserProfileController extends Controller
{
    // Menampilkan halaman profil pengguna
    public function show()
    {
        return view('user.userprofile.index');
    }

    // Mengupdate profil pengguna
    public function update(Request $request)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Max 2MB
        ]);

        // Ambil pengguna yang sedang login
        $user = Auth::user();

        // Update nama
        $user->name = $request->name;

        // Cek jika ada gambar yang diunggah
        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($user->image) {
                Storage::delete('public/profile_images/' . $user->image);
            }

            // Simpan gambar baru
            $imageName = time() . '_' . $request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public/profile_images', $imageName);
            $user->image = $imageName; // Simpan nama gambar ke database
        }

        // Simpan perubahan pengguna
        $user->save();

        return redirect()->route('home')->with('success', 'Profil berhasil diperbarui!');
    }
}
