<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::where('status_active', 'active')
            ->orderByRaw(" CASE
                WHEN role = 'admin' THEN 1
                WHEN role = 'appraisal' THEN 2
                WHEN role = 'approval' THEN 3
                WHEN role = 'customer service' THEN 4
                ELSE 5 END")->orderBy('name')->get();
        return view('auth.users.index', compact('users'));
    }

    public function getData(Request $request)
    {
        $query = User::where('status_active', 'active');

        return DataTables::of($query)
            ->addIndexColumn()
            ->addColumn('action', function ($user) {
                if ($user->role === 'admin') {
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
        return view('auth.users.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:users,name',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|confirmed',
            'role' => 'required|in:admin,approval,appraisal,customer service',
        ], [
            'name.unique' => 'Nama sudah terdaftar. Silakan pilih nama lain.',
            'email.unique' => 'Email sudah terdaftar. Silakan gunakan email lain.',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'status_active' => 'active',
        ]);

        return redirect()->route('users.index')->with('success', 'Akun berhasil dibuat.');
    }

    public function destroy(User $user)
    {
        $user->status_active = 'inactive';
        $user->save();

        return redirect()->route('users.index')->with('success', 'Akun berhasil dinonaktifkan.');
    }

    // public function edit(User $user)
    // {
    //     return view('auth.users.edit', compact('user'));
    // }

    // public function update(Request $request, User $user)
    // {
    //     $request->validate([
    //         'name' => 'required|string|max:255',
    //         'email' => 'required|email|unique:users,email,' . $user->id,
    //         'password' => 'nullable|string|confirmed',
    //         'role' => 'required|in:admin,approval,appraisal,customer service',
    //     ]);

    //     $user->update([
    //         'name' => $request->name,
    //         'email' => $request->email,
    //         'role' => $request->role,
    //         'password' => $request->password ? Hash::make($request->password) : $user->password,
    //     ]);

    //     return redirect()->route('auth.users.index')->with('success', 'Akun berhasil diperbarui.');
    // }

}
