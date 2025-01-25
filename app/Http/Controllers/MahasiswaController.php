<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class MahasiswaController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if (!$user || !$user->mahasiswa) {
            return redirect()->route('login')->withErrors('Mahasiswa profile not found.');
        }

        return view('mahasiswa.dashboard', compact('user'));
    }

    public function profile()
    {
        $user = Auth::user();
        $mahasiswa = Mahasiswa::where('user_id', $user->id)->first();
        
        return view('mahasiswa.profile', compact('user', 'mahasiswa'));
    }

    public function edit()
    {
        $user = Auth::user();
        $mahasiswa = Mahasiswa::where('user_id', $user->id)->first();
        
        return view('mahasiswa.edit', compact('user', 'mahasiswa'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . Auth::id(),
            'alamat' => 'nullable|string|max:255',
            'no_telp' => 'nullable|string|max:15',
            'jurusan' => 'required|string|max:255',
            'fakultas' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:L,P',
            'tanggal_lahir' => 'required|date',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        // Update user data
        $user = Auth::user();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->alamat = $request->alamat;
        $user->no_telp = $request->no_telp;
        
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }
        
        $user->save();

        // Update mahasiswa data
        $mahasiswa = Mahasiswa::where('user_id', $user->id)->first();
        $mahasiswa->jurusan = $request->jurusan;
        $mahasiswa->fakultas = $request->fakultas;
        $mahasiswa->jenis_kelamin = $request->jenis_kelamin;
        $mahasiswa->tanggal_lahir = $request->tanggal_lahir;

        // Handle foto upload
        if ($request->hasFile('foto')) {
            // Delete old photo if exists
            if ($mahasiswa->foto) {
                Storage::delete('public/foto_mahasiswa/' . $mahasiswa->foto);
            }
            
            $foto = $request->file('foto');
            $fotoName = time() . '_' . $foto->getClientOriginalName();
            $foto->storeAs('public/foto_mahasiswa', $fotoName);
            $mahasiswa->foto = $fotoName;
        }

        $mahasiswa->save();

        return redirect()->route('mahasiswa.index')
            ->with('success', 'Profile berhasil diperbarui!');
    }
}

