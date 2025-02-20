<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    protected $table = 'buku';
    protected $fillable = [
        'judul', 'penulis', 'penerbit', 'tahun_terbit', 'isbn',
        'status', 'stok', 'sinopsis', 'foto', 'qr_code'
    ];

    public function peminjaman()
    {
        return $this->hasMany(Peminjaman::class);
    }

    public function kategoris()
    {
        return $this->belongsToMany(Kategori::class, 'buku_kategoris', 'buku_id', 'kategori_id')
                    ->withTimestamps();
    }
    

    public function bukuKategoris()
    {
        return $this->hasMany(BukuKategori::class);
    }
}