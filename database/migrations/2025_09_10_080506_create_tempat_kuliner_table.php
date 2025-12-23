<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('tempat_kuliner', function (Blueprint $table) {
            $table->id('id_kuliner');

            // -----------------------------
            // 1. IDENTITAS USAHA
            // -----------------------------
            $table->string('nama_sentra');
            $table->integer('tahun_berdiri');
            $table->string('nama_pemilik');
            $table->string('kepemilikan');
            $table->text('alamat_lengkap');
            $table->string('telepon')->nullable();
            $table->string('email')->nullable();
            $table->string('no_nib')->nullable();
            $table->json('sertifikat_lain')->nullable();
            $table->integer('jumlah_pegawai');
            $table->integer('jumlah_kursi');
            $table->integer('jumlah_gerai');
            $table->integer('jumlah_pelanggan_per_hari');
            $table->json('profil_pelanggan');
            $table->boolean('pajak_retribusi')->default(true);
            $table->json('metode_pembayaran');

            // -----------------------------
            // 2. KATEGORI & MENU
            // -----------------------------
            $table->string('menu_unggulan');
            $table->string('bahan_baku_utama');
            $table->string('sumber_bahan_baku');
            $table->json('menu_bersifat');

            // -----------------------------
            // 3. TEMPAT & FASILITAS
            // -----------------------------
            $table->string('bentuk_fisik');
            $table->string('status_bangunan');
            $table->json('fasilitas_pendukung');

            // -----------------------------
            // 4. PRAKTIK K3 & SANITASI
            // -----------------------------
            $table->boolean('pelatihan_k3')->default(true);
            $table->integer('jumlah_penjamah_makanan');
            $table->json('apd_penjamah_makanan');
            $table->boolean('prosedur_sanitasi_alat')->default(true);
            $table->string('frekuensi_sanitasi_alat');
            $table->boolean('prosedur_sanitasi_bahan')->default(true);
            $table->string('frekuensi_sanitasi_bahan');
            $table->string('penyimpanan_mentah');
            $table->string('penyimpanan_matang');
            $table->boolean('fifo_fefo')->default(true);
            $table->string('limbah_dapur');
            $table->string('ventilasi_dapur');
            $table->string('dapur');
            $table->string('sumber_air_cuci');
            $table->string('sumber_air_masak');
            $table->string('sumber_air_minum');

            // -----------------------------
            // 5. KOORDINAT LOKASI
            // -----------------------------
            $table->decimal('latitude', 10, 6);
            $table->decimal('longitude', 10, 6);

            $table->boolean('status')->default(true);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('tempat_kuliner');
    }
};
