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
        Schema::create('tempat_wisata_kategori', function (Blueprint $table) {
            $table->primary(['id_wisata', 'id_kategori']);
            $table->unsignedBigInteger('id_wisata');
            $table->unsignedBigInteger('id_kategori');

            $table->foreign('id_wisata')
            ->references('id_wisata')
            ->on('tempat_wisata')
            ->onUpdate('cascade')
            ->onDelete('cascade');

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
        Schema::dropIfExists('tempat_wisata_kategori');
    }
};
