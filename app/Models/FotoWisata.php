<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class FotoWisata extends Model
{
    use HasFactory;

    protected $table = 'foto_wisata';
    protected $primaryKey = 'id_foto';
    protected $fillable = ['id_wisata', 'path_foto'];

    // Agar 'url_foto' selalu muncul di JSON
    protected $appends = ['url_foto'];

    public function wisata()
    {
        return $this->belongsTo(TempatWisata::class, 'id_wisata');
    }

    /**
     * Accessor untuk URL foto lengkap
     */
    public function getUrlFotoAttribute()
    {
        // Cek apakah sudah URL lengkap
        if (filter_var($this->path_foto, FILTER_VALIDATE_URL)) {
            return $this->path_foto;
        }

        // Cek apakah file ada
        if (Storage::disk('public')->exists($this->path_foto)) {
            return asset('storage/' . $this->path_foto);
        }

        // Fallback placeholder
        return asset('images/placeholder-wisata.jpg');
    }

    // ✅ Tetap pertahankan accessor lama untuk backward compatibility
    public function getUrlAttribute()
    {
        return $this->url_foto;
    }
}
