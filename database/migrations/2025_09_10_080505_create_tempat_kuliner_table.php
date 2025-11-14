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
            $table->string('nama_sentra')->nullable();
            $table->integer('tahun_berdiri')->nullable(); // integer lebih fleksibel
            $table->string('nama_pemilik')->nullable();
            $table->string('kepemilikan')->nullable(); // dropdown (Pribadi/Keluarga/Komunitas/Waralaba)
            $table->text('alamat_lengkap')->nullable();
            $table->string('telepon')->nullable();
            $table->string('email')->nullable();
            $table->string('no_nib')->nullable();
            $table->json('sertifikat_lain')->nullable(); // checkbox (PIRT, BPOM, Halal, dll)
            $table->integer('jumlah_pegawai')->nullable();
            $table->integer('jumlah_penjamah_makanan')->nullable();
            $table->integer('jumlah_kursi')->nullable();
            $table->integer('jumlah_gerai')->nullable();
            $table->integer('jumlah_pelanggan_per_hari')->nullable();
            $table->json('profil_pelanggan')->nullable(); // checkbox (Lokal, Wisatawan, Pelajar, Pekerja)
            $table->boolean('pajak_retribusi')->default(false);
            $table->json('metode_pembayaran')->nullable(); // checkbox (Tunai, QRIS, Transfer, dll)

            // -----------------------------
            // 2. KATEGORI & MENU
            // -----------------------------
            $table->string('kategori')->nullable(); // dropdown + textbox "lainnya"
            $table->string('menu_unggulan')->nullable();
            $table->string('bahan_baku_utama')->nullable();
            $table->string('sumber_bahan_baku')->nullable(); // dropdown (Lokal, Campuran, Impor)
            $table->json('menu_bersifat')->nullable(); 

            // -----------------------------
            // 3. TEMPAT & FASILITAS
            // -----------------------------
            $table->string('bentuk_fisik')->nullable(); // dropdown (Restoran, Warung, Kafe, dll)
            $table->string('status_bangunan')->nullable(); // dropdown (Milik sendiri, Sewa)
            $table->json('fasilitas_pendukung')->nullable(); // checkbox (Toilet, Wastafel, Parkir, dll)
            $table->string('dapur')->nullable(); // dropdown (Terpisah, Tidak Terpisah, Tidak Ada)

            // -----------------------------
            // 4. PRAKTIK K3 & SANITASI
            // -----------------------------
            $table->boolean('pelatihan_k3')->default(false);
            $table->json('apd_penjamah_makanan')->nullable(); // checkbox (Masker, Hairnet, Celemek, Sarung tangan)
            $table->boolean('prosedur_sanitasi_alat')->default(false);
            $table->string('frekuensi_sanitasi_alat')->nullable();
            $table->boolean('prosedur_sanitasi_bahan')->default(false);
            $table->string('frekuensi_sanitasi_bahan')->nullable();
            $table->string('penyimpanan_mentah')->nullable(); // dropdown (Dengan pendingin, Tanpa pendingin, Terpisah, Tidak terpisah)
            $table->string('penyimpanan_matang')->nullable(); // dropdown (Dengan pendingin, Tanpa pendingin, Terpisah, Tidak terpisah)
            $table->boolean('fifo_fefo')->default(false);
            $table->string('limbah_dapur')->nullable(); // dropdown (Dipisah, Tidak dipisah)
            $table->string('ventilasi_dapur')->nullable(); // dropdown (Alami, Buatan)
            $table->string('sumber_air_cuci')->nullable(); // dropdown (PDAM, Sumur, Air Isi Ulang)
            $table->string('sumber_air_masak')->nullable();
            $table->string('sumber_air_minum')->nullable();

            // -----------------------------
            // 5. KOORDINAT LOKASI
            // -----------------------------
            $table->decimal('longitude', 10, 6)->nullable();
            $table->decimal('latitude', 10, 6)->nullable();

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('tempat_kuliner');
    }
};
