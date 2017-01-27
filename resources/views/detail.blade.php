@extends('layouts.layout')
@section('content')

<div class="container-fluid">
	<div class="span6" style="margin-left: 25%; margin-right: 25%; margin-top: 0%;">
			<div class="widget-box">
				<div class="widget-title">
					<span class="icon"><i class="icon-search"></i></span>
					<h5>Detail Transaksi</h5>
				</div>
				<div class="widget-content">
					<table class="table table-bordered">
					@foreach($datas as $data)
						<tr>
							<td style="width: 10%;">No. Cek</td>
							<td colspan="2">{{$data->no_cek}} </td>
						</tr>
						<tr>
							<td>Nama</td>
							<td colspan="2">{{$data->nama}} </td>
						</tr>
						<tr>
							<td rowspan="2">Nominal</td>
							<td>Masuk</td>
							<td style="text-align: right;">Rp. {{number_format($data->masuk,0,",",".")}} </td>
						</tr>
						<tr>
							<td>Keluar</td>
							<td style="text-align: right;">Rp. {{number_format($data->keluar,0,",",".")}} </td>
						</tr>
						<tr>
							<td>Keterngan</td>
							<td colspan="2">
								{{$data->uraian}}
							</td>
						</tr>
						<tr>
							<td colspan="3">
								<p style="text-align: right;">
								{{date('d M Y')}}
								</br>
								</br>
								</br>
								</br>
								{{Auth()->user()->name}}
								</p>
							</td>
						</tr>
						<tr>
							<td colspan="3">
							<a href="{{url('/kwitansi',$data->id)}}" class="btn btn-default pull-right"><span class="icon-print"></span> Cetak</a>

							<a href="{{('/')}}" class="btn btn-primary pull-right"><span class="icon-arrow-left"></span> Kembali</a>
							</td>
						</tr>
					@endforeach
					</table>
				</div>
			</div>
			</div>	
</div>

@endsection