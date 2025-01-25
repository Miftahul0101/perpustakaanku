<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BukuKategori extends Model
{
    use HasFactory;

    protected $table = 'buku_kategoris';
    
    protected $fillable = ['buku_id', 'kategori_id'];

    /**
     * Get the book that owns the category relation.
     */
    public function buku()
    {
        return $this->belongsTo(Buku::class);
    }

    /**
     * Get the category that owns the book relation.
     */
    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }
}