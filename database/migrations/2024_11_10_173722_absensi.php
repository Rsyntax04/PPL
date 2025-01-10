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
        Schema::create('absensi', function (Blueprint $table) {
            $table->string('id_karyawan', 10);
            $table->foreign('id_karyawan')->references('id_karyawan')->on('karyawan');
            $table->dateTime('waktu_masuk');
            $table->dateTime('waktu_keluar')->nullable();
            $table->string('jenis_presensi');
            $table->string('status');
            $table->binary('approval');
            $table->timestamps();

            $table->primary(['id_karyawan', 'waktu_masuk']);
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
};
