<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TempatWisata extends Model
{
    use HasFactory;

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

    // ============================================================================
    // RELASI
    // ============================================================================

    public function jamOperasionalUser()
    {
        return $this->hasMany(JamOperasionalWisata::class, 'id_wisata')
            ->where('libur', false);
    }

    public function jamOperasionalAdmin()
    {
        return $this->hasMany(JamOperasionalWisata::class, 'id_wisata');
    }

    public function foto()
    {
        return $this->hasMany(FotoWisata::class, 'id_wisata')
            ->orderBy('id_foto', 'asc');
    }

    /**
     * Relasi kategori (SEMUA - untuk admin management)
     */
    public function kategori()
    {
        return $this->belongsToMany(
            KategoriWisata::class,
            'tempat_wisata_kategori',
            'id_wisata',
            'id_kategori'
        );
    }

    /**
     * ✅ BARU: Relasi kategori AKTIF saja (untuk display/public)
     * Digunakan di: index, show, dashboard, API
     */
    public function kategoriAktif()
    {
        return $this->belongsToMany(
            KategoriWisata::class,
            'tempat_wisata_kategori',
            'id_wisata',
            'id_kategori'
        )
            ->where('kategori_wisata.status', true)
            ->orderBy('kategori_wisata.nama_kategori', 'asc');
    }

    // ============================================================================
    // SCOPES
    // ============================================================================

    public function scopeAktif($query)
    {
        return $query->where('status', true);
    }

    public function scopeByKategori($query, $kategoriIds)
    {
        return $query->whereHas('kategori', function ($q) use ($kategoriIds) {
            $q->whereIn('id_kategori', (array) $kategoriIds);
        });
    }

    public function scopeNearby($query, $latitude, $longitude, $radiusInKm = 5)
    {
        $haversine = "(6371 * acos(cos(radians(?))
                        * cos(radians(latitude))
                        * cos(radians(longitude) - radians(?))
                        + sin(radians(?))
                        * sin(radians(latitude))))";

        return $query->select('*')
            ->selectRaw("$haversine AS distance", [$latitude, $longitude, $latitude])
            ->having('distance', '<=', $radiusInKm)
            ->orderBy('distance', 'asc');
    }

    // ============================================================================
    // HELPER METHODS
    // ============================================================================

    /**
     * Cek apakah wisata buka hari ini
     */
    public function isOpenToday()
    {
        $hari = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'][now()->dayOfWeek];

        $jadwal = $this->jamOperasionalUser()
            ->where('hari', $hari)
            ->first();

        return $jadwal ? $jadwal->isOpenNow() : false;
    }

    /**
     * Get status operasional lengkap
     */
    public function getOpenStatus()
    {
        $hari = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'][now()->dayOfWeek];

        $jadwal = $this->jamOperasionalAdmin()
            ->where('hari', $hari)
            ->first();

        if (!$jadwal) {
            return [
                'is_open' => false,
                'status' => 'Tutup',
                'message' => 'Tidak ada informasi jam operasional'
            ];
        }

        if ($jadwal->libur) {
            return [
                'is_open' => false,
                'status' => 'Libur',
                'message' => 'Hari ini libur',
                'jam_buka' => null,
                'jam_tutup' => null
            ];
        }

        $isOpen = $jadwal->isOpenNow();
        $currentTime = now()->format('H:i');

        return [
            'is_open' => $isOpen,
            'status' => $isOpen ? 'Buka' : 'Tutup',
            'jam_buka' => $jadwal->jam_buka->format('H:i'),
            'jam_tutup' => $jadwal->jam_tutup->format('H:i'),
            'message' => $isOpen
                ? "Buka hingga {$jadwal->jam_tutup->format('H:i')}"
                : ($currentTime < $jadwal->jam_buka->format('H:i')
                    ? "Buka pukul {$jadwal->jam_buka->format('H:i')}"
                    : "Sudah tutup")
        ];
    }
}
