<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class AdminMahasiswaController extends Controller
{
    /**
     * Display a listing of students
     */
    public function index()
    {
        $mahasiswa = Mahasiswa::latest()->paginate(10);
        return view('adminmahasiswa.index', compact('mahasiswa'));
    }

    /**
     * Show form for creating a new student
     */
    public function create()
    {
        return view('admin.mahasiswa.create');
    }

    /**
     * Store a newly created student
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nim' => 'required|unique:mahasiswa,nim|max:20',
            'nama' => 'required|max:100',
            'jurusan' => 'required|max:50',
            'alamat' => 'required',
            'telepon' => 'required|max:15',
            'email' => 'required|email|unique:mahasiswa,email',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        if ($validator->fails()) {
            return redirect()
                ->route('admin.mahasiswa.create')
                ->withErrors($validator)
                ->withInput();
        }

        try {
            DB::beginTransaction();

            $mahasiswa = new Mahasiswa();
            $mahasiswa->nim = $request->nim;
            $mahasiswa->nama = $request->nama;
            $mahasiswa->jurusan = $request->jurusan;
            $mahasiswa->alamat = $request->alamat;
            $mahasiswa->telepon = $request->telepon;
            $mahasiswa->email = $request->email;

            if ($request->hasFile('foto')) {
                $file = $request->file('foto');
                $filename = time() . '.' . $file->getClientOriginalExtension();
                $file->storeAs('public/mahasiswa', $filename);
                $mahasiswa->foto = $filename;
            }

            $mahasiswa->save();

            DB::commit();

            return redirect()
                ->route('admin.mahasiswa.index')
                ->with('success', 'Data mahasiswa berhasil ditambahkan');

        } catch (\Exception $e) {
            DB::rollback();
            return redirect()
                ->route('admin.mahasiswa.create')
                ->with('error', 'Terjadi kesalahan saat menyimpan data');
        }
    }

    /**
     * Display the specified student
     */
    public function show($id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);
        return view('adminmahasiswa.show', compact('mahasiswa'));
    }

    /**
     * Show form for editing student
     */
    public function edit($id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);
        return view('admin.mahasiswa.edit', compact('mahasiswa'));
    }

    /**
     * Update the specified student
     */
    public function update(Request $request, $id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'nim' => 'required|max:20|unique:mahasiswa,nim,' . $id,
            'nama' => 'required|max:100',
            'jurusan' => 'required|max:50',
            'alamat' => 'required',
            'telepon' => 'required|max:15',
            'email' => 'required|email|unique:mahasiswa,email,' . $id,
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        if ($validator->fails()) {
            return redirect()
                ->route('admin.mahasiswa.edit', $id)
                ->withErrors($validator)
                ->withInput();
        }

        try {
            DB::beginTransaction();

            $mahasiswa->nim = $request->nim;
            $mahasiswa->nama = $request->nama;
            $mahasiswa->jurusan = $request->jurusan;
            $mahasiswa->alamat = $request->alamat;
            $mahasiswa->telepon = $request->telepon;
            $mahasiswa->email = $request->email;

            $mahasiswa->save();

            DB::commit();

            return redirect()
                ->route('admin.mahasiswa.index')
                ->with('success', 'Data mahasiswa berhasil diperbarui');

        } catch (\Exception $e) {
            DB::rollback();
            return redirect()
                ->route('admin.mahasiswa.edit', $id)
                ->with('error', 'Terjadi kesalahan saat memperbarui data');
        }
    }
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index')
            ->with('success', 'User berhasil dihapus');
    }
}
