<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKaryawansTable extends Migration
{
    public function up()
    {
        Schema::create('karyawan', function (Blueprint $table) {
            $table->string('id_karyawan',10)->primary();
            $table->string('jabatan',10);
            $table->foreign('jabatan')->references('id_jabatan')->on('jabatan');
            $table->string('role',10);
            $table->foreign('role')->references('id_role')->on('role');
            $table->string('golongan',10);
            $table->foreign('golongan')->references('id_golongan')->on('golongan');
            $table->string('departemen',10);
            $table->foreign('departemen')->references('id_departemen')->on('departemen');
            $table->string('nama');
            $table->string('alamat');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('no_telepon');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('karyawans');
    }
}

