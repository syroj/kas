<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Jurnal extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('buku_besar',function(Blueprint $jurnal)
        {
            $jurnal->increments('id');
            $jurnal->string('kode');
            $jurnal->string('keterangan');
            $jurnal->timestamps();
        });
        Schema::create('jurnal_masuk',function(Blueprint $masuk){
            $masuk->increments('id');
            $masuk->integer('id_jurnal');
            $masuk->string('kode_client');
            $masuk->string('no_cek');
            $masuk->string('perkiraan');
            $masuk->string('nama_perkiraan');
            $masuk->string('debet');
            $masuk->string('kredit');
            $masuk->string('saldo');
            $masuk->string('tgl_transaksi');
            $masuk->text('uraian');
            $masuk->timestamps();
        });
        Schema::create('jurnal_keluar',function(Blueprint $keluar){
            $keluar->increments('id');
            $keluar->integer('id_jurnal');
            $keluar->string('kode_client');
            $keluar->string('no_cek');
            $keluar->string('perkiraan');
            $keluar->string('nama_perkiraan');
            $keluar->string('debet');
            $keluar->string('kredit');
            $keluar->string('saldo');
            $keluar->string('tgl_transaksi');
            $keluar->text('uraian');
            $keluar->timestamps();
        });
        Schema::create('client',function(Blueprint $klien)
        {
            $klien->increments('id');
            $klien->string('kode_client');
            $klien->string('nama_client');   
            $klien->text('kontak_client');
            $klien->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('buku_besar');
        Schema::drop('jurnal_masuk');
        Schema::drop('jurnal_keluar');
        Schema::drop('client');
    }
}
