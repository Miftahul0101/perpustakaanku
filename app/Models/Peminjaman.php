<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Peminjaman extends Model
{
    protected $table = 'peminjaman';
    
    protected $fillable = [
        'user_id',
        'buku_id',
        'tanggal_pinjam',
        'tanggal_kembali',
        'status',
        'denda'
    ];

    protected $dates = [
        'tanggal_pinjam',
        'tanggal_kembali'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function buku()
    {
        return $this->belongsTo(Buku::class);
    }

    public function isOverdue()
    {
        return Carbon::now()->gt($this->tanggal_kembali);
    }

    public function calculateDenda()
    {
        if ($this->isOverdue()) {
            $daysLate = Carbon::now()->diffInDays($this->tanggal_kembali);
            return $daysLate * 1000; // Denda 1000 per hari
        }
        return 0;
    }

    public static function getActiveLoanCount($userId)
    {
        return self::where('user_id', $userId)
            ->where('status', 'dipinjam')
            ->count();
    }
}