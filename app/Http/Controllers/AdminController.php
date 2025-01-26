<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mahasiswa;
use App\Models\Buku;

class AdminController extends Controller
{
    public function index()
{
    $totalMahasiswa = Mahasiswa::count();
    $totalBuku = Buku::count();
    $totalJurusan = Mahasiswa::distinct('jurusan')->count('jurusan');
    $mahasiswaTerbaru = Mahasiswa::with('user')->latest()->take(5)->get();

    return view('admin.dashboard', compact(
        'totalMahasiswa', 
        'totalBuku', 
        'totalJurusan', 
        'mahasiswaTerbaru'
    ));
}
}
