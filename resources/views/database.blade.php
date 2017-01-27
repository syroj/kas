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
				<div class="widget-box span12">
					<div class="widget-title">
						<span class="icon"><i class="icon-file"></i></span>
						<h5>Database</h5>
						<ul class="nav nav-tabs">
							<li class="active"><a data-toggle="tab" href="#tgl_input"><i class="icon-calendar"></i>  Filter</a></li>
              				<li><a data-toggle="tab" href="#kategori"><i class="icon-qrcode"></i> Kategori</a></li>
              				<li><a data-toggle="tab" href="#Export"><i class="icon-file"></i> Export</a></li>
							<li class="pull-right"><a href="{{url('/home')}}"><i class="icon-home"></i> Kembali</a></li>
							<li class="pull-right"><a href="{{url('/clear-db')}}" id="truncate">Clear Database</a></li>
							<li class="pull-right"><a href="{{url('/database')}}"><i class="icon-refresh"></i> Refresh</a></li>

						</ul>
					</div>
					<div class="widget-content tab-content">
						<div id="tgl_input" class="tab-pane active">
							<table class="table table-bordered">
								<tr>
									<td colspan="2"><span class="icon-calendar"></span> Cari Data</td>
								</tr>
								<tr>
								<form method="get" action="{{url('/filter')}}">
									<td style="text-align: center;">Mulai</td>
									<td style="width: 15%;"><input type="text" name="from" class="span11" placeholder="(dd-mm-yyyy)"></td>
									<td style="text-align: center;">Sampai</td>
									<td style="width: 15%;"><input type="text" name="to" class="span12" placeholder="(dd-mm-yyyy)"> </td>
									<td>Berdarasarkan</td>
									<td>
										<select class="span12" name="filter">
											<option value="tgl_transaksi">Tanggal Transaksi</option>
											<option value="created_at">Tanggal Input</option>
										</select>
									</td>
									<td>
										Kategori
									</td>
									<td>
										<select class="span12" name="s">
										@if(count($categories)>0)
										@foreach($categories as $c)
											<option value="{{$c->id}}">
												{{$c->kode_kategori}}
											</option>
										@endforeach
										@else
											<option>Belum Ada Kategori</option>
										@endif
										</select>
									</td>
								</tr>
								<tr>
									<td colspan="8"><button type="submit" class="btn btn-default pull-right"> <span class="icon-search"></span> Filter</button></td>
								</tr>
								</form>
							</table>					
						</div>
						<div class="tab-pane" id="kategori">
							<table class="table table-bordered">
								<tr>
				                  <th>Kode</th>
				                  <th>Keterangan</th>
				                  <th>Tanggal</th>
				                  <th>Tampilkan</th>
				                </tr>
				                @foreach($categories as $c)
				                <tr>
				                  <td>{{$c->kode_kategori}}</td>
				                  <td>{{$c->keterangan_kategori}}</td>
				                  <td>{{$c->created_at}}</td>
				                  <td><a href="{{url('kategori',$c->id)}}" class="btn btn-success"><span class="icon-folder-open"></span></a></td>
				                </tr>
				                @endforeach
                			</table>
						</div>
						<div class="tab-pane" id="Export">
							<table class="table table-bordered">
								<tr>
									<td colspan="2"><span class="icon-calendar"></span> Export Data</td>
								</tr>
								<tr>
								<form method="get" action="{{url('/export')}}">
									<td style="text-align: center;">Mulai</td>
									<td style="width: 15%;"><input type="text" name="from" class="span11" placeholder="(dd-mm-yyyy)"></td>
									<td style="text-align: center;">Sampai</td>
									<td style="width: 15%;"><input type="text" name="to" class="span12" placeholder="(dd-mm-yyyy)"> </td>
									<td>Berdarasarkan</td>
									<td>
										<select class="span12" name="filter">
											<option value="tgl_transaksi">Tanggal Transaksi</option>
											<option value="created_at">Tanggal Input</option>
										</select>
									</td>
									<td>
										Kategori
									</td>
									<td>
										<select class="span12" name="s">
										@if(count($categories)>0)
										@foreach($categories as $c)
											<option value="{{$c->id}}">
												{{$c->kode_kategori}}
											</option>
										@endforeach
										@else
											<option>Belum Ada Kategori</option>
										@endif
										</select>
									</td>
								</tr>
								<tr>
									<td colspan="8"><button type="submit" class="btn btn-default pull-right"> <span class="icon-arrow-down"></span> Excel</button></td>
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
						<td colspan="9" style="text-align: center;">Belum Ada Data Tersedia</td>
					</tr>
					@endif
					</tbody>
				</table>
				<center>
		          <div class="pagination">
		          {{$datas->appends(compact('from','to','filter','s'))->links()}}
		          </div>
		        </center>
			</div>
		</div>
	</div>
</div>
@endsection