<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class data extends Model
{
    protected $fillable=[
    	'no_cek','nama','uraian','masuk','keluar','saldo','id_categories','tgl_transaksi'
    ];
}
