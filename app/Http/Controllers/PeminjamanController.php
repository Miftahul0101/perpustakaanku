<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Peminjaman;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PeminjamanController extends Controller
{
    public function index()
    {
        return view('peminjaman.scan');
    }

    public function getBuku($id)
    {
        $buku = Buku::findOrFail($id);
        
        if (!$buku->isAvailable()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Buku sedang tidak tersedia (stok habis)'
            ], 400);
        }

        return response()->json([
            'status' => 'success',
            'buku' => $buku
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'buku_id' => 'required|exists:buku,id',
            'tanggal_kembali' => 'required|date|after:today'
        ]);

        try {
            DB::beginTransaction();

            // Get book and check stock
            $buku = Buku::lockForUpdate()->findOrFail($request->buku_id);
            
            if ($buku->stok <= 0) {
                DB::rollBack();
                return redirect()->back()->with('error', 'Buku sedang tidak tersedia (stok habis)');
            }

            // Reduce stock
            $buku->stok -= 1;
            
            // Update status if stock becomes 0
            if ($buku->stok == 0) {
                $buku->status = 'dipinjam';
            }
            
            $buku->save();

            // Create peminjaman record
            $peminjaman = new Peminjaman();
            $peminjaman->user_id = auth()->id();
            $peminjaman->buku_id = $request->buku_id;
            $peminjaman->tanggal_pinjam = Carbon::now();
            $peminjaman->tanggal_kembali = $request->tanggal_kembali;
            $peminjaman->status = 'dipinjam';
            $peminjaman->save();

            DB::commit();

            return redirect()->route('dashboard')->with('success', 'Peminjaman berhasil');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Terjadi kesalahan saat memproses peminjaman');
        }
    }

    public function return($id)
    {
        $peminjaman = Peminjaman::with(['user', 'buku'])->findOrFail($id);
        
        // Calculate late fee if any
        $dueDate = Carbon::parse($peminjaman->tanggal_kembali);
        $today = Carbon::now();
        
        if ($today->gt($dueDate)) {
            $daysLate = $today->diffInDays($dueDate);
            $peminjaman->denda = $daysLate * 1000; // Rp 1000 per day
        }

        return view('peminjaman.return', compact('peminjaman'));
    }

    public function confirmReturn(Request $request, $id)
    {
        try {
            DB::beginTransaction();

            $peminjaman = Peminjaman::findOrFail($id);
            $buku = Buku::lockForUpdate()->findOrFail($peminjaman->buku_id);

            // Update peminjaman status
            $peminjaman->status = 'dikembalikan';
            $peminjaman->petugas_notes = $request->petugas_notes;
            $peminjaman->tanggal_pengembalian = Carbon::now();
            $peminjaman->save();

            // Increment book stock
            $buku->stok += 1;
            
            // Update status if book was previously unavailable
            if ($buku->status === 'dipinjam') {
                $buku->status = 'tersedia';
            }
            
            $buku->save();

            DB::commit();

            return redirect()->route('dashboard')->with('success', 'Buku berhasil dikembalikan');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Terjadi kesalahan saat memproses pengembalian');
        }
    }
}