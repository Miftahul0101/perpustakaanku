<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'alamat',
        'no_telp',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function mahasiswa()
    {
        return $this->hasOne(Mahasiswa::class);
    }

    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    public function isPetugas()
    {
        return $this->role === 'petugas';
    }

    public function isMahasiswa()
    {
        return $this->role === 'mahasiswa';
    }
}
