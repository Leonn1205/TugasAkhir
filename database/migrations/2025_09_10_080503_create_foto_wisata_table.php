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
        Schema::create('foto_wisata', function (Blueprint $table) {
            $table->id('id_foto');
            $table->unsignedBigInteger('id_wisata');
            $table->string('path_foto');
            $table->timestamps();

            $table->foreign('id_wisata')
                ->references('id_wisata')
                ->on('tempat_wisata')
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
        Schema::dropIfExists('foto');
    }
};
