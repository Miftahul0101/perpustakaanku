<?php

namespace App\Http\Controllers;

use App\Models\BukuKategori;
use Illuminate\Http\Request;

class BukuKategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bukuKategoris = BukuKategori::with(['buku', 'kategori'])->get();
        return view('buku-kategoris.index', compact('bukuKategoris'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('buku-kategoris.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'buku_id' => 'required|exists:buku,id',
            'kategori_id' => 'required|exists:kategoris,id',
        ]);

        BukuKategori::create($request->all());

        return redirect()->route('buku-kategoris.index')
            ->with('success', 'Relasi buku dan kategori berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BukuKategori  $bukuKategori
     * @return \Illuminate\Http\Response
     */
    public function show(BukuKategori $bukuKategori)
    {
        return view('buku-kategoris.show', compact('bukuKategori'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BukuKategori  $bukuKategori
     * @return \Illuminate\Http\Response
     */
    public function edit(BukuKategori $bukuKategori)
    {
        return view('buku-kategoris.edit', compact('bukuKategori'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BukuKategori  $bukuKategori
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BukuKategori $bukuKategori)
    {
        $request->validate([
            'buku_id' => 'required|exists:buku,id',
            'kategori_id' => 'required|exists:kategoris,id',
        ]);

        $bukuKategori->update($request->all());

        return redirect()->route('buku-kategoris.index')
            ->with('success', 'Relasi buku dan kategori berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BukuKategori  $bukuKategori
     * @return \Illuminate\Http\Response
     */
    public function destroy(BukuKategori $bukuKategori)
    {
        $bukuKategori->delete();

        return redirect()->route('buku-kategoris.index')
            ->with('success', 'Relasi buku dan kategori berhasil dihapus.');
    }
}