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
				<div class="widget-box span6">
					<div class="widget-title">
						<span class="icon"><i class="icon-file"></i></span>
						<h5>Database</h5>
						<ul class="nav nav-tabs">
							<li class="active"><a data-toggle="tab" href="#tgl_input"><i class="icon-calendar"></i>  INPUT</a></li>
							<li><a data-toggle="tab" href="#tgl_transaksi"><i class="icon-calendar"></i>  TRANSAKSI</a></li>
							<li><a data-toggle="tab" href="#laporan"><i class="icon-book"></i>  Laporan</a></li>
							<li><a href="{{url('/home')}}"><i class="icon-home"></i> Kembali</a></li>
							<li><a href="{{url('/database')}}"><i class="icon-refresh"></i> Refresh</a></li>

						</ul>
					</div>
					<div class="widget-content tab-content">
						<div id="tgl_input" class="tab-pane active">
							<table class="table table-bordered">
								<tr>
									<td colspan="2"><span class="icon-calendar"></span> Cari Berdasarkan Tanggal INPUT</td>
								</tr>
								<tr>
								<form method="get" action="{{url('/filterDate')}}">
									<td style="text-align: center;">Mulai</td>
									<td><input type="text" name="from" class="span11"></td>
									<td style="text-align: center;">Sampai</td>
									<td><input type="text" name="to" class="span12"> </td>
								</tr>
								<tr>
									<td colspan="3"><span class="icon-print"></span> Filter Kategori</td>
									<td>
										<select class="span12" name="s">
										@foreach($categories as $c)
											<option value="{{$c->id}}">
												{{$c->kode_kategori}}
											</option>
										@endforeach
										</select>
									</td>
								</tr>
								<tr>
									<td colspan="4"><button type="submit" class="btn btn-default pull-right"> <span class="icon-search"></span> Filter</button></td>
								</tr>
								</form>
							</table>					
						</div>
						<div id="tgl_transaksi" class="tab-pane">
							<table class="table table-bordered">
								<tr >
									<td colspan="2"><span class="icon-calendar"></span> Cari Berdasarkan Tanggal TRANSAKSI</td>
								</tr>
								<tr>
								<form method="get" action="{{url('/filterDateTrans')}}">
									<td style="text-align: center;">Mulai</td>
									<td><input type="text" name="from" class="span11"></td>
									<td style="text-align: center;">Sampai</td>
									<td><input type="text" name="to" class="span12"> </td>
								</tr>
								<tr>
									<td colspan="3"><span class="icon-print"></span> Filter Kategori</td>
									<td>
										<select class="span12" name="s">
										@foreach($categories as $c)
											<option value="{{$c->id}}">
												{{$c->kode_kategori}}
											</option>
										@endforeach
										</select>
									</td>
								</tr>
								<tr>
									<td colspan="4"><button type="submit" class="btn btn-default pull-right"> <span class="icon-search"></span> Filter</button></td>
								</tr>
								</form>
							</table>					
						</div>
						<div id="laporan" class="tab-pane">
							<table class="table table-bordered">
								<tr >
									<td colspan="2"><span class="icon-calendar"></span> Buat Laporan Dalam Excel</td>
								</tr>
								<tr>
								<form method="get" action="{{url('/filterDateTrans')}}">
									<td style="text-align: center;">Mulai</td>
									<td><input type="text" name="from" class="span11"></td>
									<td style="text-align: center;">Sampai</td>
									<td><input type="text" name="to" class="span12"> </td>
								</tr>
								<tr>
									<td colspan="3"><span class="icon-print"></span> Filter Kategori</td>
									<td>
										<select class="span12" name="s">
										@foreach($categories as $c)
											<option value="{{$c->id}}">
												{{$c->kode_kategori}}
											</option>
										@endforeach
										</select>
									</td>
								</tr>
								<tr>
									<td colspan="4"><button type="submit" class="btn btn-default pull-right"> <span class="icon-search"></span> Filter</button></td>
								</tr>
								</form>
							</table>					
						</div>
					</div>
				</div>
				<table class="table table-bordered">
					<thead>
						<th>No.Cek</th>
						<th>Nama</th>
						<th>Masuk</th>
						<th>Keluar</th>
						<th>Saldo</th>
						<th>Uraian</th>
						<th style="width: 10%;">Tanggal Transaksi</th>
						<th style="width: 15%;">Tanggal Input</th>
						<th>Opsi</th>
					</thead>
					<tbody>
					@if(count($datas)>0)
					@foreach($datas as $data)
						<tr>
						<td>{{$data->no_cek}}</td>
						<td>{{$data->nama}}</td>
						<td>Rp. {{number_format($data->masuk,0,",",".")}}</td>
						<td>Rp. {{number_format($data->keluar,0,",",".")}}</td>
						<td>Rp. {{number_format($data->saldo,0,",",".")}}</td>
						<td>{{$data->uraian}}</td>
						<td>{{$data->tgl_transaksi}} </td>
						<td>{{$data->created_at}}</td>
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
		          {{$datas->appends(compact('s'))->links()}}
		          </div>
		        </center>
			</div>
		</div>
	</div>
</div>
@endsection