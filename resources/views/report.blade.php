@extends('layouts.layout')
@section('content')
<table class="table table-bordered">
	<tr>
		<th>No. Cek</th>
		<th>Tanggal Transaksi</th>
		<th>Nama</th>
		<th>Masuk</th>
		<th>Keluar</th>
	</tr>
	@foreach($datas as $data)
	<tr>
		<td>
			{{$data->no_cek}}
		</td>
		<td>
			{{$data->tgl_transaksi}}
		</td>
		<td>
			{{$data->nama}}
		</td>
		<td>
			{{$data->masuk}}
		</td>
		<td>
			{{$data->keluar}}
		</td>
	</tr>
	@endforeach
</table>
@endsection