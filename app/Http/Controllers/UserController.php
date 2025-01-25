<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::whereIn('role', ['admin', 'petugas'])->latest()->get();
        return view('users.index', compact('users'));
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'role' => 'required|in:admin,petugas',
            'alamat' => 'nullable|string',
            'no_telp' => 'nullable|string|max:15'
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'alamat' => $request->alamat,
            'no_telp' => $request->no_telp
        ]);

        return redirect()->route('users.index')
            ->with('success', 'User berhasil ditambahkan');
    }

    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    public function edit($id)
{
    $user = User::findOrFail($id);
    return view('users.edit', compact('user'));
}


public function update(Request $request, User $user)
{
    // Validasi data form
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
        'role' => 'required|in:admin,petugas',
        'alamat' => 'nullable|string',
        'no_telp' => 'nullable|string|max:15',
    ]);

    // Update data pengguna kecuali password
    $user->update([
        'name' => $request->name,
        'email' => $request->email,
        'role' => $request->role,
        'alamat' => $request->alamat,
        'no_telp' => $request->no_telp,
    ]);

    // Jika password diisi, validasi dan update
    if ($request->filled('password')) {
        $request->validate([
            'password' => 'required|string|min:8',
        ]);

        $user->update([
            'password' => Hash::make($request->password),
        ]);
    }

    // Redirect kembali ke halaman daftar pengguna dengan pesan sukses
    return redirect()->route('users.index')
        ->with('success', 'User berhasil diperbarui');
}


    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index')
            ->with('success', 'User berhasil dihapus');
    }
}