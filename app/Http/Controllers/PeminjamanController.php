<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Buku;
use App\Models\Peminjaman;
use App\Models\DendaPayment;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PeminjamanController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:mahasiswa')->only(['create', 'store']);
        $this->middleware('role:petugas')->only(['index', 'return', 'processReturn']);
    }

// Controller: PeminjamanController.php
public function index(Request $request)
{
    $query = Peminjaman::with(['user', 'buku']);
    
    // Filter by user
    if ($request->filled('user_id')) {
        $query->where('user_id', $request->user_id);
    }
    
    // Filter by book
    if ($request->filled('buku_id')) {
        $query->where('buku_id', $request->buku_id);
    }
    
    // Filter by status
    if ($request->filled('status')) {
        $query->where('status', $request->status);
    }
    
    $peminjaman = $query->get();
    
    // Get data for dropdowns
    $users = User::orderBy('name')->get();
    $books = Buku::orderBy('judul')->get();
    $statuses = ['dipinjam', 'dikembalikan']; // Add more statuses if needed
    
    return view('peminjaman.index', compact('peminjaman', 'users', 'books', 'statuses'));
}

    public function create(Request $request)
    {
        $buku = Buku::findOrFail($request->buku_id);
        return view('peminjaman.create', compact('buku'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'buku_id' => 'required|exists:buku,id',
            'tanggal_pinjam' => 'required|date',
            'tanggal_kembali' => 'required|date|after:tanggal_pinjam'
        ]);

        $buku = Buku::findOrFail($request->buku_id);
        
        if ($buku->stok <= 0) {
            return redirect()->back()->with('error', 'Buku tidak tersedia');
        }

        $validated['user_id'] = auth()->id();
        $validated['status'] = 'dipinjam';

        // Begin transaction
        \DB::transaction(function () use ($validated, $buku) {
            Peminjaman::create($validated);
            
            $buku->stok -= 1;
            if ($buku->stok == 0) {
                $buku->status = 'dipinjam';
            }
            $buku->save();
        });

        return redirect()->route('mahasiswa.dashboard')->with('success', 'Peminjaman berhasil');
    }

    public function return()
    {
        return view('peminjaman.return');
    }

    public function processReturn(Request $request)
    {
        $peminjaman = Peminjaman::with(['user', 'buku'])
            ->where('status', 'dipinjam')
            ->findOrFail($request->peminjaman_id);

        $denda = 0;
        if (now() > $peminjaman->tanggal_kembali) {
            $days = now()->diffInDays($peminjaman->tanggal_kembali);
            $denda = $days * 1000; // Rp 1000 per hari
        }

        \DB::transaction(function () use ($peminjaman, $denda) {
            $peminjaman->status = 'dikembalikan';
            $peminjaman->denda = $denda;
            $peminjaman->save();

            $buku = $peminjaman->buku;
            $buku->stok += 1;
            if ($buku->stok > 0) {
                $buku->status = 'tersedia';
            }
            $buku->save();

            if ($denda > 0) {
                DendaPayment::create([
                    'user_id' => $peminjaman->user_id,
                    'amount' => $denda,
                    'payment_date' => now(),
                    'payment_status' => 'unpaid'
                ]);
            }
        });

        return redirect()->route('peminjaman.index')->with('success', 'Pengembalian berhasil diproses');
    }
}