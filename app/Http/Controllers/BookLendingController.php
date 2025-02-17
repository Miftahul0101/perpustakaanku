<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Peminjaman;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BookLendingController extends Controller
{
    public function scanQR()
    {
        return view('lending.scan-qr');
    }

    public function processQR(Request $request)
    {
        $isbn = $request->isbn;
        $book = Buku::where('isbn', $isbn)->first();

        if (!$book) {
            return response()->json(['error' => 'Buku tidak ditemukan'], 404);
        }

        if ($book->stok <= 0 || $book->status === 'dipinjam') {
            return response()->json(['error' => 'Buku tidak tersedia'], 400);
        }

        return response()->json([
            'success' => true,
            'redirect' => route('borrow.form', $book->id)
        ]);
    }

    public function showBorrowForm(Buku $book)
    {
        return view('lending.borrow-form', compact('book'));
    }

    public function processBorrow(Request $request, Buku $book)
    {
        $request->validate([
            'tanggal_kembali' => 'required|date|after:today'
        ]);

        // Check if user has ongoing borrowing
        $existingBorrow = Peminjaman::where('user_id', auth()->id())
            ->where('buku_id', $book->id)
            ->where('status', 'dipinjam')
            ->first();

        if ($existingBorrow) {
            return back()->with('error', 'Anda masih memiliki peminjaman yang aktif untuk buku ini');
        }

        // Create new borrowing record
        $peminjaman = new Peminjaman();
        $peminjaman->user_id = auth()->id();
        $peminjaman->buku_id = $book->id;
        $peminjaman->tanggal_pinjam = Carbon::now();
        $peminjaman->tanggal_kembali = $request->tanggal_kembali;
        $peminjaman->status = 'dipinjam';
        $peminjaman->save();

        // Update book stock and status
        $book->decrement('stok');
        if ($book->stok <= 0) {
            $book->status = 'dipinjam';
        }
        $book->save();

        return redirect()->route('my.borrows')->with('success', 'Buku berhasil dipinjam');
    }

    public function myBorrows()
    {
        $borrows = Peminjaman::with('buku')
            ->where('user_id', auth()->id())
            ->latest()
            ->get();

        // Calculate fines for overdue books
        foreach ($borrows as $borrow) {
            if ($borrow->status === 'dipinjam' && Carbon::now()->gt($borrow->tanggal_kembali)) {
                $daysLate = Carbon::now()->diffInDays($borrow->tanggal_kembali);
                $borrow->denda = $daysLate * 1000; // Rp 1000 per day
                $borrow->save();
            }
        }

        return view('lending.my-borrows', compact('borrows'));
    }
}