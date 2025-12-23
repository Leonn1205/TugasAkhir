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
        Schema::create('foto_kuliner', function (Blueprint $table) {
            $table->id('id_foto_kuliner');
            $table->unsignedBigInteger('id_kuliner');
            $table->string('path_foto');
            $table->timestamps();

            $table->foreign('id_kuliner')
                ->references('id_kuliner')
                ->on('tempat_kuliner')
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
        Schema::dropIfExists('foto_kuliner');
    }
};
