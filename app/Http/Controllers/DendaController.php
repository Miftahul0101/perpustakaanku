<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DendaPayment;
use App\Models\Peminjaman;
use Carbon\Carbon;

class DendaController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:petugas');
    }

    public function index()
    {
        // Get unpaid denda payments
        $dendaPayments = DendaPayment::with('user')
            ->where('payment_status', 'unpaid')
            ->get();
            
        // Get active loans with late returns
        $activeLoansDenda = Peminjaman::with(['user', 'buku'])
            ->where('status', 'dipinjam')
            ->where('tanggal_kembali', '<', now())
            ->get()
            ->map(function($pinjam) {
                $days = now()->diffInDays($pinjam->tanggal_kembali);
                $pinjam->current_denda = $days * 1000; // Rp 1000 per day
                return $pinjam;
            });
            
        return view('denda.index', compact('dendaPayments', 'activeLoansDenda'));
    }

    public function processPayment(Request $request)
    {
        $payment = DendaPayment::findOrFail($request->payment_id);
        $payment->payment_status = 'paid';
        $payment->notes = $request->notes;
        $payment->save();

        return redirect()->route('denda.index')->with('success', 'Pembayaran denda berhasil diproses');
    }
    
    public function calculateActiveDenda()
    {
        // Get summary of all active denda calculations
        $totalActiveDenda = Peminjaman::where('status', 'dipinjam')
            ->where('tanggal_kembali', '<', now())
            ->get()
            ->sum(function($pinjam) {
                $days = now()->diffInDays($pinjam->tanggal_kembali);
                return $days * 1000; // Rp 1000 per day
            });
            
        $usersDenda = Peminjaman::with('user')
            ->where('status', 'dipinjam')
            ->where('tanggal_kembali', '<', now())
            ->get()
            ->groupBy('user_id')
            ->map(function($userLoans) {
                $user = $userLoans->first()->user;
                $totalDenda = $userLoans->sum(function($loan) {
                    $days = now()->diffInDays($loan->tanggal_kembali);
                    return $days * 1000;
                });
                
                return [
                    'user' => $user,
                    'total_denda' => $totalDenda,
                    'loan_count' => $userLoans->count()
                ];
            });
            
        return view('denda.active', compact('totalActiveDenda', 'usersDenda'));
    }
}