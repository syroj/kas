<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\data;
use App\category;
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
        $cats=category::all();
        return view('welcome',[
        	'datas' 	=> $data,
        	'in'		=> $in,
        	'out'		=> $out,
        	'saldo' 	=> $saldo,
        	'masuk'		=> $masuk,
        	'keluar'	=> $keluar,
            'categories'=> $cats,
        	]);
    }
    public function in(Request $request){
        $nama=$request->nama;
        $m=$request->masuk;
        $mas=str_replace(".","", $m);
        $masuk=(int)$mas;
        if ($masuk == null) {
            Alert::error('Nominal pemasukan harus berupa angka');
        }
        $uraian=$request->uraian;
        $kategori=$request->id_categories;
        $tgl_transaksi=$request->tgl_transaksi;
    	if($nama != null && $masuk != null && $uraian !=null && $kategori!=null && $tgl_transaksi !=null){
            $saldo=data::where('id_categories',$kategori)->count();
        	if ($saldo >=1){
        		$find=data::where('id_categories',$kategori)->orderby('created_at','desc')->get();
        		$saldo=$find[0]['saldo'];
        	}else{
        		$saldo==$saldo;
        	}
        	$data=[
            'id_categories'=>$kategori,
            'no_cek'=>$request->no_cek,
            'tgl_transaksi'=>$tgl_transaksi,
            'nama'=>$request->nama,
        	'masuk'=>$masuk,
        	'keluar'=>0,
        	'uraian'=>$request->uraian,
        	'saldo'=>$saldo+$masuk
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
        $k=$request->keluar;
        $keluar =str_replace(".","",$k);
        $kel=str_replace(".","", $k);
        $keluar=(int)$kel;
        $uraian=$request->uraian;
        $kategori=$request->id_categories;
        $tgl_transaksi=$request->tgl_transaksi;
        
        if ($nama != null && $kel != null && $uraian !=null && $kategori!=null && $tgl_transaksi !=null){
        	$saldo=data::where('id_categories',$kategori)->count();
        	if ($saldo >=1){
        		$find=data::where('id_categories',$kategori)->orderby('created_at','desc')->get();
        		$saldo=$find[0]['saldo'];
        	}else{
        		$saldo==$saldo;
        	}
        	
        	$data=[
            'id_categories'=>$kategori,
            'tgl_transaksi'=>$tgl_transaksi,
        	'no_cek'=>$request->no_cek,
        	'nama'=>$request->nama,
        	'masuk'=>0,
        	'keluar'=>$keluar,
        	'uraian'=>$request->uraian,
        	'saldo'=>$saldo-$keluar
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
        $categories=category::all();
		$data=data::orderby('created_at','asc')->paginate(20);
		return view('database',['datas'=>$data,'categories'=>$categories]);
	}
    public function search(Request $request){
        $categories=category::all();
        $s=$request->s;
        $datas=data::where('nama','like','%'.$request->s.'%')->orwhere('uraian','like','%'.$request->s.'%')->orwhere('no_cek','like','%'.$request->s.'%')->orwhere('created_at','like','%'.$request->s.'%')->paginate(20);
        if (count($datas)==null) {
            Alert::warning('Data tidak ditemukan');
            return redirect('/database');

        }else{
            return view('database',compact('datas','s','categories'));   
        }
    }   
    public function detail($id){
        $data=data::where('id',$id)->get();
        return view('detail',['datas'=>$data]);
    }
    public function filter(Request $request){
        $from=$request->from;
        $to=$request->to;
        if ($from ==null || $to == null ) {
            Alert::warning('Input Tidak boleh kosong');
            return redirect('/database');
        }elseif ($from ==$to) {
            Alert::warning('Tanggal pencarian tidak boleh sama');
            return redirect('/database');
        }
        $s=$request->s;
        $tos=explode("-", $to);
        $date=$tos[2]+1;
        $sampai=$tos[0].'-'.$tos[1].'-'.$date;
        $datas=data::whereBetween('created_at',[$from,$sampai])->paginate(10);
        if (count($datas)==null) {
            Alert::warning('Data tidak ditemukan');
            return redirect('/database');
        }else{
            return view('filter',compact('datas','from','to'));
        }
    }
    public function byCategory($id){
        $categories=category::all();
        $data=data::where('id_categories',$id)->orderby('created_at','asc')->paginate(1);
        return view('database',['datas'=>$data,'categories'=>$categories]);
    }
    public function filterCategory(Request $request){
        $categories=category::all();
        $s=$request->s;
        $datas=data::where('id_categories',$s)->paginate(20);
        return view('database',compact('datas','s','categories'));
    }
}
