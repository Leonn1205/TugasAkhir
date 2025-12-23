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
        Schema::create('jam_operasional_wisata', function (Blueprint $table) {
            $table->id("id_jam_operasional");
            $table->unsignedBigInteger('id_wisata');
            $table->enum('hari', ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu']);
            $table->time('jam_buka')->nullable();
            $table->time('jam_tutup')->nullable();
            $table->boolean('libur')->default(false);
            $table->timestamps();

            $table->unique(['id_wisata', 'hari']);

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
        Schema::dropIfExists('jam_operasional_wisata');
    }
};
