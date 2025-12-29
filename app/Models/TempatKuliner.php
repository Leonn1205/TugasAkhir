<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TempatKuliner extends Model
{
    use HasFactory;

    protected $table = 'tempat_kuliner';
    protected $primaryKey = 'id_kuliner';
    protected $fillable = [
        // 1. Identitas Usaha
        'nama_sentra',
        'tahun_berdiri',
        'nama_pemilik',
        'kepemilikan',
        'alamat_lengkap',
        'telepon',
        'email',
        'no_nib',
        'sertifikat_lain',
        'jumlah_pegawai',
        'jumlah_kursi',
        'jumlah_gerai',
        'jumlah_pelanggan_per_hari',
        'profil_pelanggan',
        'pajak_retribusi',
        'metode_pembayaran',

        // 2. Kategori & Menu
        'menu_unggulan',
        'bahan_baku_utama',
        'sumber_bahan_baku',
        'menu_bersifat',

        // 3. Tempat & Fasilitas
        'bentuk_fisik',
        'status_bangunan',
        'fasilitas_pendukung',

        // 4. Praktik K3 & Sanitasi
        'pelatihan_k3',
        'apd_penjamah_makanan',
        'jumlah_penjamah_makanan',
        'prosedur_sanitasi_alat',
        'frekuensi_sanitasi_alat',
        'prosedur_sanitasi_bahan',
        'frekuensi_sanitasi_bahan',
        'penyimpanan_mentah',
        'penyimpanan_matang',
        'fifo_fefo',
        'limbah_dapur',
        'ventilasi_dapur',
        'dapur',
        'sumber_air_cuci',
        'sumber_air_masak',
        'sumber_air_minum',

        // 5. Koordinat
        'longitude',
        'latitude',

        'status',
    ];

    protected $casts = [
        'sertifikat_lain' => 'array',
        'profil_pelanggan' => 'array',
        'metode_pembayaran' => 'array',
        'menu_bersifat' => 'array',
        'fasilitas_pendukung' => 'array',
        'apd_penjamah_makanan' => 'array',

        'pajak_retribusi' => 'boolean',
        'pelatihan_k3' => 'boolean',
        'prosedur_sanitasi_alat' => 'boolean',
        'prosedur_sanitasi_bahan' => 'boolean',
        'fifo_fefo' => 'boolean',

        'longitude' => 'float',
        'latitude' => 'float',

        'status' => 'boolean',
    ];

    // ============================================================================
    // RELASI
    // ============================================================================

    public function foto()
    {
        return $this->hasMany(FotoKuliner::class, 'id_kuliner')
            ->orderBy('id_foto_kuliner', 'asc');
    }

    public function jamOperasionalUser()
    {
        return $this->hasMany(JamOperasionalKuliner::class, 'id_kuliner')
            ->where('libur', false);
    }

    public function jamOperasionalAdmin()
    {
        return $this->hasMany(JamOperasionalKuliner::class, 'id_kuliner');
    }

    /**
     * Relasi kategori (SEMUA - untuk admin management)
     */
    public function kategori()
    {
        return $this->belongsToMany(
            KategoriKuliner::class,
            'tempat_kuliner_kategori',
            'id_kuliner',
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
            KategoriKuliner::class,
            'tempat_kuliner_kategori',
            'id_kuliner',
            'id_kategori'
        )
            ->where('kategori_kuliner.status', true)
            ->orderBy('kategori_kuliner.nama_kategori', 'asc');
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
            $q->whereIn('id_kategori', $kategoriIds);
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
                'is_busy' => false,
                'message' => 'Tidak ada informasi jam operasional'
            ];
        }

        if ($jadwal->libur) {
            return [
                'is_open' => false,
                'status' => 'Libur',
                'is_busy' => false,
                'message' => 'Hari ini libur'
            ];
        }

        $isOpen = $jadwal->isOpenNow();
        $isBusy = $jadwal->isBusyHour();

        return [
            'is_open' => $isOpen,
            'status' => $isOpen ? 'Buka' : 'Tutup',
            'is_busy' => $isBusy,
            'busy_status' => $isBusy ? 'Jam Sibuk' : 'Normal',
            'jam_buka' => $jadwal->jam_buka->format('H:i'),
            'jam_tutup' => $jadwal->jam_tutup->format('H:i'),
            'jam_sibuk' => ($jadwal->jam_sibuk_mulai && $jadwal->jam_sibuk_selesai) ? [
                'mulai' => $jadwal->jam_sibuk_mulai->format('H:i'),
                'selesai' => $jadwal->jam_sibuk_selesai->format('H:i')
            ] : null
        ];
    }
}
