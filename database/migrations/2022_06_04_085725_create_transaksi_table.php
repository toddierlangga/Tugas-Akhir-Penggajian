<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransaksiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaksi', function (Blueprint $table) {
            $table->increments('id_trans')->unsigned()->index();
            $table->integer('id_karyawan')->unsigned()->index();
            $table->integer('total_gapok');
            $table->integer('total_tunjangan_transport');
            $table->integer('total_tunjangan_makan');
            $table->integer('total_tunjangan_sakit');
            $table->integer('total_tunjangan_kompensasi');
            $table->integer('total_tunjangan_cuti');
            $table->integer('total_tunjangan');
            $table->integer('gaji_kotor');
            $table->integer('total_biaya_jabatan');
            $table->integer('total_jht');
            $table->integer('total_jp');
            $table->integer('total_potongan');
            $table->integer('gaji_bersih_bulan');
            $table->integer('gaji_bersih_tahun');
            $table->integer('pph21_tahun');
            $table->integer('pph21_bulan');
            $table->integer('status_gaji');
            $table->string('bulan_gaji');
            $table->integer('tahun_gaji');
        });
        Schema::table('transaksi', function ($table) {
            $table->foreign('id_karyawan')->references('id_karyawan')->on('karyawan')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transaksi');
    }
}
