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
            $table->integer('tahun_berdiri'); // integer lebih fleksibel
            $table->string('nama_pemilik');
            $table->string('kepemilikan'); // dropdown (Pribadi/Keluarga/Komunitas/Waralaba)
            $table->text('alamat_lengkap');
            $table->string('telepon');
            $table->string('email');
            $table->string('no_nib');
            $table->json('sertifikat_lain'); // checkbox (PIRT, BPOM, Halal, dll)
            $table->integer('jumlah_pegawai');
            $table->integer('jumlah_penjamah_makanan');
            $table->integer('jumlah_kursi');
            $table->integer('jumlah_gerai');
            $table->integer('jumlah_pelanggan_per_hari');
            $table->json('profil_pelanggan'); // checkbox (Lokal, Wisatawan, Pelajar, Pekerja)
            $table->boolean('pajak_retribusi')->default(false);
            $table->json('metode_pembayaran'); // checkbox (Tunai, QRIS, Transfer, dll)

            // -----------------------------
            // 2. KATEGORI & MENU
            // -----------------------------
            $table->string('kategori'); // dropdown + textbox "lainnya"
            $table->string('menu_unggulan');
            $table->string('bahan_baku_utama');
            $table->string('sumber_bahan_baku'); // dropdown (Lokal, Campuran, Impor)
            $table->json('menu_bersifat');

            // -----------------------------
            // 3. TEMPAT & FASILITAS
            // -----------------------------
            $table->string('bentuk_fisik'); // dropdown (Restoran, Warung, Kafe, dll)
            $table->string('status_bangunan'); // dropdown (Milik sendiri, Sewa)
            $table->json('fasilitas_pendukung'); // checkbox (Toilet, Wastafel, Parkir, dll)
            $table->string('dapur'); // dropdown (Terpisah, Tidak Terpisah, Tidak Ada)

            // -----------------------------
            // 4. PRAKTIK K3 & SANITASI
            // -----------------------------
            $table->boolean('pelatihan_k3')->default(false);
            $table->json('apd_penjamah_makanan'); // checkbox (Masker, Hairnet, Celemek, Sarung tangan)
            $table->boolean('prosedur_sanitasi_alat')->default(false);
            $table->string('frekuensi_sanitasi_alat');
            $table->boolean('prosedur_sanitasi_bahan')->default(false);
            $table->string('frekuensi_sanitasi_bahan');
            $table->string('penyimpanan_mentah'); // dropdown (Dengan pendingin, Tanpa pendingin, Terpisah, Tidak terpisah)
            $table->string('penyimpanan_matang'); // dropdown (Dengan pendingin, Tanpa pendingin, Terpisah, Tidak terpisah)
            $table->boolean('fifo_fefo')->default(false);
            $table->string('limbah_dapur'); // dropdown (Dipisah, Tidak dipisah)
            $table->string('ventilasi_dapur'); // dropdown (Alami, Buatan)
            $table->string('sumber_air_cuci'); // dropdown (PDAM, Sumur, Air Isi Ulang)
            $table->string('sumber_air_masak');
            $table->string('sumber_air_minum');

            // -----------------------------
            // 5. KOORDINAT LOKASI
            // -----------------------------
            $table->decimal('longitude', 10, 6);
            $table->decimal('latitude', 10, 6);

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('tempat_kuliner');
    }
};
