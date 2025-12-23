<?php
// app/Models/TempatWisata.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TempatWisata extends Model
{
    protected $table = 'tempat_wisata';
    protected $primaryKey = 'id_wisata';
    protected $fillable = [
        'nama_wisata',
        'alamat_lengkap',
        'longitude',
        'latitude',
        'deskripsi',
        'sejarah',
        'narasi',
        'status'
    ];

    protected $casts = [
        'status' => 'boolean',
        'longitude' => 'float',
        'latitude' => 'float',
    ];

    public function jamOperasionalUser()
    {
        return $this->hasMany(JamOperasionalWisata::class, 'id_wisata')->where('libur', false);
    }

    public function jamOperasionalAdmin()
    {
        return $this->hasMany(JamOperasionalWisata::class, 'id_wisata');
    }

    public function foto()
    {
        return $this->hasMany(FotoWisata::class, 'id_wisata')->orderBy('id_foto', 'asc');
    }

    public function kategori()
    {
        return $this->belongsToMany(KategoriWisata::class, 'tempat_wisata_kategori', 'id_wisata', 'id_kategori');
    }

    public function scopeAktif($query)
    {
        return $query->where('status', true);
    }

}
