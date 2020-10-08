<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJadwalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jadwal', function (Blueprint $table) {
            $table->id();
            $table->enum('hari', ['SENIN', 'SELASA', 'RABU', 'KAMIS', 'JUMAT']);
            $table->time('jam_mulai');
            $table->time('jam_selesai');
            $table->foreignId('kelas_id');
            $table->foreign('kelas_id')->references('id')->on('kelas');
            $table->foreignId('matkul_id');
            $table->foreign('matkul_id')->references('id')->on('matkul');
            $table->foreignId('ruang_id');
            $table->foreign('ruang_id')->references('id')->on('ruang');
            $table->foreignId('dosen_id');
            $table->foreign('dosen_id')->references('id')->on('dosen');
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
        Schema::dropIfExists('jadwal');
    }
}
