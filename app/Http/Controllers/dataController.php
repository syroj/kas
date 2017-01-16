<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\data;
use Alert;

class dataController extends Controller
{
	 /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	$tanggal=date('Y-m-d');
    	$saldo=data::count();
    	if ($saldo >=1){
    		$find=data::orderby('created_at','desc')->get();
    		$saldo=$find[0]['saldo'];
    	}else{
    		$saldo==$saldo;
    	}
    	
    	$masuk =data::where('created_at','like','%'.$tanggal.'%')->sum('masuk');
    	$keluar =data::where('created_at','like','%'.$tanggal.'%')->sum('keluar');
    	

    	$in=data::where('masuk','!=', 0)->count();
    	$out=data::where('keluar','!=', 0)->count();
    	$data= data::orderby('created_at','desc')->paginate(10);
        return view('welcome',[
        	'datas' 	=> $data,
        	'in'		=> $in,
        	'out'		=> $out,
        	'saldo' 	=> $saldo,
        	'masuk'		=> $masuk,
        	'keluar'	=> $keluar
        	]);
    }
    public function in(Request $request){
        $nama=$request->nama;
        $masuk=$request->masuk;
        $uraian=$request->uraian;
    	if($nama != null && $masuk != null && $uraian !=null){
            $saldo=data::count();
        	if ($saldo >=1){
        		$find=data::orderby('created_at','desc')->get();
        		$saldo=$find[0]['saldo'];
        	}else{
        		$saldo==$saldo;
        	}
        	$data=[
        	'no_cek'=>$request->no_cek,
        	'nama'=>$request->nama,
        	'masuk'=>$request->masuk,
        	'keluar'=>0,
        	'uraian'=>$request->uraian,
        	'saldo'=>$saldo+$request->masuk
        	];
        	$Create=data::create($data);
            Alert::success('Data berhasil diinput');
        	return redirect('/home');
        }else{
            Alert::error('Form tidak boleh kosong');
            return redirect('/home');
        }
    }
    public function out(Request $request){
        $nama=$request->nama;
        $keluar=$request->keluar;
        $uraian=$request->uraian;
        if ($nama != null && $keluar != null && $uraian!= null){
        	$saldo=data::count();
        	if ($saldo >=1){
        		$find=data::orderby('created_at','desc')->get();
        		$saldo=$find[0]['saldo'];
        	}else{
        		$saldo==$saldo;
        	}
        	
        	$data=[
        	'no_cek'=>$request->no_cek,
        	'nama'=>$request->nama,
        	'masuk'=>0,
        	'keluar'=>$request->keluar,
        	'uraian'=>$request->uraian,
        	'saldo'=>$saldo-$request->keluar
        	];
        	$Create=data::create($data);
            Alert::success('Data berhasil diinput');
        	return redirect('/home');
        }else{
            Alert::error('Form tidak boleh kosong');
            return redirect('/home');
        }
    }
	public function data(){
		$data=data::orderby('created_at','asc')->paginate(20);
		return view('database',['datas'=>$data]);
	}
    public function search(Request $request){
        $s=$request->s;
        $datas=data::where('nama','like','%'.$request->s.'%')->orwhere('uraian','like','%'.$request->s.'%')->orwhere('no_cek','like','%'.$request->s.'%')->orwhere('created_at','like','%'.$request->s.'%')->paginate(20);
        if (count($datas)==null) {
            Alert::warning('Data tidak ditemukan');
            return redirect('/database');

        }else{
            return view('database',compact('datas','s'));   
        }
    }   
    public function detail($id){
        $data=data::where('id',$id)->get();
        return view('detail',['datas'=>$data]);
    }
    public function filter(Request $request){
        $from=$request->from;
        $to=$request->to;
        $datas=data::whereBetween('created_at',[$from,$to])->paginate(10);
        if (count($datas)==null) {
            Alert::warning('Data tidak ditemukan');
            return redirect('/database');
        }else{
            return view('filter',compact('datas','from','to'));
        }
    }
}
