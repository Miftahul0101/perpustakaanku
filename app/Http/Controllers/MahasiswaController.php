<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\DendaPayment;
use App\Models\Peminjaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class MahasiswaController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if (!$user || !$user->mahasiswa) {
            return redirect()->route('login')->withErrors('Mahasiswa profile not found.');
        }

        return view('mahasiswa.dashboard', compact('user'));
    }

    public function profile()
    {
        $user = Auth::user();
        $mahasiswa = Mahasiswa::where('user_id', $user->id)->first();
        
        return view('mahasiswa.profile', compact('user', 'mahasiswa'));
    }

    public function edit()
    {
        $mahasiswa = auth()->user()->mahasiswa;
        return view('mahasiswa.edit', compact('mahasiswa'));
    }
    
    public function update(Request $request)
    {
        $user = auth()->user();
        $mahasiswa = $user->mahasiswa;
    
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'alamat' => 'required|string',
            'no_telp' => 'required|string',
            'jurusan' => 'required|string',
            'fakultas' => 'required|string',
            'angkatan' => 'required|integer',
            'foto' => 'image|mimes:jpeg,png,jpg|max:2048'
        ]);
    
        DB::beginTransaction();
        try {
            // Update user data
            $user->update([
                'name' => $validatedData['name'],
                'email' => $validatedData['email'],
                'alamat' => $validatedData['alamat'],
                'no_telp' => $validatedData['no_telp']
            ]);
    
            // Update mahasiswa data
            $mahasiswaData = [
                'jurusan' => $validatedData['jurusan'],
                'fakultas' => $validatedData['fakultas'],
                'angkatan' => $validatedData['angkatan']
            ];
    
            // Handle foto upload
            if ($request->hasFile('foto')) {
                // Delete old photo if exists
                if ($mahasiswa->foto) {
                    Storage::disk('public')->delete($mahasiswa->foto);
                }
                
                $fotoPath = $request->file('foto')->store('mahasiswa_photos', 'public');
                $mahasiswaData['foto'] = $fotoPath;
            }
    
            $mahasiswa->update($mahasiswaData);
    
            DB::commit();
    
            return redirect()->route('mahasiswa.index')
                ->with('success', 'Profil berhasil diperbarui');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['msg' => 'Gagal memperbarui profil: ' . $e->getMessage()]);
        }
    }

    public function destroy(Mahasiswa $mahasiswa)
    {
        $mahasiswa->delete();
        return redirect()->route('mahasiswa.index')
            ->with('success', 'mahasiswa berhasil dihapus');
    }
    public function borrowingHistory()
{
    $user = Auth::user();
    $peminjaman = Peminjaman::with(['buku'])
        ->where('user_id', $user->id)
        ->orderBy('created_at', 'desc')
        ->get()
        ->map(function ($pinjam) {
            $dueDate = \Carbon\Carbon::parse($pinjam->tanggal_kembali);
            $now = \Carbon\Carbon::now();
            
            $pinjam->is_overdue = false;
            $pinjam->days_overdue = 0;
            
            if ($pinjam->status === 'dipinjam' && $now->gt($dueDate)) {
                $pinjam->is_overdue = true;
                $pinjam->days_overdue = $now->diffInDays($dueDate);
                $pinjam->estimated_denda = $pinjam->days_overdue * 1000; // Rp 1000 per hari
            }
            
            return $pinjam;
        });

    $totalDenda = DendaPayment::where('user_id', $user->id)
        ->where('payment_status', 'unpaid')
        ->sum('amount');

                // Calculate current denda for active loans
        foreach ($peminjaman as $pinjam) {
                    if ($pinjam->status === 'dipinjam' && now() > $pinjam->tanggal_kembali) {
                        $days = now()->diffInDays($pinjam->tanggal_kembali);
                        $pinjam->current_denda = $days * 1000; // Rp 1000 per day
                    } else {
                        $pinjam->current_denda = 0;
                    }
                }
                
    return view('mahasiswa.borrowing-history', compact('peminjaman', 'totalDenda'));
}
}

