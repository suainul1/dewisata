@extends('layouts.master',['title' => 'Tempat Wisata'])
@section('head')
<link rel="stylesheet" href="{{asset('global/vendor/magnific-popup/magnific-popup.css')}}">
<link rel="stylesheet" href="{{asset('assets/examples/css/pages/gallery.css')}}">

@endsection
@section('content')
<div class="page">
    <div class="page-header page-header-bordered page-header-tabs">
      <h1 class="page-title">Tempat Wisata</h1>
      <div class="page-header-actions">
       <form action="">
           <input type="text">
       </form>
      </div>

      <ul class="nav nav-tabs nav-tabs-line" role="tablist" id="exampleFilter">
        <li class="nav-item" role="presentation">
          <a class="active nav-link" href="#" aria-controls="exampleList" aria-expanded="true"
            role="tab" data-filter="*">All</a>
        </li>
        @php
        $a = ['budaya/sejarah','bahari','cagar alam','konvensi','agrowisata','berburuh','ziarah'];
    @endphp
    @foreach ($a as $item)
    <li class="nav-item" role="presentation">
    <a class="nav-link" href="#" aria-expanded="false" role="tab" data-filter="{{$item}}">{{Str::title($item)}}</a>
    </li>
        
    @endforeach
      </ul>
    </div>

    <div class="page-content">
      <ul class="blocks blocks-100 blocks-xxl-4 blocks-lg-3 blocks-md-2" data-plugin="filterable"
        data-filters="#exampleFilter">
        @foreach ($wisata as $w)
    <li data-type="{{$w->jenis_wisata}}">
            <div class="card card-shadow">
                <figure class="card-img-top overlay-hover overlay">
                <img class="overlay-figure overlay-scale" src="{{asset(Storage::url('gallery/'.$w->gallery->first()->foto))}}"
                    alt="...">
                    <figcaption class="overlay-panel overlay-background overlay-fade overlay-icon">
                        <a class="icon md-search" href="{{asset(Storage::url('gallery/'.$w->gallery->first()->foto))}}"></a>
                    </figcaption>
                </figure>
                <div class="card-block">
                <h4 class="card-title"><a href="{{route('etalase.show',$w->slug)}}">{{$w->nama_wisata}}</a></h4>
                </div>
            </div>
        </li>
        @endforeach
      </ul>
    </div>
  </div>
@endsection
@section('footer')
<script src="{{asset('global/vendor/isotope/isotope.pkgd.min.js')}}"></script>
<script src="{{asset('global/vendor/magnific-popup/jquery.magnific-popup.min.js')}}"></script>
<script src="{{asset('global/js/Plugin/filterable.js')}}"></script>
<script src="{{asset('assets/examples/js/pages/gallery.js')}}"></script>
@endsection