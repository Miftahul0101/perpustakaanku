<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    protected $fillable = [
        'user_id',
        'nim',
        'jurusan',
        'fakultas',
        'angkatan',
        'jenis_kelamin',
        'tanggal_lahir',
        'foto'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}