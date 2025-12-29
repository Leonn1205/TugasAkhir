<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JamOperasionalWisata extends Model
{
    use HasFactory;

    protected $table = 'jam_operasional_wisata';
    protected $primaryKey = 'id_jam_operasional';
    protected $fillable = ['id_wisata', 'hari', 'jam_buka', 'jam_tutup', 'libur'];

    protected $casts = [
        'libur' => 'boolean',
        'jam_buka' => 'datetime:H:i',
        'jam_tutup' => 'datetime:H:i',
    ];

    public function wisata()
    {
        return $this->belongsTo(TempatWisata::class, 'id_wisata');
    }

    /**
     * Cek apakah tempat buka sekarang (hanya cek waktu, bukan hari)
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
}
