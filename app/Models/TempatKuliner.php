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

    public function scopeAktif($query)
    {
        return $query->where('status', true);
    }

    public function foto()
    {
        return $this->hasMany(FotoKuliner::class, 'id_kuliner')->orderBy('id_foto', 'asc');
    }

    public function jamOperasionalUser()
    {
        return $this->hasMany(JamOperasionalKuliner::class, 'id_kuliner')->where('libur', false);
    }

    public function jamOperasionalAdmin()
    {
        return $this->hasMany(JamOperasionalKuliner::class, 'id_kuliner');
    }

    public function kategori()
    {
        return $this->belongsToMany(KategoriKuliner::class, 'tempat_kuliner_kategori', 'id_kuliner', 'id_kategori');
    }
}
