<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JamOperasionalKuliner extends Model
{
    use HasFactory;

    protected $table = 'jam_operasional_kuliner';
    protected $primaryKey = 'id_jam_operasional';
    protected $fillable = [
        'id_kuliner',
        'hari',
        'jam_buka',
        'jam_tutup',
        'jam_sibuk_mulai',
        'jam_sibuk_selesai',
        'libur'
    ];

    protected $casts = [
        'libur' => 'boolean',
        'jam_buka' => 'datetime:H:i',
        'jam_tutup' => 'datetime:H:i',
        'jam_sibuk_mulai' => 'datetime:H:i',
        'jam_sibuk_selesai' => 'datetime:H:i',
    ];

    public function kuliner()
    {
        return $this->belongsTo(TempatKuliner::class, 'id_kuliner');
    }

    /**
     * Cek apakah tempat buka sekarang
     */
    public function isOpenNow()
    {
        if ($this->libur) {
            return false;
        }

        $currentTime = now()->format('H:i');
        return $currentTime >= $this->jam_buka->format('H:i')
            && $currentTime <= $this->jam_tutup->format('H:i');
    }

    /**
     * Cek apakah sedang jam sibuk
     */
    public function isBusyHour()
    {
        if ($this->libur || !$this->jam_sibuk_mulai || !$this->jam_sibuk_selesai) {
            return false;
        }

        $currentTime = now()->format('H:i');
        return $currentTime >= $this->jam_sibuk_mulai->format('H:i')
            && $currentTime <= $this->jam_sibuk_selesai->format('H:i');
    }
}
