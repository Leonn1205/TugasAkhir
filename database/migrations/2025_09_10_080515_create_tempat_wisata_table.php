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
            $table->string('nama_wisata');
            $table->text('alamat_lengkap');
            $table->decimal('longitude', 10, 6);
            $table->decimal('latitude', 10, 6);
            $table->text('deskripsi');
            $table->text('sejarah');
            $table->text('narasi'); // bisa dipakai untuk teks / audio
            $table->timestamps();
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
