<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriWisata extends Model
{
    protected $table = 'kategori_wisata';
    protected $primaryKey = 'id_kategori';
    protected $fillable = ['nama_kategori'];

    public function tempatWisata()
    {
        return $this->belongsToMany(TempatWisata::class, 'tempat_wisata_kategori', 'id_kategori', 'id_wisata');
    }
}
