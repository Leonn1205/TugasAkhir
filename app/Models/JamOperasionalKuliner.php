<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JamOperasionalKuliner extends Model
{
    protected $table = 'jam_operasional_kuliner';
    protected $fillable = ['id_kuliner',
    'hari',
    'jam_buka',
    'jam_tutup',
    'jam_sibuk_mulai',
    'jam_sibuk_selesai',
    'libur'
    ];

    protected $casts = ['libur' => 'boolean'];

    public function kuliner()
    {
        return $this->belongsTo(TempatKuliner::class, 'id_kuliner');
    }
}
