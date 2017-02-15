<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class jurnal_keluar extends Model
{
    protected $table='jurnal_keluar';
    protected $fillable=['perkiraan','nama_perkiraan','debet','kredit','saldo','tgl_transaksi','uraian','kode_client','no_cek','id_jurnal'];
}
