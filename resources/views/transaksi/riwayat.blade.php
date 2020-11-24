@extends('layouts.master')
@section('head')
<link rel="stylesheet" href="{{asset('assets/examples/css/uikit/dropdowns.css')}}">
@endsection
@section('content')
<div class="page">
    <div class="page-content">
      
      <!-- Panel Sort & Hideheader -->
      <div class="panel">
        <div class="panel-heading">
          <h3 class="panel-title">Data Wisata</h3>
        </div>
        <div class="panel-body">
          <table class="table">
            <thead>
              <tr>
                <th scope="col">No</th>
                <th scope="col">Nama Wisata</th>
                <th scope="col">Jumlah Orang</th>
                <th scope="col">Detail Harga</th>
                <th scope="col">total Harga</th>
                <th scope="col">Tanggal Beli</th>
                <th scope="col">Tanggal Berkunjung</th>
                <th scope="col">Link Invoice</th>
                <th scope="col">status</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($transaksi as $i=>$t)
              <tr>
              <th scope="row">{{$i+1}}</th>
              <td>{{$t->wisata->nama_wisata}}</td>
              <td>{{$t->jumlah_orang}}</td>
              <td><button type="button"
                class="btn btn-block btn-primary waves-effect waves-classic">Lihat</button></td>
              <td>{{$t->harga->sum('harga') * $t->jumlah_orang}}</td>
              <td>{{$t->created_at->format('d-M-Y')}}</td>
              <td>{{$t->status == 'berkunjung' ? $t->updated_at->format('d-M-Y') : 'belum berkunjung'}}</td>
              <td>{{$t->invoice}}</td>  
                <td><span class="badge badge-outline badge-{{($t->status == 'proses') ? 'warning' : (($t->status == 'batal') ? 'danger' :'success')}}">{{Str::title($t->status)}}</span></td>
            </tr>
              @endforeach
      
            </tbody>
          </table>
              <!-- End Example Basic Sort -->
            </div>
          </div>
        </div>
      </div>
      <!-- End Panel Sort & Hideheader -->

    </div>
</div>
@endsection
@section('footer')
<script src="{{asset('global/vendor/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js')}}"></script>
@endsection