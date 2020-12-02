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
        <form action="{{route('transaksi.search')}}" class="page-search-form" method="GET" role="search">
            <div class="input-search input-search-dark">
              <i class="input-search-icon md-search" aria-hidden="true"></i>
              <input type="text" class="form-control" id="inputSearch" name="search" placeholder="Search Transaksi">
              <button type="button" class="input-search-close" aria-label="Close">></button>
            </div>
          </form>

          <table class="table">
            <thead>
              <tr>
                <th scope="col">No</th>
                <th scope="col">Nama Wisata</th>
                <th scope="col">Jumlah Orang</th>
                <th scope="col">Detail Harga</th>
                <th scope="col">Kode Transaksi</th>
                <th scope="col">total Harga</th>
                <th scope="col">Tanggal Beli</th>
                <th scope="col">Tanggal Berkunjung</th>
                <th scope="col">Link Invoice</th>
                <th scope="col">status</th>
                @if (auth()->user()->role == 'pengelola_wisata')
                <th scope="col">Action</th>
                @endif
              </tr>
            </thead>
            <tbody>
              @foreach ($transaksi as $i=>$t)
              @php
                $y = new \App\Http\Controllers\XenditController;
                $x = $y->invoice($t->invoice_id);
                if($x['status'] == 'SETTLED' && $t->status == 'proses'){
                  $t->update([
                    'status' => 'terbayar',
                  ]);
                }   
                if($t->batas_pembayaran <=  \Carbon\Carbon::now()->toDateString() && $t->status == 'proses'){
                  $y->expinvoice($t->invoice_id);
                  $t->update([
                    'status' => 'batal',
                  ]);

                }

              @endphp
              <tr>
                <th scope="row">{{$i+1}}</th>
                <td>{{$t->wisata->nama_wisata}}</td>
                <td>{{$t->jumlah_orang}}</td>
                <td><button type="button" data-target="#harga{{$t->id}}" data-toggle="modal" 
                  class="btn btn-block btn-primary waves-effect waves-classic">Lihat</button></td>
                <td>{{$t->kode}}</td>
                  <td>{{$t->harga->sum('harga') * $t->jumlah_orang}}</td>
              <td>{{$t->created_at->format('d-M-Y')}}</td>
              <td>{{$t->status == 'berkunjung' ? $t->updated_at->format('d-M-Y') : 'belum berkunjung'}}</td>
              <td><a href="{{$x['invoice_url']}}" target="__blank">See Invoice</a></td>  
              <td><span class="badge badge-outline badge-{{($t->status == 'proses') ? 'warning' : (($t->status == 'batal') ? 'danger' :'success')}}">{{Str::title($t->status)}}</span></td>
              @if ((auth()->user()->role == 'pengelola_wisata') && ($t->status == 'terbayar'))
              <td>
              <form onsubmit="return confirm('apakah anda yakin?')" action="{{route('transaksi.berkunjung',$t->id)}}" method="post">
              @csrf
              @method('put')
              <button type="submit" class="btn btn-primary">Berkunjung</button>  
              </form>
              </td>
              @endif
            </tr>
            @endforeach
      
            </tbody>
          </table>
              <!-- End Example Basic Sort -->
              {{$transaksi->links()}}
            </div>
          </div>
        </div>
      </div>
      <!-- End Panel Sort & Hideheader -->
      
    </div>
  </div>
  @foreach ($transaksi as $t)
  @include('transaksi.komponen.harga')
  @endforeach
@endsection
@section('footer')
<script src="{{asset('global/vendor/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js')}}"></script>
@endsection