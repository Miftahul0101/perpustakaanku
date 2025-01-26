<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class RegisterController extends Controller
{
    public function showRegister()
    {
        return view('auth.register');
    }

    public function store(Request $request)
{
    // Validate input
    $validatedData = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|min:8|confirmed',
        'nim' => 'required|string|unique:mahasiswas',
        'jurusan' => 'required|string',
        'fakultas' => 'required|string',
        'angkatan' => 'required|integer',
        'jenis_kelamin' => 'required|in:L,P',
        'tanggal_lahir' => 'required|date',
        'alamat' => 'required|string',
        'no_telp' => 'required|string',
        'foto' => 'image|mimes:jpeg,png,jpg|max:2048'
    ]);

    // Start database transaction
    DB::beginTransaction();
    try {
        // Create user
        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
            'alamat' => $validatedData['alamat'],
            'no_telp' => $validatedData['no_telp'],
            'role' => 'mahasiswa'
        ]);

        // Handle foto upload
        $fotoPath = null;
        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('mahasiswa_photos', 'public');
        }

        // Create mahasiswa
        Mahasiswa::create([
            'user_id' => $user->id,
            'nim' => $validatedData['nim'],
            'jurusan' => $validatedData['jurusan'],
            'fakultas' => $validatedData['fakultas'],
            'angkatan' => $validatedData['angkatan'],
            'jenis_kelamin' => $validatedData['jenis_kelamin'],
            'tanggal_lahir' => $validatedData['tanggal_lahir'],
            'foto' => $fotoPath
        ]);

        DB::commit();

        // Redirect with success message
        return redirect()->route('login')->with('success', 'Registrasi berhasil! Silakan login.');
    } catch (\Exception $e) {
        DB::rollBack();
        return back()->withErrors(['msg' => 'Registrasi gagal: ' . $e->getMessage()]);
    }
}

}
