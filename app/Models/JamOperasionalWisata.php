<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JamOperasionalWisata extends Model
{
    protected $table = 'jam_operasional_wisata';
    protected $fillable = ['id_wisata', 'hari', 'jam_buka', 'jam_tutup', 'libur'];

    protected $casts = ['libur' => 'boolean'];

    public function wisata()
    {
        return $this->belongsTo(TempatWisata::class, 'id_wisata');
    }
}
