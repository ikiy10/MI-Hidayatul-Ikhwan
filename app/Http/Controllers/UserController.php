<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;
use App\Exports\UsersExport;
use Maatwebsite\Excel\Facades\Excel;


class UserController extends Controller
{
    public function create()
    {
        return view('admin.users');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_lengkap'     => 'required|string|max:255',
            'email'            => 'required|email|unique:users,email',
            'no_hp'            => 'required|string|max:15',
            'password'         => 'required|string|min:6|confirmed',
            'role'             => 'required|in:admin,user',
            'jenis_kelamin'    => 'required|in:L,P',
            'tanggal_lahir'    => 'required|date',
            'alamat'           => 'required|string|max:500',
        ]);

        User::create([
            'nama_lengkap'     => $request->nama_lengkap,
            'email'            => $request->email,
            'no_hp'            => $request->no_hp,
            'password'         => Hash::make($request->password),
            'role'             => $request->role,
            'jenis_kelamin'    => $request->jenis_kelamin,
            'tanggal_lahir'    => $request->tanggal_lahir,
            'alamat'           => $request->alamat,
        ]);

        return redirect()->back()->with('success', 'User berhasil ditambahkan.');
    }

    public function laporan(Request $request)
    {
        $query = User::query();

        if ($request->has('role') && $request->role !== '') {
            $query->where('role', $request->role);
        }

        $users = $query->orderBy('created_at', 'desc')->get();

        return view('admin.laporan.laporan_users', compact('users'));
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('user.laporan')->with('success', 'Data user berhasil dihapus.');
    }

    public function export(Request $request)
    {
        $role = $request->role;
        return Excel::download(new UsersExport($role), 'laporan_users.xlsx');
    }

}
