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

    public function register(Request $request)
    {
        // Validate the request
        $request->validate([
            // User validation
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'alamat' => 'required|string',
            'no_telp' => 'required|string',
            
            'nim' => 'required|string|unique:mahasiswas',
            'jurusan' => 'required|string',
            'fakultas' => 'required|string',
            'angkatan' => 'required|numeric',
            'jenis_kelamin' => 'required|in:L,P',
            'tanggal_lahir' => 'required|date',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        try {
            // Begin transaction
            DB::beginTransaction();

            // Create user
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'alamat' => $request->alamat,
                'no_telp' => $request->no_telp,
                'role' => 'mahasiswa', // Set role as mahasiswa
            ]);

            // Handle foto upload
            $fotoPath = null;
            if ($request->hasFile('foto')) {
                $foto = $request->file('foto');
                $fotoPath = $foto->store('mahasiswa-photos', 'public');
            }

            // Create mahasiswa
            $mahasiswa = Mahasiswa::create([
                'user_id' => $user->id,
                'nim' => $request->nim,
                'jurusan' => $request->jurusan,
                'fakultas' => $request->fakultas,
                'angkatan' => $request->angkatan,
                'jenis_kelamin' => $request->jenis_kelamin,
                'tanggal_lahir' => $request->tanggal_lahir,
                'foto' => $fotoPath
            ]);

            // Commit transaction
            DB::commit();

            // Optional: Auto login after registration
            // auth()->login($user);

            return redirect()->route('login')->with('success', 'Registration successful! Please login.');

        } catch (\Exception $e) {
            // Rollback transaction on error
            DB::rollBack();
            
            return redirect()->back()
                ->withInput()
                ->withErrors(['error' => 'Registration failed. Please try again.']);
        }
    }
}
