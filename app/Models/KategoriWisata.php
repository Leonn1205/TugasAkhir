<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriWisata extends Model
{
    use HasFactory;
    protected $table = 'kategori_wisata';
    protected $primaryKey = 'id_kategori';
    protected $fillable = ['nama_kategori', 'status'];

    protected $casts = ['status' => 'boolean'];

    public function scopeAktif($query)
    {
        return $query->where('status', true);
    }

    public function tempatWisata()
    {
        return $this->belongsToMany(TempatWisata::class, 'tempat_wisata_kategori', 'id_kategori', 'id_wisata');
    }
}
