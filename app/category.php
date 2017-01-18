<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class category extends Model
{
    protected $fillable=[
    	'kode_kategori','keterangan_kategori'
    ];
}
