<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class jurnal_masuk extends Model
{
    protected $table='jurnal_masuk';
    protected $fillable=['perkiraan','nama_perkiraan','debet','kredit','saldo','tgl_transaksi','uraian','kode_client','no_cek','id_jurnal'];
}
