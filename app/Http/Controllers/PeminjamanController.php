<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Peminjaman;
use Illuminate\Http\Request;
use Carbon\Carbon;

class PeminjamanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create(Request $request, Buku $buku)
    {
        // Check if book is available
        if (!$buku->isAvailable()) {
            return redirect()->back()->with('error', 'Maaf, buku tidak tersedia untuk dipinjam');
        }

        // Check if user has overdue books
        $hasOverdue = Peminjaman::where('user_id', auth()->id())
            ->where('status', 'dipinjam')
            ->where('tanggal_kembali', '<', Carbon::now())
            ->exists();

        if ($hasOverdue) {
            return redirect()->back()->with('error', 'Maaf, Anda memiliki buku yang telah melewati batas waktu peminjaman');
        }

        // Check active loans count
        $activeLoans = Peminjaman::getActiveLoanCount(auth()->id());
        if ($activeLoans >= 3) { // Maksimal 3 buku yang bisa dipinjam
            return redirect()->back()->with('error', 'Maaf, Anda telah mencapai batas maksimal peminjaman buku');
        }

        return view('peminjaman.create', compact('buku'));
    }

    public function store(Request $request, Buku $buku)
    {
        // Validate availability again
        if (!$buku->isAvailable()) {
            return redirect()->back()->with('error', 'Maaf, buku tidak tersedia untuk dipinjam');
        }

        // Set loan dates
        $tanggalPinjam = Carbon::now();
        $tanggalKembali = Carbon::now()->addDays(7);

        $peminjaman = Peminjaman::create([
            'user_id' => auth()->id(),
            'buku_id' => $buku->id,
            'tanggal_pinjam' => $tanggalPinjam,
            'tanggal_kembali' => $tanggalKembali,
            'status' => 'dipinjam'
        ]);

        // Update book stock and status
        $buku->decrement('stok');
        if ($buku->stok == 0) {
            $buku->update(['status' => 'dipinjam']);
        }

        return redirect()->route('peminjaman.show', $peminjaman)
            ->with('success', 'Buku berhasil dipinjam. Harap kembalikan sebelum ' . $tanggalKembali->format('d-m-Y'));
    }

    public function return(Peminjaman $peminjaman)
    {
        $this->middleware('role:petugas');

        $denda = 0;
        if ($peminjaman->isOverdue()) {
            $denda = $peminjaman->calculateDenda();
        }

        $peminjaman->update([
            'status' => 'dikembalikan',
            'denda' => $denda
        ]);
        
        // Update book stock and status
        $buku = $peminjaman->buku;
        $buku->increment('stok');
        if ($buku->stok > 0) {
            $buku->update(['status' => 'tersedia']);
        }

        $message = 'Buku berhasil dikembalikan.';
        if ($denda > 0) {
            $message .= ' Denda keterlambatan: Rp ' . number_format($denda, 0, ',', '.');
        }

        return redirect()->back()->with('success', $message);
    }

    public function index()
    {
        $peminjaman = Peminjaman::with(['buku', 'user'])
            ->where('user_id', auth()->id())
            ->orderBy('created_at', 'desc')
            ->get();

        return view('peminjaman.index', compact('peminjaman'));
    }

    public function showOverdue()
    {
        $this->middleware('role:petugas');

        $overduePeminjaman = Peminjaman::with(['buku', 'user'])
            ->where('status', 'dipinjam')
            ->where('tanggal_kembali', '<', Carbon::now())
            ->get();

        return view('peminjaman.overdue', compact('overduePeminjaman'));
    }
}