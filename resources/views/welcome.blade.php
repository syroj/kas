@extends('layouts.layout')
@section('content')
  <div class="container-fluid">
    <hr/>
    <div class="row-fluid">
      <div class="span8">
        <div class="widget-box">
          <div class="widget-title">
            <span class="icon"><i class="icon-pencil"></i></span>
            <h5>Input Jurnal</h5>
            <ul class="nav nav-tabs">
              <li class="active"><a data-toggle="tab" href="#masuk"><i class="icon-arrow-down"></i> Pemasukan</a></li>
              <li><a data-toggle="tab" href="#keluar"><i class="icon-arrow-up"></i> Pengeluaran</a></li>
              <li><a data-toggle="tab" href="#kategori"><i class="icon-qrcode"></i> Jurnal</a></li>
              <li><a data-toggle="tab" href="#client"><i class="icon-user"></i> client</a></li>
              <li><a data-toggle="tab" href="#buku"><i class="icon-book"></i> Buku Besar</a></li>
              <li><a href="{{url('/database')}}"><i class="icon-file"></i> DataBase</a></li>
              <li><a href="{{url('/')}}"><span class="icon-refresh"></span> Refresh</a></li>
            </ul>
          </div>
          <div class="widget-content tab-content">
            <div id="masuk" class="tab-pane active">
              <form class="form form-horizontal" method="post" action="{{url('/jurnal_masuk')}}">
                <table class="table table-bordered">
                  <tr>
                    <td><span class="icon-file"></span> No. Cek</td>
                    <td colspan="4"><input type="text" name="no_cek" class="span12" placeholder="No Cek"></td>
                  </tr>
                  <tr>
                    <td><span class="icon-calendar"></span> Tanggal Transaksi</td>
                    <td colspan="4"><input type="text" name="tgl_transaksi" class="span12" placeholder="Tanggal (dd-mm-yyyy)"></td>
                  </tr>
                  <tr>
                    <td><span class="icon-user"></span> Pilih client</td>
                    <td colspan="3">
                    <select class="span12" name="kode_client">
                      @if(count($clients)>0)
                      <option>Pilih Client</option>
                      @foreach($clients as $c)
                      <option value="{{$c->kode_client}}">{{$c->nama_client}} </option>
                      @endforeach
                      @else
                      <option>Tambah client terlebih dahulu</option>
                      @endif
                    </select>
                    </td>
                  </tr>
                  <tr>
                    <td><span class="icon-search"></span> Perkiraan</td>
                    <td><input type="text" name="perkiraan" class="span12" placeholder="Perkiraan"></td>
                    <td><span class="icon-user"></span> Nama Perkiraan</td>
                    <td ><input type="text" name="nama_perkiraan" class="span12" placeholder="Perkiraan"></td>
                  </tr>
                  <tr>
                    <td>Debet</td>
                    <td><input type="text" name="debet" class="span12" placeholder="Debet"  style="text-align: right;"></td>
                    <td>Kredit</td>
                    <td><input type="text" name="kredit" class="span12" placeholder="Kredit"  style="text-align: right;"></td>
                  </tr>
                  <tr>
                    <td><span class="icon-qrcode"></span> Jurnal</td>
                    <td colspan="4">
                        <select name="id_categories" class="span12">
                          @if(count($categories)>0)
                          <option value="">Pilih Jurnal</option>
                          @foreach($categories as $c)
                          <option value="{{$c->id}}">{{$c->kode_kategori}}</option>
                          @endforeach
                          @else
                          <option value="">Tambah Jurnal Terlebih Dahulu</option>
                          @endif
                        </select>
                    </td>
                  </tr>
                  <tr>
                    <td><span class="icon-comment-alt"></span> Keterangan</td>
                    <td colspan="4"><textarea class="span12" placeholder="Uraian" name="uraian"></textarea></td>
                  </tr>
                </table>
                <button id="pemasukan" class="btn btn-primary pull-right"><span class="icon"></span><i class="icon-save"></i> Simpan</button>
              </form>
            </div>
            <div id="keluar" class="tab-pane">
              <form class="form form-horizontal" method="post" action="{{url('/jurnal_keluar')}}">
                <table class="table table-bordered">
                  <tr>
                    <td><span class="icon-file"></span> No. Cek</td>
                    <td colspan="4"><input type="text" name="no_cek" class="span12" placeholder="No Cek"></td>
                  </tr>
                  <tr>
                    <td><span class="icon-calendar"></span> Tanggal Transaksi</td>
                    <td colspan="4"><input type="text" name="tgl_transaksi" class="span12" placeholder="Tanggal (dd-mm-yyyy)"></td>
                  </tr>
                  <tr>
                    <td><span class="icon-user"></span> Pilih client</td>
                    <td colspan="3">
                    <select class="span12" name="kode_client">
                      @if(count($clients)>0)
                      <option>Pilih Client</option>
                      @foreach($clients as $c)
                      <option value="{{$c->kode_client}}">{{$c->nama_client}} </option>
                      @endforeach
                      @else
                      <option>Tambah client terlebih dahulu</option>
                      @endif
                    </select>
                    </td>
                  </tr>
                  <tr>
                    <td><span class="icon-search"></span> Perkiraan</td>
                    <td><input type="text" name="perkiraan" class="span12" placeholder="Perkiraan"></td>
                    <td><span class="icon-user"></span> Nama Perkiraan</td>
                    <td ><input type="text" name="nama_perkiraan" class="span12" placeholder="Perkiraan"></td>
                  </tr>
                  <tr>
                    <td>Debet</td>
                    <td><input type="text" name="debet" class="span12" placeholder="Debet"  style="text-align: right;"></td>
                    <td>Kredit</td>
                    <td><input type="text" name="kredit" class="span12" placeholder="Kredit"  style="text-align: right;"></td>
                  </tr>
                  <tr>
                    <td><span class="icon-qrcode"></span> Jurnal</td>
                    <td colspan="4">
                        <select name="id_categories" class="span12">
                          @if(count($categories)>0)
                          <option value="">Pilih Jurnal</option>
                          @foreach($categories as $c)
                          <option value="{{$c->id}}">{{$c->kode_kategori}}</option>
                          @endforeach
                          @else
                          <option value="">Tambah Jurnal Terlebih Dahulu</option>
                          @endif
                        </select>
                    </td>
                  </tr>
                  <tr>
                    <td><span class="icon-comment-alt"></span> Keterangan</td>
                    <td colspan="4"><textarea class="span12" placeholder="Uraian" name="uraian"></textarea></td>
                  </tr>
                </table>
                <button id="pemasukan" class="btn btn-warning pull-right"><span class="icon"></span><i class="icon-save"></i> Simpan</button>
              </form>
            </div>
            <div id="kategori" class="tab-pane">
              <table class="table table-bordered">
                <tr>
                  <th colspan="4">Daftar Jurnal</th>
                </tr>
                <tr>
                <form class="form" method="POST" action="{{url('/addCategory')}} ">
                  <td>Tambah</td>
                  <td><input type="text" name="kode_kategori" class="span12" placeholder="kode Jurnal"></td>
                  <td><input type="text" name="keterangan_kategori" class="span12" placeholder="keterangan Jurnal"></td>
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
            <div id="client" class="tab-pane">
              <table class="table table-bordered">
              <form class="form" method="post" action="{{url('addclient')}}">
              {{csrf_field()}}
                  <th colspan="4">Tambah client</th>
                  <tr>
                    <td>Kode client</td>
                    <td><input type="text" name="kode_client" class="span12" placeholder="kode_client"></td>
                    <td>Nama client</td>
                    <td><input type="text" name="nama_client" class="span12" placeholder="nama_client"></td>
                  </tr>
                  <tr>
                    <td>Kontak client</td>
                    <td colspan="3">
                      <textarea class="span12" name="kontak_client"></textarea>
                    </td>
                  </tr>
                  <tr>
                    <td colspan="4">
                      <button type="submit" class="btn btn-default pull-right"><span class="icon-save"></span>Simpan</button>
                    </td>
                  </tr>
              </form>
              <th colspan="4">Data Client</th>
              <tr>
                <th>Kode</th>
                <th>Nama</th>
                <th>Kontak</th>
                <th>Opsi</th>
              </tr>
              @if(count($clients)>0)
              @foreach($clients as $c)
                <tr>
                  <td>{{$c->kode_client}}</td>
                  <td>{{$c->nama_client}}</td>
                  <td>{{$c->kontak_client}}</td>
                  <td>
                    <div class="btn-group pull-right">
                      <a href="{{url('/client',$c->id)}}" class="btn btn-default"><span class="icon-folder-open"></span></a>
                      <a href="" class="btn btn-warning"><span class="icon-pencil"></span></a>
                      <a href="" class="btn btn-danger"><span class="icon-trash"></span></a>
                    </div>
                  </td>
                </tr>
              @endforeach
              @else
              @endif
              </table>
            </div>
            <div class="tab-pane" id="buku">
              Buku besar
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
            <select name="ktg" id="ktg" class="span12">
              <option>Semua</option>
              @foreach($categories as $c)
              <option>{{$c->kode_kategori}}</option>
              @endforeach
            </select>
            <br/>
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
              <th>Saldo</th>
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
              <td>{{number_format(($d->saldo),0,",",".")}} </td>
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
                <td colspan="9" style="text-align: center;">Belum Ada Data Tersedia</td>
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