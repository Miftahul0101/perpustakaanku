<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Kategori;
use App\Models\BukuKategori;
use Illuminate\Http\Request;

class BukuKategoriController extends Controller
{
    public function index()
    {
        // Mengambil buku yang memiliki kategori
        $bukuDenganKategori = Buku::whereHas('kategoris')
            ->with(['kategoris' => function($query) {
                $query->select('kategoris.*');
            }])
            ->get();

        return view('buku-kategoris.index', compact('bukuDenganKategori'));
    }

    public function create()
{
    // Ambil semua buku dengan informasi apakah sudah memiliki kategori
    $bukus = Buku::withCount('kategoris')
        ->whereDoesntHave('kategoris') // Hanya ambil buku yang belum punya kategori
        ->get();
    
    // Ambil semua kategori
    $kategoris = Kategori::all();
    
    return view('buku-kategoris.create', compact('bukus', 'kategoris'));
}

    public function store(Request $request)
    {
        $request->validate([
            'buku_id' => 'required|exists:buku,id',
            'kategori_ids' => 'required|array',
            'kategori_ids.*' => 'exists:kategoris,id'
        ]);

        // Cek apakah kombinasi buku dan kategori sudah ada
        foreach($request->kategori_ids as $kategori_id) {
            $exists = BukuKategori::where('buku_id', $request->buku_id)
                                 ->where('kategori_id', $kategori_id)
                                 ->exists();
            
            if(!$exists) {
                BukuKategori::create([
                    'buku_id' => $request->buku_id,
                    'kategori_id' => $kategori_id
                ]);
            }
        }

        return redirect()->route('buku-kategoris.index')
            ->with('success', 'Kategori buku berhasil ditambahkan.');
    }

    public function edit(BukuKategori $bukuKategori)
    {
        $bukus = Buku::all();
        $kategoris = Kategori::all();
        
        // Ambil kategori yang sudah terpilih untuk buku ini
        $selectedKategoris = BukuKategori::where('buku_id', $bukuKategori->buku_id)
                                        ->pluck('kategori_id')
                                        ->toArray();
        
        return view('buku-kategoris.edit', compact('bukuKategori', 'bukus', 'kategoris', 'selectedKategoris'));
    }

    public function update(Request $request, BukuKategori $bukuKategori)
    {
        $request->validate([
            'buku_id' => 'required|exists:buku,id',
            'kategori_ids' => 'required|array',
            'kategori_ids.*' => 'exists:kategoris,id'
        ]);

        // Hapus kategori lama
        BukuKategori::where('buku_id', $request->buku_id)->delete();

        // Tambah kategori baru
        foreach($request->kategori_ids as $kategori_id) {
            BukuKategori::create([
                'buku_id' => $request->buku_id,
                'kategori_id' => $kategori_id
            ]);
        }

        return redirect()->route('buku-kategoris.index')
            ->with('success', 'Kategori buku berhasil diperbarui.');
    }

    public function destroy(BukuKategori $bukuKategori)
    {
        // Hapus semua kategori untuk buku ini
        BukuKategori::where('buku_id', $bukuKategori->buku_id)->delete();

        return redirect()->route('buku-kategoris.index')
            ->with('success', 'Kategori buku berhasil dihapus.');
    }
}