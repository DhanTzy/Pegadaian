<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{

    public function __construct()
    {
        $this->middleware('guest')->except(['logout', 'changePassword', 'changePasswordSave']);
    }

    public function register()
    {
        return view('auth/register');
    }

    public function registerSave(Request $request)
    {
        Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed'
        ], [
            'email.unique' => 'Email sudah terdaftar. Silakan gunakan email lain.',
            'email.required' => 'Email wajib diisi.',
            'password_confirmation' => 'Konfirmasi password tidak cocok.'
        ])->validate();

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'type' => "1"
        ]);

        return redirect()->route('login');
    }


    public function login()
    {
        return view('auth/login');
    }

    public function loginAction(Request $request)
    {
        Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required'
        ])->validate();

        // Cek apakah email terdaftar
        $user = User::where('email', $request->email)->first();
        if (!$user) {
            throw ValidationException::withMessages([
                'email' => 'Email belum terdaftar, Silahkan daftar terlebih dahulu.'
            ]);
        }

        // Cek kombinasi email dan password
        if (!Auth::attempt($request->only('email', 'password'), $request->boolean('remember'))) {
            throw ValidationException::withMessages([
                'password' => 'Password yang anda masukkan salah, Silahkan isi dengan benar.'
            ]);
        }

        $request->session()->regenerate();

        $user = auth()->user();
        if ($user->type == 'admin') {
            if (is_null($user->image) || empty($user->name)) {
                return redirect()->route('admin.profile')->with('message', 'Silakan Lengkapi Profil Anda Terlebih Dahulu');
            }
            return redirect()->route('admin.home');
        }

        if ($user->type == 'user') {
            if (is_null($user->image) || empty($user->name)) {
                return redirect()->route('user.profile')->with('message', 'Silakan Lengkapi Profil Anda Terlebih Dahulu');
            }
            return redirect()->route('home');
        }
        return redirect()->route('dashboard');
    }


    public function logout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        return redirect('/');
    }

    public function changePassword()
    {
        return view('auth/password');
    }

    public function changePasswordSave(Request $request)
    {
        // Validasi input dengan pesan kustom
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|confirmed',
        ], [
            'current_password.required' => 'Password lama wajib diisi.',
            'new_password.required' => 'Password baru wajib diisi.',
            'new_password.confirmed' => 'Konfirmasi password baru tidak sesuai.',
        ]);

        $user = Auth::user();

        // Cek apakah password lama sesuai
        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Password lama tidak sesuai.']);
        }

        // Update password
        $user->update([
            'password' => Hash::make($request->new_password),
        ]);

        return redirect()->route('auth.password')->with('success', 'Password berhasil diubah.');
    }
}
