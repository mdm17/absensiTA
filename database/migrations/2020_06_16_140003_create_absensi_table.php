<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAbsensiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('absensi', function (Blueprint $table) {
            $table->id();
            $table->string('ruang');
            $table->string('kelas');
            $table->string('hari');
            $table->integer('pertemuan')->nullable();
            $table->char('mhs_nim', 12);
            $table->string('mhs_nama');
            $table->string('matkul');
            $table->string('bahasan')->nullable();
            $table->char('nip_dosen', 18);
            $table->enum('absen_ket', ['IZIN', 'SAKIT', 'ALPHA', 'DITUGASKAN'])->nullable();
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
        Schema::dropIfExists('absensi');
    }
}
