<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;

    protected $table = 'kategoris';
    
    protected $fillable = ['nama'];

    /**
     * Get the books that belong to the category.
     */
    public function bukus()
    {
        return $this->belongsToMany(Buku::class, 'buku_kategoris', 'kategori_id', 'buku_id');
    }
}