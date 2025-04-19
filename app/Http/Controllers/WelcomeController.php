<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Buku;
use App\Models\Kategori;

class WelcomeController extends Controller
{
    public function index()
    {
        $buku_terbaru = Buku::latest()->take(6)->get();
        $kategoris = Kategori::all();
        
        return view('welcome', compact('buku_terbaru', 'kategoris'));
    }
    
    public function allCategories()
    {
        $kategoris = Kategori::withCount('bukus')->get();
        
        return view('categories', compact('kategoris'));
    }
    
    public function allBooks()
    {
        $bukus = Buku::with('kategoris')->latest()->paginate(12);
        $kategoris = Kategori::all();
        
        return view('books', compact('bukus', 'kategoris'));
    }
    
    public function booksByCategory($id)
    {
        $kategori = Kategori::findOrFail($id);
        $bukus = $kategori->bukus()->latest()->paginate(12);
        $kategoris = Kategori::all();
        
        return view('books', compact('bukus', 'kategoris', 'kategori'));
    }
    public function about()
    {
        return view('about');
    }   
    public function contact()
    {
        return view('contact');
    }   
}