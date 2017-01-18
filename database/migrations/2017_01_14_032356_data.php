<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Data extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data',function(Blueprint $data){
            $data->increments('id');
            $data->integer('id_categories');
            $data->string('no_cek');
            $data->string('tgl_transaksi');
            $data->string('nama');
            $data->integer('masuk');
            $data->integer('keluar');
            $data->integer('saldo');
            $data->string('uraian');
            $data->timestamps();
        });
        Schema::Create('categories',function(Blueprint $table){
            $table->increments('id');
            $table->string('kode_kategori');
            $table->string('keterangan_kategori');
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
        Schema::drop('data');
        Schema::drop('categories');
    }
}
