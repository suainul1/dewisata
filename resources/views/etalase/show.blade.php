@extends('layouts.master',['title'=> $w->nama_wisata])
@section('head')
<link rel="stylesheet" href="{{asset('assets/examples/css/pages/email.css')}}">
@endsection
@section('content')

<div class="page">
    <div class="page-content">
      <!-- Panel -->
      <div class="panel">
        <div class="panel-body container-fluid">
          
          <div class="card">
            <div class="card-block px-0">
              <div class="card mb-0">
                <div class="row justify-content-md-center">
                  @foreach ($w->gallery as $g)
                      
                  <div class="col-md-5 m-2" style="border: 5px solid gray;border-radius: 30px;">
                  <img style="width:100%;height:200px" src="{{asset(Storage::url('gallery/'.$g->foto))}}" alt="">
                  </div>
                  @endforeach
                </div>
                <div class="card-block px-0">
                  <h3 class="card-title">{{ $w->nama_wisata}}</h3>
                  <p class="card-text">
                    <small>{{$w->created_at->format('d-M-Y')}}</small>
                    <small>Lokasi: {{$w->alamat_wisata}}</small>
                    @if (auth()->user()->role == 'admin')
                    <small>Nama Pemilik: {{$w->user->name}}</small>
                    @endif
                  </p>
                  {!! $w->deskripsi_wisata !!}
                </div>
                <div class="card-block p-0">
                  <h4>Jam Operasional:</h4>
                <p>{{$w->jam_operasional}}</p>
                  </div>
                  @if (auth()->user()->role == 'admin')
                      
                  
                  <div class="card-block p-0">
                    <h4>Harga Tiket:</h4>
                    <table class="table">
                      <thead>
                        <tr>
                          <th scope="col">#</th>
                          <th scope="col">Jenis Tiket</th>
                          <th scope="col">Harga</th>
                        </tr>
                      </thead>
                      <tbody>
                          @foreach ($w->tiket as $ii=>$h)
                          <tr>
                              <th scope="row">{{$ii+1}}</th>
                              <td>{{$h->nama}}</td>
                              <td>{{$h->harga}}</td>
                              </tr>
                              @endforeach
                              <tr>
                                <td><b>PPN:5%</b></td>
                              </tr>
                              <tr>
                                <td><b>Kapasitas Harian: {{$w->kapasitas}}</b></td>
                              </tr>
                                
                      </tbody>
                    </table>
                    </div>
                    @endif
                    @if (auth()->user()->role != 'admin')
                  <div class="card-block p-0 text-center">
                  <a href="{{route('etalase.setPrice',$w->slug)}}"><button class="btn btn-primary">Checkout</button></a>
                    </div>
                    @endif
                <div class="card-block px-0 clearfix">
                  
                  <div class="card-actions float-right">
                    <a href="javascript:void(0)">
                  <i class="icon md-share"></i>
                </a>
                    <a href="javascript:void(0)">
                  <i class="icon md-favorite"></i>
                  <span>63</span>
                </a>
                    <a href="javascript:void(0)">
                  <i class="icon md-comment"></i>
                  <span>26</span>
                </a>
                  </div>
                </div>
                <div class="card-block px-0">
                  <h3 class="card-heading">
                    Comments
                  </h3>
                  <div class="card-block p-0">
                    <div class="media">
                      <div class="pr-20">
                        <a class="avatar" href="#">
                          <img class="img-responsive" src="../../../global/portraits/1.jpg" alt="..." />
                        </a>
                      </div>
                      <div class="media-body">
                        <div class="mt-0 mb-5" href="#">
                          Herman Beck
                          <small>Yesterday at 12:30AM</small>
                        </div>
                        <small>Officia qui commodo ad dolor. Sit nisi minim aute deserunt
                          quis. Cupidatat ea officia in proident non. Mollit
                          id sit aliqua laborum. Officia labore dolor irure amet.
                          Excepteur eu sit ullamco duis sunt anim consectetur.
                          Id aute non amet culpa pariatur officia.</small>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="email-more mt-0">
            <p>You are currently signed up to Company’s newsletters as: youremail@gmail.com
              to <a class="email-unsubscribe" href="javascript:void(0)">unsubscribe</a></p>
            <div class="email-more-social">
              <a href="javascript:void(0)"><i class="icon bd-twitter" aria-hidden="true"></i></a>
              <a href="javascript:void(0)"><i class="icon bd-facebook" aria-hidden="true"></i></a>
              <a href="javascript:void(0)"><i class="icon bd-linkedin" aria-hidden="true"></i></a>
              <a href="javascript:void(0)"><i class="icon bd-pinterest" aria-hidden="true"></i></a>
            </div>
          </div>
        </div>
      </div>
      <!-- End panel -->
    </div>
  </div>


@endsection