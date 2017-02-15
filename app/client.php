<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class client extends Model
{
    protected $table='client';
    protected $fillable=['kode_client','nama_client','kontak_client'];
}
