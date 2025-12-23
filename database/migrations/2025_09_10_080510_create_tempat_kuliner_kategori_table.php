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
        Schema::create('tempat_kuliner_kategori', function (Blueprint $table) {
            $table->primary(['id_kuliner', 'id_kategori']);
            $table->unsignedBigInteger('id_kuliner');
            $table->unsignedBigInteger('id_kategori');

            $table->foreign('id_kuliner')
            ->references('id_kuliner')
            ->on('tempat_kuliner')
            ->onUpdate('cascade')
            ->onDelete('cascade');

            $table->foreign('id_kategori')
            ->references('id_kategori')
            ->on('kategori_kuliner')
            ->onUpdate('cascade')
            ->onDelete('cascade');
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
        Schema::dropIfExists('tempat_kuliner_kategori');
    }
};
