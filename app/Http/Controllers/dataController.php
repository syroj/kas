<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\data;
use App\category;
use Alert;
use Excel;

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
    public function index(){
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
        $trans=$request->tgl_transaksi;
        $tr=explode("-", $trans);
        $tgl_transaksi=$tr[2].'-'.$tr[1].'-'.$tr[0];
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
        $trans=$request->tgl_transaksi;
        $tr=explode("-", $trans);
        $tgl_transaksi=$tr[2].'-'.$tr[1].'-'.$tr[0];
        
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
        $categories=category::all();
        $from=$request->from;
        $to=$request->to;
        $s=$request->s;
        $filter=$request->filter;
        if ($from ==null || $to == null || $s== null) {
            Alert::warning('Input Tidak boleh kosong');
            return redirect('/database');
        }elseif ($from ==$to) {
            Alert::warning('Tanggal pencarian tidak boleh sama');
            return redirect('/database');
        }

        $tos=explode("-", $to);
        $froms=explode("-", $from);
        $dari=$froms[2].'-'.$froms[1].'-'.$froms[0];
        $date=$tos[0]+1;
        $sampai=$tos[2].'-'.$tos[1].'-'.$tos[0];
        if ($filter =='created_at') {
            $sampai=$tos[2].'-'.$tos[1].'-'.$date;
            $datas=data::where('id_categories',$s)
                        ->whereBetween('created_at',[$dari,$sampai])
                        ->paginate(15);
            return view('database',compact('datas','from','to','s','categories','filter'));
        }elseif ($filter=='tgl_transaksi') {
            $sampai=$tos[2].'-'.$tos[1].'-'.$tos[0];
            $datas=data::where('id_categories',$s)
                        ->whereBetween('tgl_transaksi',[$dari,$sampai])
                        ->paginate(15);
            return view('database',compact('datas','from','to','s','categories','filter'));
        }
    }

    public function byCategory($id){
        $categories=category::all();
        $data=data::where('id_categories',$id)
                    ->orderby('created_at','asc')
                    ->paginate(20);
        return view('database',['datas'=>$data,'categories'=>$categories]);
    }

    public function export(Request $request){
        $categories=category::all();
        $from=$request->from;
        $to=$request->to;
        $s=$request->s;
        $filter=$request->filter;
        if ($from ==null || $to == null || $s== null) {
            Alert::warning('Input Tidak boleh kosong');
            return redirect('/database');
        }elseif ($from ==$to) {
            Alert::warning('Tanggal pencarian tidak boleh sama');
            return redirect('/database');
        }

        $tos=explode("-", $to);
        $froms=explode("-", $from);
        $dari=$froms[2].'-'.$froms[1].'-'.$froms[0];
        $date=$tos[0]+1;
        $sampai=$tos[2].'-'.$tos[1].'-'.$tos[0];
        if ($filter =='created_at') {
            $sampai=$tos[2].'-'.$tos[1].'-'.$date;
            $datas=data::where('id_categories',$s)
                        ->whereBetween('created_at',[$dari,$sampai])
                        ->get();
            // return view('database',compact('datas','from','to','s','categories','filter'));
            Excel::create('laporan', function($excel) use($datas) {
                $excel->sheet('Sheet 1', function($sheet) use($datas) {
                    $sheet->fromArray($datas, null,'A1',true);
                });
            })->export('xls');

        }elseif ($filter=='tgl_transaksi') {
            $sampai=$tos[2].'-'.$tos[1].'-'.$tos[0];
            $datas=data::where('id_categories',$s)
                        ->whereBetween('tgl_transaksi',[$dari,$sampai])
                        ->get();
            // return view('database',compact('datas','from','to','s','categories','filter'));
            Excel::create('laporan', function($excel) use($datas) {
                $excel->sheet('Sheet 1', function($sheet) use($datas) {
                    $sheet->fromArray($datas, null,'A1',true);
                });
            })->export('xls');
        }
    }
}
