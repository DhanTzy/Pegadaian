<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function register()
    {
        return view('auth/register');
    }

    public function registerSave(Request $request)
    {
        Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed'
        ])->validate();

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'type' => "0"
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

        if (!Auth::attempt($request->only('email', 'password'), $request->boolean('remember'))) {
            throw ValidationException::withMessages([
                'email' => trans('auth.failed')
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

    // public function changePassword()
    // {
    //     return view('admin.password');
    // }

    // public function updatePassword(Request $request)
    // {
    //     $request->validate([
    //         'current_password' => 'required',
    //         'password' => 'required|confirmed',
    //     ]);

    //     $user = Auth::user();

    //     if (!Hash::check($request->current_password, $user->password)) {
    //         return back()->withErrors(['current_password' => 'Password saat ini tidak cocok.']);
    //     }

    //     $user->password = Hash::make($request->new_password);
    //     $user->save();

    //     return redirect()->route('admin.password')->with('status', 'Password berhasil diubah.');
    // }
}
