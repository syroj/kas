<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\data;
use App\category;
use App\client;
use App\jurnal_masuk;
use App\jurnal_keluar;
use Alert;
use Excel;


class jurnalController extends Controller
{
    // versi 2.0
    public function __construct(){
    	$this->middleware('auth');
    }

    public function addclient(Request $req){
        $client=$req->except('_token');
        client::insert($client);
        return redirect('home');
    }
    public function jurnal_masuk(Request $req){
        $debet=$req->debet;
        $kredit=$req->kredit;
      	$tgl=$req->tgl_transaksi;
        // explode tanggal dan uang 
        $tr=explode('-', $tgl);
        $tgl_transaksi=$tr[2].'-'.$tr[1].'-'.$tr[0];
        
        if ($debet!==null) {
			$d=str_replace('.','', $debet);
        	$debet=(int)$d;
        }
        if ($kredit!==null) {
			$d=str_replace('.','', $kredit);
        	$kredit=(int)$d;
        }

        $saldo=$debet-$kredit;

        $data=[
			'no_cek'=>$req->no_cek,
	    	'tgl_transaksi'=>$tgl_transaksi,
	    	'kode_client'=>$req->kode_client,
	    	'debet'=>$debet,
	    	'kredit'=>$kredit,
	    	'saldo'=>$saldo,
	    	'perkiraan'=>$req->perkiraan,
	    	'nama_perkiraan'=>$req->nama_perkiraan,
	    	'id_jurnal'=>$req->id_categories,
	    	'uraian'=>$req->uraian,
    	];
        jurnal_masuk::create($data);
        return redirect('/home');
    }
    public function jurnal_keluar(Request $req){
        $debet=$req->debet;
        $kredit=$req->kredit;
      	$tgl=$req->tgl_transaksi;
        // explode tanggal dan uang 
        $tr=explode('-', $tgl);
        $tgl_transaksi=$tr[2].'-'.$tr[1].'-'.$tr[0];
        
        if ($debet!==null) {
			$d=str_replace('.','', $debet);
        	$debet=(int)$d;
        }
        if ($kredit!==null) {
			$d=str_replace('.','', $kredit);
        	$kredit=(int)$d;
        }

        $saldo=$debet-$kredit;

        $data=[
			'no_cek'=>$req->no_cek,
	    	'tgl_transaksi'=>$tgl_transaksi,
	    	'kode_client'=>$req->kode_client,
	    	'debet'=>$debet,
	    	'kredit'=>$kredit,
	    	'saldo'=>$saldo,
	    	'perkiraan'=>$req->perkiraan,
	    	'nama_perkiraan'=>$req->nama_perkiraan,
	    	'id_jurnal'=>$req->id_categories,
	    	'uraian'=>$req->uraian,
    	];
        jurnal_keluar::create($data);
        return redirect('/home');
    }
}
