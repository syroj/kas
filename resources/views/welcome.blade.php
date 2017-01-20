@extends('layouts.layout')
@section('content')
  <div class="container-fluid">
    <hr/>
    <div class="row-fluid">
      <div class="span8">
        <div class="widget-box">
          <div class="widget-title">
            <span class="icon"><i class="icon-pencil"></i></span>
            <h5>Input Data Kas</h5>
            <ul class="nav nav-tabs">
              <li class="active"><a data-toggle="tab" href="#masuk"><i class="icon-arrow-down"></i> Pemasukan</a></li>
              <li><a data-toggle="tab" href="#keluar"><i class="icon-arrow-up"></i> Pengeluaran</a></li>
              <li><a data-toggle="tab" href="#kategori"><i class="icon-qrcode"></i> Kategori</a></li>
              <li><a href="{{url('/database')}}"><i class="icon-file"></i> DataBase</a></li>
              <li><a href="{{url('/')}}"><span class="icon-refresh"></span> Refresh</a></li>
            </ul>
          </div>
          <div class="widget-content tab-content">
            <div id="masuk" class="tab-pane active">
              <form class="form form-horizontal" method="post" action="{{url('/in')}}">
                <table class="table table-bordered">
                  <tr>
                    <td><span class="icon-file"></span> No. Cek</td>
                    <td><input type="text" name="no_cek" class="span10" value="in/{{date('y/m/d')}}/{{$in+1}}"></td>
                  </tr>
                  <tr>
                    <td><span class="icon-arrow-down"></span> Tanggal Transaksi</td>
                    <td><input type="text" name="tgl_transaksi" class="span10" placeholder="Tanggal"></td>
                  </tr>
                  <tr>
                    <td><span class="icon-arrow-down"></span> Diterima dari</td>
                    <td><input type="text" name="nama" class="span10" placeholder="Nama"></td>
                  </tr>
                  <tr>
                    <td><span class="icon-money"></span> Nominal</td>
                    <td><input type="text" name="masuk" class="span10" placeholder="Jumlah"></td>
                  </tr>
                  <tr>
                    <td><span class="icon-qrcode"></span> Kategori</td>
                    <td>
                        <select name="id_categories" class="span10">
                          @if(count($categories)>0)
                          <option value="">Pilih Kategori</option>
                          @foreach($categories as $c)
                          <option value="{{$c->id}}">{{$c->kode_kategori}}</option>
                          @endforeach
                          @else
                          <option value="">Tambah Kategori Terlebih Dahulu</option>
                          @endif
                        </select>
                    </td>
                  </tr>
                  <tr>
                    <td><span class="icon-comment-alt"></span> Keterangan</td>
                    <td><textarea class="span10" placeholder="Uraian" name="uraian"></textarea></td>
                  </tr>
                </table>
                <button id="pemasukan" class="btn btn-primary pull-right"><span class="icon"></span><i class="icon-save"></i> Simpan</button>
              </form>
            </div>
            <div id="keluar" class="tab-pane">
              <form class="form inline" method="POST" action="{{url('/keluar')}}">
                <table class="table table-bordered">
                  <tr>
                    <td><span class="icon-file"></span> No. Cek</td>
                    <td><input type="text" name="no_cek" class="span10"  value="out/{{date('y/m/d')}}/{{$out+1}}"></td>
                  </tr>
                  <tr>
                    <td><span class="icon-arrow-down"></span> Tanggal Transaksi</td>
                    <td><input type="text" name="tgl_transaksi" class="span10" placeholder="Tanggal"></td>
                  </tr>
                  <tr>
                    <td><span class="icon-arrow-up"></span> Diberikan Kepada</td>
                    <td><input type="text" name="nama" class="span10" placeholder="Nama"></td>
                  </tr>
                  <tr>
                    <td><span class="icon-money"></span> Nominal</td>
                    <td><input type="text" name="keluar" class="span10" placeholder="Jumlah"></td>
                  </tr>
                  <tr>
                    <td><span class="icon-qrcode"></span> Kategori</td>
                    <td>
                        <select name="id_categories" class="span10">
                          @if(count($categories)>0)
                          <option value="">Pilih Kategori</option>
                          @foreach($categories as $c)
                          <option value="{{$c->id}}">{{$c->kode_kategori}}</option>
                          @endforeach
                          @else
                          <option value="">Tambah Kategori Terlebih Dahulu</option>
                          @endif
                        </select>
                    </td>
                  </tr>
                  <tr>
                    <td><span class="icon-comment-alt"></span> Keterangan</td>
                    <td><textarea class="span10" placeholder="Uraian" name="uraian"></textarea></td>
                  </tr>
                </table>
                <button  id="pengeluaran" class="btn btn-warning pull-right"><span class="icon"></span><i class="icon-save"></i> Simpan</button>
              </form>
            </div>
            <div id="kategori" class="tab-pane">
              <table class="table table-bordered">
                <tr>
                  <th colspan="4">Daftar Kategori</th>
                </tr>
                <tr>
                <form class="form" method="POST" action="{{url('/addCategory')}} ">
                  <td>Tambah</td>
                  <td><input type="text" name="kode_kategori" class="span12" placeholder="kode_kategori"></td>
                  <td><input type="text" name="keterangan_kategori" class="span12" placeholder="keterangan_kategori"></td>
                  <td><button class="btn btn-default" type="submit"><span class="icon-save"></span></button></td>
                </form>
                </tr>
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
          </div>
        </div>
      </div>
      <div class="span4">
        <div class="widget-box">
          <div class="widget-title">
            <span class="icon"><i class="icon-calendar"></i> </span>
            <h5>Rincian Hari Ini ( {{date('D / d M Y')}} )</h5>
          </div>
          <div class="widget-content">
            <table class="table table-bordered">
              <tr><td style="width: 30%"><i class="icon-arrow-down"> Pemasukan</i></td><td style="text-align: right;">Rp. {{number_format($masuk,0,",",".")}}</td></tr>
              <tr><td><i class="icon-arrow-up"> Pengeluaran</i></td><td style="text-align: right;">Rp. {{number_format($keluar,0,",",".")}}</td></tr>
              <tr><td><span class="icon-money"></span> Hari Ini</td><td style="text-align: right;">Rp. {{number_format(($masuk-$keluar),0,",",".")}} </td></tr>
              <tr><td><i class="icon-inbox"> Saldo Total</i></td><td style="text-align: right;"><b>Rp. {{number_format($saldo,0,",",".")}}</b></td></tr>
            </table>
          </div>
        </div>
      </div>
    </div>
<hr/>    
    <div class="row-fluid">
      <div class="widget-box">
        <div class="widget-title">
          <span class="icon"><i class="icon-money"></i> Rp. </span>
          <h5>Laporan kas</h5>
        </div>
        <div class="widget-content">
          <table class="table table-bordered">
            <thead>
              <th>No</th>
              <th>No.Cek</th>
              <th>Nama</th>
              <th>Masuk</th>
              <th>Keluar</th>
              <th style="width: 10%;">Tanggal Transaksi</th>
              <th style="width: 15%;">Tanggal Input</th>
              <th>Opsi</th>
            </thead>
            <tbody>
            <?php
              $i=1
            ?>
            @if(count($datas)>0)
            @foreach($datas as $d)
            <tr>
              <td>{{$i++}}</td>
              <td>{{$d->no_cek}}</td>
              <td>{{$d->nama}} </td>
              <td>{{number_format(($d->masuk),0,",",".")}} </td>
              <td>{{number_format(($d->keluar),0,",",".")}} </td>
              <td>{{$d->tgl_transaksi}} </td>
              <td>{{$d->created_at}}</td>
              <td style="width: 5%;">
                <div class="btn-group pull-right">
                  <a href="{{url('detail',$d->id)}}" class="btn btn-default btn-sm"><span class="icon-file"></span></a>
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
          {{$datas->links()}}
          </div>
          </center>
        </div>
      </div>
    </div>
  </div>

@endsection