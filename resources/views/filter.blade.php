@extends('layouts.layout')
@section('content')
<div class="container-fluid">
	<div class="row-fluid">
		<div class="widget-box">
			<div class="widget-title">
				<span class="icon"><a href="{{('/')}}">
					<i class="icon-home"></i></span>
				</a>
				<div class="input-append pull-right" style="margin-top: 2px;">
				<form method="get" action="{{url('/search')}}">
		          <input type="text" name="s" class="span10" placeholder="Cari Transaksi">
		          <span class="add-on"><i class="icon-search"></i></span>
				</form>
		        </div>
				<h5>Data Transaksi</h5>
			</div>
			<div class="widget-content">
				<div class="span6">
					<table class="table table-bordered">
						<tr>
							<td colspan="2"><span class="icon-calendar"></span> Cari Berdasarkan Tanggal</td>
						</tr>
						<tr>
						<form method="get" action="{{url('/filterDate')}}">
							<td style="text-align: center;">Mulai</td>
							<td><input type="text" name="from" class="span11"></td>
							<td style="text-align: center;">Sampai</td>
							<td><input type="text" name="to" class="span10"></td>
							<td> <button type="submit" class="btn btn-default"> <span class="icon-search"></span></button></td>
						</form>
						</tr>
						<tr>
							<td colspan="3"><span class="icon-print"></span> Cetak Laporan</td>
							<td colspan="2">
								<div class="btn-group">
									<button class="btn btn-default"><span class="icon-print"></span></button>
									<button class="btn btn-default"><span class="icon-file"></span> Excell</button>
									<button class="btn btn-default"><span class="icon-file"></span> Pdf</button>
								</div>
							</td>
						</tr>
					</table>					
				</div>
				<a href="{{('/database')}}" class="btn btn-default pull-right"><span class="icon-bar-chart"></span> Database</a>
				<a href="{{('/')}}" class="btn btn-default pull-right"><span class="icon-home"></span> Home</a>
				<table class="table table-bordered">
					<thead>
						<th>No.Cek</th>
						<th>Nama</th>
						<th>Tanggal</th>
						<th>Masuk</th>
						<th>Keluar</th>
						<th>Saldo</th>
						<th>Uraian</th>
						<th>Opsi</th>
					</thead>
					<tbody>
					@if(count($datas)>0)
					@foreach($datas as $data)
						<tr>
						<td>{{$data->no_cek}}</td>
						<td>{{$data->nama}}</td>
						<td>{{$data->created_at}}</td>
						<td>Rp. {{number_format($data->masuk,0,",",".")}}</td>
						<td>Rp. {{number_format($data->keluar,0,",",".")}}</td>
						<td>Rp. {{number_format($data->saldo,0,",",".")}}</td>
						<td>{{$data->uraian}}</td>
						<td style="width: 5%;">
							<div class="btn-group pull-right">
								<a href="{{url('detail',$data->id)}} " class="btn btn-default"><i class="icon-file"></i></a>
							</div>
						</td>
						</tr>
					@endforeach
					@else
					<tr>
						<td colspan="8" style="text-align: center;">Belum Ada Data Tersedia</td>
					</tr>
					@endif
					</tbody>
				</table>
				<center>
		          <div class="pagination">
		          	{{$datas->appends(compact('from','to','s'))->links()}}
		          </div>
		        </center>
			</div>
		</div>
	</div>
</div>
@endsection