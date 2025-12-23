<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FotoKuliner extends Model
{
    use HasFactory;
    protected $table = 'foto_kuliner';
    protected $fillable = ['id_kuliner','path_foto'];

    public function kuliner()
    {
        return $this->belongsTo(TempatKuliner::class, 'id_kuliner');
    }
}
