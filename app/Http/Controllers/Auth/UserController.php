<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Karyawan;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:admin');
    }

    public function index()
    {
        return view('auth.users.index');
    }

    public function getData(Request $request)
    {
        $query = User::where('status_active', 'active');

        return DataTables::of($query)
            ->addIndexColumn()
            ->addColumn('roles', function ($user) {
                return $user->getRoleNames()->implode(', ');
            })
            ->addColumn('action', function ($user) {
                if ($user->hasRole('admin')) {
                    return '';
                }

                return '
                <form action="' . route('users.destroy', $user->id) . '" method="POST" style="display: inline-block;">
                    ' . csrf_field() . '
                    ' . method_field('DELETE') . '
                    <button type="submit" class="btn btn-danger" onclick="return confirm(\'Yakin ingin menghapus akun ini?\')">
                        <i class="fas fa-trash-alt"></i>
                    </button>
                </form>
                ';
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function create()
    {
        $roles = Role::all();
        $karyawans = Karyawan::doesntHave('user')->get();
        return view('auth.users.create', compact('roles', 'karyawans'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'karyawan_id' => 'required|exists:karyawan,id',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|confirmed',
            'role' => 'required|in:admin,approval,appraisal,customer service',
        ], [
            'karyawan_id.unique' => 'Nama sudah terdaftar. Silakan pilih nama lain.',
            'email.unique' => 'Email sudah terdaftar. Silakan gunakan email lain.',
        ]);

        $karyawan = Karyawan::findOrFail($request->karyawan_id);

        $user = User::create([
            'name' => $karyawan->nama_lengkap,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'status_active' => 'active',
        ]);

        $user->assignRole($request->role);

        $karyawan->user_id = $user->id;
        $karyawan->save();

        return redirect()->route('users.index')->with('success', 'Akun berhasil dibuat.');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);

        if ($user->hasRole('admin')) {
            return redirect()->route('users.index')->with('error', 'Admin tidak bisa dihapus.');
        }

        $user->status_active = 'inactive';
        $user->save();

        $user->delete();
        return redirect()->route('users.index')->with('success', 'Akun berhasil dihapus.');
    }
}
