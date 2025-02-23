<?php
namespace App\Http\Controllers;

use App\Models\Buku;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\Storage;

class BukuController extends Controller
{
    

    public function index()
    {
        $books = Buku::all();
        return view('buku.index', compact('books'));
    }

    public function create()
    {
        return view('buku.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|max:255',
            'penulis' => 'required|max:255',
            'penerbit' => 'nullable|max:255',
            'tahun_terbit' => 'nullable|digits:4',
            'isbn' => 'nullable|unique:buku,isbn|max:20',
            'stok' => 'required|integer|min:0',
            'sinopsis' => 'nullable',
            'foto' => 'nullable|image|max:2048'
        ]);
    
        // Handle file upload if foto is provided
        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('buku-foto', 'public');
            $validated['foto'] = $fotoPath;
        }
    
        try {
            // Create new book record
            $buku = Buku::create($validated);
    
            return redirect()
                ->route('buku.index')
                ->with('success', 'Buku berhasil ditambahkan');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Gagal menambahkan buku. ' . $e->getMessage());
        }
    }

    public function scanQR($id)
    {
        $buku = Buku::findOrFail($id);
        if ($buku->stok <= 0) {
            return redirect()->back()->with('error', 'Buku tidak tersedia');
        }
        return redirect()->route('peminjaman.create', ['buku_id' => $buku->id]);
    }
}