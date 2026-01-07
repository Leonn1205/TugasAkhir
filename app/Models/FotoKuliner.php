<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class FotoKuliner extends Model
{
    use HasFactory;

    protected $table = 'foto_kuliner';
    protected $primaryKey = 'id_foto_kuliner';
    protected $fillable = ['id_kuliner', 'path_foto'];

    protected $appends = ['url_foto'];

    public function kuliner()
    {
        return $this->belongsTo(TempatKuliner::class, 'id_kuliner');
    }

    /**
     * Accessor untuk URL foto lengkap
     */
    public function getUrlFotoAttribute()
    {
        if (filter_var($this->path_foto, FILTER_VALIDATE_URL)) {
            return $this->path_foto;
        }

        return asset('storage/' . $this->path_foto);
    }

    // Backward compatibility
    public function getUrlAttribute()
    {
        return $this->url_foto;
    }
}
