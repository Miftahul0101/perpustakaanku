<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BukuController extends Controller
{
    /**
     * Display a listing of books
     */
    public function index()
    {
        $books = Buku::latest()->paginate(10);
        return view('books.index', compact('books'));
    }

    /**
     * Show form for creating a new book
     */
    public function create()
    {
        return view('books.create');
    }

    /**
     * Store a newly created book
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'judul' => 'required|max:255',
            'pengarang' => 'required|max:255',
            'penerbit' => 'required|max:255',
            'tahun_terbit' => 'required|numeric|digits:4',
            'isbn' => 'required|unique:bukus|max:13',
            'stok' => 'required|numeric|min:0',
            'kategori_id' => 'required|exists:kategoris,id'
        ]);

        if ($validator->fails()) {
            return redirect()
                ->route('books.create')
                ->withErrors($validator)
                ->withInput();
        }

        Buku::create($request->all());

        return redirect()
            ->route('books.index')
            ->with('success', 'Buku berhasil ditambahkan');
    }

    /**
     * Display the specified book
     */
    public function show(Buku $book)
    {
        return view('books.show', compact('book'));
    }

    /**
     * Show form for editing the specified book
     */
    public function edit(Buku $book)
    {
        return view('books.edit', compact('book'));
    }

    /**
     * Update the specified book
     */
    public function update(Request $request, Buku $book)
    {
        $validator = Validator::make($request->all(), [
            'judul' => 'required|max:255',
            'pengarang' => 'required|max:255',
            'penerbit' => 'required|max:255',
            'tahun_terbit' => 'required|numeric|digits:4',
            'isbn' => 'required|max:13|unique:bukus,isbn,' . $book->id,
            'stok' => 'required|numeric|min:0',
            'kategori_id' => 'required|exists:kategoris,id'
        ]);

        if ($validator->fails()) {
            return redirect()
                ->route('books.edit', $book)
                ->withErrors($validator)
                ->withInput();
        }

        $book->update($request->all());

        return redirect()
            ->route('books.index')
            ->with('success', 'Buku berhasil diperbarui');
    }

    /**
     * Remove the specified book
     */
    public function destroy(Buku $book)
    {
        $book->delete();

        return redirect()
            ->route('books.index')
            ->with('success', 'Buku berhasil dihapus');
    }
}