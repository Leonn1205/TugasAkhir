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
        Schema::create('jam_operasional_kuliner', function (Blueprint $table) {
            $table->id("id_jam_operasional");
            $table->unsignedBigInteger('id_kuliner');
            $table->enum('hari', ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu']);
            $table->time('jam_buka')->nullable();
            $table->time('jam_tutup')->nullable();
            $table->time('jam_sibuk_mulai')->nullable();
            $table->time('jam_sibuk_selesai')->nullable();
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
        Schema::dropIfExists('jam_operasional_kuliner');
    }
};
