<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Mahasiswa;
use App\Models\BukuKategori;
use App\Models\Kategori;
use Illuminate\Http\Request;

class PetugasController extends Controller
{
    public function dashboard()
    {
        $totalMahasiswa = Mahasiswa::count();
        $totalBuku = Buku::count();
        $totalKategori = Kategori::count();
        
        // Get statistics by faculty
        $mahasiswaByFakultas = Mahasiswa::select('fakultas')
            ->selectRaw('count(*) as total')
            ->groupBy('fakultas')
            ->get();

        $popularKategori = BukuKategori::with('kategori')
            ->select('kategori_id')
            ->selectRaw('count(*) as total')
            ->groupBy('kategori_id')
            ->orderBy('total', 'desc')
            ->limit(5)
            ->get();

        // Get latest registered students
        $latestMahasiswa = Mahasiswa::with('user')
            ->latest()
            ->limit(5)
            ->get();

        return view('petugas.dashboard', compact(
            'totalMahasiswa',
            'totalBuku',
            'totalKategori',
            'mahasiswaByFakultas',
            'popularKategori',
            'latestMahasiswa'
        ));
    }
}