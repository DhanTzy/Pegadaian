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

        if ($user->status_active === 'inactive') {
            throw ValidationException::withMessages([
                'email' => 'Akun anda sedang tidak aktif, mohon aktifkan kembali dengan menghubungi admin.',
            ]);
        }

        if (!Auth::attempt($request->only('email', 'password'), $request->boolean('remember'))) {
            throw ValidationException::withMessages([
                'password' => 'Password yang anda masukkan salah, Silahkan isi dengan benar.'
            ]);
        }

        $request->session()->regenerate();

        $user = auth()->user();
        if ($user->role == 'admin') {
            if (is_null($user->image) || empty($user->name)) {
                return redirect()->route('profile.edit')->with('message', 'Silakan Lengkapi Profil Anda Terlebih Dahulu');
            }
            return redirect()->route('dashboard.index');
        }
        // $user = auth()->user();
        // if ($user->role == 'approval') {
        //     if (is_null($user->image) || empty($user->name)) {
        //         return redirect()->route('profile.edit')->with('message', 'Silakan Lengkapi Profil Anda Terlebih Dahulu');
        //     }
        //     return redirect()->route('dashboard.index');
        // }
        // $user = auth()->user();
        // if ($user->role == 'appraisal') {
        //     if (is_null($user->image) || empty($user->name)) {
        //         return redirect()->route('profile.edit')->with('message', 'Silakan Lengkapi Profil Anda Terlebih Dahulu');
        //     }
        //     return redirect()->route('dashboard.index');
        // }
        // $user = auth()->user();
        // if ($user->role == 'customer service') {
        //     if (is_null($user->image) || empty($user->name)) {
        //         return redirect()->route('profile.edit')->with('message', 'Silakan Lengkapi Profil Anda Terlebih Dahulu');
        //     }
        //     return redirect()->route('dashboard.index');
        // }
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
        return view('auth.password');
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
        $user = User::find($user->id);
        $user->password = Hash::make($request->new_password);
        $user->save();

        return redirect()->route('auth.password')->with('success', 'Password berhasil diubah.');
    }
}

    // public function register()
    // {
    //     return view('auth/register');
    // }

    // public function registerSave(Request $request)
    // {
    //     Validator::make($request->all(), [
    //         'name' => 'required',
    //         'email' => 'required|email|unique:users,email',
    //         'password' => 'required|confirmed'
    //     ], [
    //         'email.unique' => 'Email sudah terdaftar. Silakan gunakan email lain.',
    //         'email.required' => 'Email wajib diisi.',
    //         'password_confirmation' => 'Konfirmasi password tidak cocok.'
    //     ])->validate();

    //     User::create([
    //         'name' => $request->name,
    //         'email' => $request->email,
    //         'password' => Hash::make($request->password),
    //         'role' => 'customer service'
    //     ]);

    //     return redirect()->route('login');
    // }

