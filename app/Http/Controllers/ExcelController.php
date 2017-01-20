<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\data as data;
use App\category as category;
use Alert;
use Excel;
class ExcelController extends Controller
{
    public function index(){
    	$categories=category::all();
    	$datas=data::paginate(9);
    	return view('database',compact(['datas','categories']));
    }
    public function report(Request $request){
    	$from=$request->from;
    	$to=$request->to;
    	$s=$request->s;
    	$datas=data::where('id_categories',$s)
    				->whereBetween('created_at',[$from,$to])
    				->paginate(2);
    	return view('filter',compact(['datas','from','to','s']));
    }
}
