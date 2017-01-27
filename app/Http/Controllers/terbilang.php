<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\data;
use App\category;
use Alert;
use Excel;

class terbilang extends Controller
{
	var $angka;
	public function terbilang($angka){
	    $this->angka=$angka;
	    $satuan=['','satu','dua','tiga','empat','lima','enam','tujuh','delapan','sembilan','sepuluh','sebelas'];
	    switch ($angka) {
	            case ($angka < 12):
	                echo "" . $satuan[$angka];
	                break;
	            case ($angka < 20):
	                echo $result = terbilang($angka - 10) . " belas";
	                break;
	            case ($angka < 100):
	                echo terbilang($angka / 10);
	                echo " puluh ";
	                echo terbilang($angka % 10);
	                break;
	            case ($angka < 200):
	                echo " seratus ";
	                echo terbilang($angka - 100);
	                break;
	            case ($angka < 1000):
	                echo terbilang($angka / 100);
	                echo " ratus ";
	                echo terbilang($angka % 100);
	                break;
	            case ($angka < 2000):
	                echo " seribu ";
	                echo terbilang($angka - 1000);
	                break;
	            case ($angka < 1000000):
	                echo terbilang($angka / 1000);
	                echo " ribu ";
	                echo terbilang($angka % 1000);
	                break;
	            case ($angka < 1000000000):
	                echo terbilang($angka / 1000000);
	                echo " juta ";
	                echo terbilang($angka % 1000000);
	                break;
	            case ($angka < 1000000000000):
	                echo terbilang($angka / 1000000000);
	                echo " milyar ";
	                echo terbilang($angka % 1000000000);
	                break;
		}
	}	
}
