<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function adminHome()
    {
        return view('admin.dashboard.index');
    }

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
        ]);

        // Ambil admin yang sedang login
        $user = Auth::User();

        // Jika ada file gambar
        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($user->image) {
                Storage::delete('public/profile_images/' . $user->image);
            }

            // Simpan gambar baru
            $file = $request->file('image');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/profile_images', $filename);
            $user->image = $filename; // Simpan nama file gambar
        }

        // Update nama admin
        $user->name = $request->name;

        // Simpan perubahan
        if (!$user->save()) {
            return redirect()->back()->withErrors(['error' => 'Gagal menyimpan profil.']);
        }

        // Mengarahkan kembali ke halaman profil dengan pesan sukses
        return redirect()->route('admin.home')->with('success', 'Profil berhasil diperbarui.');
    }
}
