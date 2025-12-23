<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FotoWisata extends Model
{
    use HasFactory;

    protected $table = 'foto_wisata';
    protected $fillable = ['id_wisata', 'path_foto'];

    public function wisata()
    {
        return $this->belongsTo(TempatWisata::class, 'id_wisata');
    }
}
