<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Kategori;
use Illuminate\Http\Request;

class BukuKategoriController extends Controller
{
    /**
     * Show the form for managing book categories.
     *
     * @param  \App\Models\Buku  $buku
     * @return \Illuminate\Http\Response
     */
    public function index(Buku $buku)
    {
        $allKategoris = Kategori::all();
        return view('buku.kategori', compact('buku', 'allKategoris'));
    }

    /**
     * Assign categories to a book.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Buku  $buku
     * @return \Illuminate\Http\Response
     */
    public function assignCategories(Request $request, Buku $buku)
    {
        $request->validate([
            'kategori_ids' => 'required|array',
            'kategori_ids.*' => 'exists:kategori,id'
        ]);

        $buku->kategoris()->sync($request->kategori_ids);
        
        return redirect()
            ->route('buku.kategori.index', $buku)
            ->with('success', 'Kategori buku berhasil diperbarui');
    }

    /**
     * Remove a category from a book.
     *
     * @param  \App\Models\Buku  $buku
     * @param  \App\Models\Kategori  $kategori
     * @return \Illuminate\Http\Response
     */
    public function removeCategory(Buku $buku, Kategori $kategori)
    {
        $buku->kategoris()->detach($kategori->id);

        return redirect()
            ->route('buku.kategori.index', $buku)
            ->with('success', 'Kategori berhasil dihapus dari buku');
    }

    /**
     * Display list of books by category.
     *
     * @param  \App\Models\Kategori  $kategori
     * @return \Illuminate\Http\Response
     */
    public function getBooksByCategory(Kategori $kategori)
    {
        $books = $kategori->bukus()
            ->with('kategoris')
            ->paginate(10);

        return view('buku.by-category', compact('books', 'kategori'));
    }

    /**
     * Show all categories for a book.
     *
     * @param  \App\Models\Buku  $buku
     * @return \Illuminate\Http\Response
     */
    public function getCategories(Buku $buku)
    {
        $buku->load('kategoris');
        return view('buku.categories', compact('buku'));
    }
}