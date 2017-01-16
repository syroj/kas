@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Input Data
                </div>
                <div class="panel-body">
                    input data
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="panel panel-primary">
                <div class="panel-body">
                    <table class="table table-bordered">
                        <thead>
                            <th>Jenis Transaksi</th>
                            <th>Total Tansaksi</th>
                        </thead>
                        <tbody>
                            <tr>
                            <td>Pemasukan</td>
                            <td></td>
                            </tr>
                            <tr>
                            <td>Pengeluaran</td>
                            <td></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading"><span class="fa fa-money"></span> Catatan Keuangan</div>
                <div class="panel-body">
                <table class="table table-bordered">
                    <thead>
                        <th>No. Cek</th>
                        <th>Tanggal</th>
                        <th>Nama</th>
                        <th>Masuk</th>
                        <th>Keluar</th>
                        <th>Saldo</th>
                        <th>Opsi</th>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>1</td>
                            <td>1</td>
                            <td>1</td>
                            <td>1</td>
                            <td>1</td>
                            <td>1</td>

                        </tr>
                    </tbody>
                </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
