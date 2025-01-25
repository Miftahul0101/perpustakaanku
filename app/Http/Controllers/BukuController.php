<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BukuController extends Controller
{

    /**
     * Display a listing of books
     */
    public function index()
    {
        $books = Buku::latest()->paginate(10);
        return view('buku.index', compact('books'));
    }

    /**
     * Show form for creating a new book
     */
    public function create()
    {
        return view('buku.create');
    }

    /**
     * Store a newly created book
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|max:255',
            'penulis' => 'required|max:255',
            'penerbit' => 'nullable|max:255',
            'tahun_terbit' => 'nullable|digits:4|integer|min:1900|max:'.(date('Y')+1),
            'isbn' => 'nullable|max:20|unique:buku,isbn',
            'stok' => 'required|integer|min:0',
            'qr_code' => 'nullable|string'
        ]);

        Buku::create($validated);

        return redirect()->route('buku.index')
            ->with('success', 'Buku berhasil ditambahkan.');
    }

    /**
     * Show a specific book
     */
    public function show(Buku $buku)
    {
        return view('buku.show', compact('buku'));
    }

    /**
     * Show form for editing a book
     */
    public function edit(Buku $buku)
    {
        return view('buku.edit', compact('buku'));
    }

    /**
     * Update the specified book
     */
    public function update(Request $request, Buku $buku)
    {
        $validated = $request->validate([
            'judul' => 'required|max:255',
            'penulis' => 'required|max:255',
            'penerbit' => 'nullable|max:255',
            'tahun_terbit' => 'nullable|digits:4|integer|min:1900|max:'.(date('Y')+1),
            'isbn' => 'nullable|max:20|unique:buku,isbn,'.$buku->id,
            'stok' => 'required|integer|min:0',
            'qr_code' => 'nullable|string'
        ]);

        $buku->update($validated);

        return redirect()->route('buku.index')
            ->with('success', 'Buku berhasil diperbarui.');
    }

    /**
     * Remove the specified book
     */
    public function destroy(Buku $buku)
    {
        $buku->delete();

        return redirect()->route('buku.index')
            ->with('success', 'Buku berhasil dihapus.');
    }
}