<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class KategoriKuliner extends Model
{
    use HasFactory;
    protected $table = 'kategori_kuliner';
    protected $primaryKey = 'id_kategori';
    protected $fillable = ['nama_kategori', 'status'];

    protected $casts = ['status' => 'boolean'];

    public function scopeAktif($query)
    {
        return $query->where('status', true);
    }

    public function tempatKuliner()
    {
        return $this->belongsToMany(TempatKuliner::class, 'tempat_kuliner_kategori', 'id_kategori', 'id_kuliner');
    }
}
