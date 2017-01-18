<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\category as category;
use Alert;
class categoryController extends Controller
{
    public function add(Request $request){
    	$kode=$request->kode_kategori;
    	$keterangan=$request->keterangan_kategori;
    	if ($kode != null && $keterangan != null) {
    		$data=$request->all();
    		$insert=category::create($data);
    		return redirect('/home');
    	}else{
    		Alert::warning('Form Tidak Boleh Kosong');
    		return redirect('/home');
    	}
    }
}
