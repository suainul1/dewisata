@extends('layouts.master',['title' => 'MyProfile | '.$user->name])
@section('head')
<link rel="stylesheet" href="{{asset('assets/examples/css/uikit/modals.css')}}">
@endsection
@section('content')
<div class="page">
    <div class="page-content container-fluid">
<div class="row justify-content-center">
<div class="col-md-6 col-sm-12">
    <div class="card">
      <img style="height: 350px" class="card-img-top img-fluid w-full" src="{{asset(Storage::url(is_null($user->avatar) ? 'user/profile/placeholder.png' : 'avatar/'.$user->avatar))}}"
        alt="Card image cap">
      <div class="card-block">
      <h4 class="card-title text-center">{{$user->name}}</h4>
      <p class="card-text text-center">Tanggal dibuat: {{$user->created_at}}</p>
      </div>
      <ul class="list-group list-group-dividered px-20 mb-0">
      <li class="list-group-item px-0">Hak Akses : {{$user->role}}</li>
      @if ($user->role == "pengelola_wisata")
      <li class="list-group-item px-0">Nik : {{$user->wisata->nik}}</li>
      @endif
      <li class="list-group-item px-0">Email : {{$user->email}}</li>
      <li class="list-group-item px-0">Alamat : {{$user->alamat}}</li>
      <li class="list-group-item px-0">No Handphone : {{$user->no_hp}}</li>
      <li class="list-group-item px-0">Tanggal lahir : {{$user->tanggal_lahir}}</li>
      <li class="list-group-item px-0">jenis Kelamin : {{Str::title($user->jenis_kelamin)}}</li> 
    </ul>
    <div class="card-block">
      @if ($user->role == "pengelola_wisata")
            
        <a href="javascript:void(0)" data-target="#ktp" data-toggle="modal" class="card-link">Lihat KTP</a>
         <!-- Modal ktp-->
         <div class="modal fade modal-fall" id="ktp" aria-hidden="true" aria-labelledby="exampleModalTitle"
         role="dialog" tabindex="-1">
         <div class="modal-dialog modal-simple">
           <div class="modal-content">
             <div class="modal-header">
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                 <span aria-hidden="true">×</span>
               </button>
               <h4 class="modal-title">Foto KTP</h4>
             </div>
             <div class="modal-body">
              <img class="img-rounded img-bordered img-bordered-primary" src="{{asset(Storage::url('ktp/'.$user->wisata->scan_ktp))}}" alt="Tidak Ada Ktp" style="width:100%">
             </div>
             <div class="modal-footer">
                 
               <button type="button" class="btn btn-default btn-pure" data-dismiss="modal">Close</button>
             </div>
           </div>
         </div>
       </div>
       <!-- End Modal -->

       @endif
      @if ($user->id == auth()->user()->id)
        <a href="javascript:void(0)" data-target="#exampleNiftyFall" id="myButton" data-toggle="modal" class="card-link ml-2">Edit</a>
        
        <!-- Modal edit-->
        <div class="modal fade modal-fall" id="exampleNiftyFall" aria-hidden="true" aria-labelledby="exampleModalTitle"
        role="dialog" tabindex="-1">
        <div class="modal-dialog modal-simple">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
              </button>
              <h4 class="modal-title">Edit Profile</h4>
            </div>
            <div class="modal-body">
            <form action="{{route('user.update')}}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="form-group form-material @error('nama') has-danger @enderror" data-plugin="formMaterial">
                    <label class="form-control-label" for="inputText">Nama</label>
                <input type="text" class="form-control" id="inputText" value="{{$user->name}}" name="nama" placeholder="Nama">
                @error('nama')
            <span class="text-danger">{{$message}}</span>
            @enderror
                  </div>
              <div class="form-group form-material @error('email') has-danger @enderror" data-plugin="formMaterial">
                <label class="form-control-label" for="inputText">E-mail</label>
            <input type="email" class="form-control" id="inputText" value="{{$user->email}}" name="email" placeholder="E-mail">
            @error('email')
        <span class="text-danger">{{$message}}</span>
        @enderror
              </div>
              <span class="text-danger">Jika Tidak ingin mengganti password harap tidak diisi</span>
              <div class="form-group form-material @error('old_password') has-danger @enderror" data-plugin="formMaterial">
                <label class="form-control-label" for="inputPassword">Password lama</label>
                <input type="password" class="form-control" id="inputPassword" name="old_password" placeholder="Password">
                @error('old_password')
            <span class="text-danger">{{$message}}</span>
            @enderror
              </div>
              <div class="form-group form-material @error('password') has-danger @enderror" data-plugin="formMaterial">
                <label class="form-control-label" for="inputPassword">Password</label>
                <input type="password" class="form-control" id="inputPassword" name="password" placeholder="Password">
                @error('password')
                <span class="text-danger">{{$message}}</span>
                @enderror
              </div>
              <div class="form-group form-material" data-plugin="formMaterial">
                <label class="form-control-label" for="inputPassword">Ulangi Password</label>
                <input type="password" class="form-control" id="inputPassword" name="password_confirmation" placeholder="Password">
              </div>
              <div class="form-group form-material @error('alamat') has-danger @enderror" data-plugin="formMaterial">
                <label class="form-control-label" for="textarea">Alamat</label>
              <textarea class="form-control" id="textarea" name="alamat" rows="3">{{$user->alamat}}</textarea>
                @error('alamat')
                <span class="text-danger">{{$message}}</span>
              
              @enderror
              </div>
              <div class="form-group form-material @error('no_hp') has-danger @enderror" data-plugin="formMaterial">
                <label class="form-control-label" for="inputText">No Handphone</label>
            <input type="text" class="form-control" id="inputText" value="{{$user->no_hp}}" name="no_hp" placeholder="No Handphone">
            @error('no_hp')
        <span class="text-danger">{{$message}}</span>
        @enderror
              </div>
              <div class="form-group form-material @error('tanggal_lahir') has-danger @enderror" data-plugin="formMaterial">
                <label class="form-control-label" for="inputText">Tanggal Lahir</label>
            <input type="date" class="form-control" id="inputText" value="{{$user->tanggal_lahir}}" name="tanggal_lahir" placeholder="No Handphone">
            @error('tanggal_lahir')
        <span class="text-danger">{{$message}}</span>
        @enderror
              </div>
              <div class="form-group form-material floating @error('jenis_kelamin') has-danger @enderror" data-plugin="formMaterial">
                <select name="jenis_kelamin" class="form-control">
                  <option value="pria" {{$user->jenis_kelamin == 'pria' ? 'selected' : null}}>Laki-Laki</option>
                  <option value="wanita" {{$user->jenis_kelamin == 'wanita' ? 'selected' : null}}>Perempuan</option>
                </select>
                <label class="floating-label">Jenis Kelamin</label>
                @error('jenis_kelamin')
                <div class="invalid-feedback">
                  {{$message}}
                </div>
                @enderror
              </div>
              <div class="form-group form-material form-material-file @error('image') has-danger @enderror" data-plugin="formMaterial">
                <label class="form-control-label" for="inputFile">Foto Profile</label>
                <input type="text" class="form-control" placeholder="Browse.." readonly="">
                <input type="file" id="inputFile" name="image">
                @error('image')
                <span class="text-danger">{{$message}}</span>
              
              @enderror
              </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Save changes</button>
            </form>
              <button type="button" class="btn btn-default btn-pure" data-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>
      <!-- End Modal -->
      @endif
      </div>
    </div>
  </div>
</div>
    </div>
</div>    
@endsection
@section('footer')
    <script>
       @if($errors->any())
      window.onload = function(){
      var button = document.getElementById('myButton');
    button.click();
      }
      @endif
    </script>
@endsection