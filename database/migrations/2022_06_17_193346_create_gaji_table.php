<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGajiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gaji', function (Blueprint $table) {
            $table->increments('id_gaji')->unsigned()->index();
            $table->integer('id_karyawan')->unsigned()->index();
            $table->integer('id_jabatan')->unsigned()->index();
            $table->integer('gaji_pokok');
            $table->integer('tunjangan_transport');
            $table->integer('tunjangan_makan');
            $table->integer('tunjangan_sakit');
            $table->integer('tunjangan_kompensasi');
            $table->integer('tunjangan_cuti');
        });

        Schema::table('gaji', function ($table) {
            $table->foreign('id_karyawan')->references('id_karyawan')->on('karyawan')->onDelete('cascade');
            $table->foreign('id_jabatan')->references('id_jabatan')->on('jabatan')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('gaji');
    }
}
