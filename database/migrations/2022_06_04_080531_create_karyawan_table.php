<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKaryawanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('karyawan', function (Blueprint $table) {
            $table->increments('id_karyawan')->unsigned()->index();;
            $table->integer('id_jabatan')->unsigned()->index();
            $table->integer('id_divisi')->unsigned()->index();
            $table->bigInteger('nip');
            $table->string('nama_karyawan');
            $table->string('jkel');
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir')->nullable();
            $table->string('telepon');
            $table->string('agama');
            $table->string('status_nikah');
            $table->string('alamat');
            $table->integer('tanggungan_anak');
            $table->date('tanggal_perekrutan')->nullable();
            $table->string('tempat_perekrutan');
        });
        Schema::table('karyawan', function ($table) {
            $table->foreign('id_jabatan')->references('id_jabatan')->on('jabatan')->onDelete('cascade');
            $table->foreign('id_divisi')->references('id_divisi')->on('divisi')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('karyawan');
    }
}
