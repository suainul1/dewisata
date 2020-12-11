@extends('layouts.master',['title'=> $w->nama_wisata])
@section('head')
<link rel="stylesheet" href="{{asset('assets/examples/css/pages/email.css')}}">
<script>

  function balas(id){
    if(document.getElementById(`komen-${id}`).style.display == 'none'){
        document.getElementById(`komen-${id}`).style.display = "inline";
    }else{
      document.getElementById(`komen-${id}`).style.display = "none";

    }
        }
</script>
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
                    @php
                        $cm = $cm ?? null;
                    @endphp
                    @if (auth()->user()->role != 'admin' && is_null($cm))
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
             <hr>
         
                  <!-- Panel Comments Full -->
                @if (!is_null($cm))
                <div class="comments mx-20">
                  <h3>Forum</h3>
                  @foreach ($komentar as $k)
                      
                  <div class="comment media">
                    <div class="pr-20">
                      <a class="avatar avatar-lg" href="javascript:void(0)">
                        <img src="{{asset(Storage::url(is_null($k->user->avatar) ? '1.jpg' : 'avatar/'.$k->user->avatar))}}" alt="...">
                      </a>
                    </div>
                    <div class="media-body">
                      <div class="comment-body">
                      <a class="comment-author" href="javascript:void(0)">{{$k->user->name}}</a>
                        <div class="comment-meta">
                        <span class="date">{{$k->created_at->diffForHumans()}} at {{$k->created_at->format('H:i')}}</span>
                        </div>
                        <div class="comment-content">
                        <p>{{$k->isi}}</p>
                        </div>
                        
                        @if ($k->user_id == auth()->user()->id)
                        @include('etalase.komponen.editKomen')
                        @endif
                        <div class="comment-actions">

                          @if ($k->user_id == auth()->user()->id)
                        <a href="javascript:void(0)" data-target="#editKomen{{$k->id}}" data-toggle="modal" role="button">Edit</a>
                        @endif  
                        <a href="javascript:void(0)" onclick="balas({{$k->id}})" role="button">Balas</a>
                        </div>
                      </div>
                      <div class="comments">
                       {{-- kb --}}
                       @foreach ($k->balasan as $b)
                           
                       <div class="comment media">
                         <div class="pr-20">
                           <a class="avatar avatar-lg" href="javascript:void(0)">
                             <img src="{{asset(Storage::url(is_null($b->user->avatar) ? '1.jpg' : 'avatar/'.$b->user->avatar))}}" alt="...">
                            </a>
                          </div>
                          <div class="comment-body media-body">
                          <a class="comment-author" href="javascript:void(0)">{{$b->user->name}}</a>
                            <div class="comment-meta">
                              <span class="date">{{$b->created_at->diffForHumans()}}</span>
                            </div>

                            <div class="comment-content">
                            <p>{{$b->isi}}</p>
                            </div>
                            
                            @if ($b->user_id == auth()->user()->id)
                        @include('etalase.komponen.editBalas')
                        @endif
                            <div class="comment-actions">
                              @if ($b->user_id == auth()->user()->id)
                              <a href="javascript:void(0)" data-target="#editBalas{{$b->id}}" data-toggle="modal" role="button">Edit</a>
                                  
                              @endif
                            </div>
                          </div>
                        </div>
                        @endforeach
                     {{-- kb --}}
                     <div id="komen-{{$k->id}}" style="display: none">
                     <form class="comment-reply" action="{{route('komentar.balas',$k->id)}}" method="post">
                      @csrf
                         <div class="form-group">
                           <textarea class="form-control" name="balas" rows="5" placeholder="Comment here"></textarea>
                          </div>
                                  <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Balas Komentar</button>
                                  <button onclick="balas({{$k->id}})" type="button" class="btn btn-link grey-600">close</button>
                                  </div>
                                </form>
                              </div>
                              </div>
                            </div>
                          </div>
                        @endforeach
                          <form class="comments-add mt-35" action="{{route('komentar.create',$w->id)}}" method="post">
                            <h3 class="mb-35">Tinggalkan Komentar</h3>
                            @csrf
                    <div class="form-group">
                    <textarea name="isi" required class="form-control" rows="5" placeholder="Comment here"></textarea>
                  </div>
                  <div class="form-group">
                    <button type="submit" class="btn btn-primary">Comment</button>
                   </div>
                  </form>
                </div>
                    
                @endif
        
        <!-- End Panel Comments Full -->
        
            </div>
          </div>
        </div>
      </div>
      <!-- End panel -->
    </div>
  </div>


@endsection
