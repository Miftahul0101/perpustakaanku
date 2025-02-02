<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    use HasFactory;

    protected $table = 'buku';
    
    protected $fillable = [
        'judul',
        'penulis',
        'penerbit',
        'tahun_terbit',
        'isbn',
        'status',
        'stok',
        'qr_code'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'tahun_terbit' => 'integer',
        'stok' => 'integer',
    ];

    /**
     * Get the categories for the book.
     */
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