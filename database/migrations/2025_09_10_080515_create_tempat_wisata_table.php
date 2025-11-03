<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tempat_wisata', function (Blueprint $table) {
            $table->id('id_wisata');
            $table->unsignedBigInteger("id_kategori");
            $table->string('nama_wisata');
            $table->text('alamat_lengkap');
            $table->decimal('longitude', 10, 6)->nullable();
            $table->decimal('latitude', 10, 6)->nullable();
            $table->text('deskripsi')->nullable();
            $table->text('sejarah')->nullable();
            $table->text('narasi')->nullable(); // bisa dipakai untuk teks / audio
            $table->timestamps();

            $table->foreign('id_kategori')
            ->references('id_kategori')
            ->on('kategori_wisata')
            ->onUpdate('cascade')
            ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tempat_wisata');
    }
};
