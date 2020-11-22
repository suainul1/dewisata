@include('layouts.head')
<link rel="stylesheet" href="{{asset('assets/examples/css/pages/register.css')}}">
<style>
  .page-login:before {
  background-image: url("{{asset('assets/examples/images/login.jpg')}}");
}

</style>
</head>
  <body class="animsition page-register layout-full page-dark">
    <!--[if lt IE 8]>
        <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
    <![endif]-->


    <!-- Page -->
    <div class="page vertical-align text-center" data-animsition-in="fade-in" data-animsition-out="fade-out">>
      <div class="page-content vertical-align-middle">
        <div class="brand">
          <img class="brand-img" style="width: 6vh" src="{{asset('assets/images/logo.png')}}" alt="...">
          <h2 class="brand-text">Dewisata</h2>
        </div>
        <p>Silahkan Registrasi</p>
        <form method="POST" role="form" action="{{ route('register') }}" enctype="multipart/form-data">
            @csrf
            <div class="checkbox-custom checkbox-primary">
              <input type="checkbox" name="check" id="ch">
              <label for="ch">Sebagai Pemilik Wisata</label>
            </div>
            <div class="form-group form-material floating" data-plugin="formMaterial">
            <input type="text" class="form-control empty @error('name') is-invalid @enderror" id="inputName" name="name" value="{{ old('name') }}" required autocomplete="off" autofocus>
            <label class="floating-label" for="inputName">Name</label>
            @error('name')
            <div class="invalid-feedback">
              {{$message}}
            </div>
            @enderror
          </div>
          <div class="form-group form-material floating" data-plugin="formMaterial">
            <input type="email" class="form-control empty @error('email') is-invalid @enderror" id="inputEmail" name="email" value="{{ old('email') }}" required autocomplete="off">
            <label class="floating-label" for="inputEmail">Email</label>
            @error('email')
            <div class="invalid-feedback">
              {{$message}}
            </div>
            @enderror
          </div>
          <div class="form-group form-material floating" data-plugin="formMaterial">
            <textarea class="form-control empty @error('alamat') is-invalid @enderror" rows="3" name="alamat" required>{{old('alamat')}}</textarea>
            <label class="floating-label">Alamat</label>
            @error('alamat')
            <div class="invalid-feedback">
              {{$message}}
            </div>
            @enderror
          </div>
        
          <div class="form-group form-material @error('tanggal_lahir') has-danger @enderror" data-plugin="formMaterial">
            <label class="form-control-label" for="tanggal_lahir">Tanggal Lahir</label>
            <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir">
            @error('tanggal_lahir')
            <div class="invalid-feedback">
              {{$message}}
            </div>
            @enderror
          </div>
          <div class="form-group form-material floating" data-plugin="formMaterial">
            <input type="text" class="form-control empty @error('no_hp') is-invalid @enderror" id="no_hp" name="no_hp" value="{{ old('no_hp') }}" required autocomplete="off">
            <label class="floating-label" for="no_hp">Nomor Handphone</label>
            @error('no_hp')
            <div class="invalid-feedback">
              {{$message}}
            </div>
            @enderror
          </div>
          <div id="pw">
          <div class="form-group form-material floating" data-plugin="formMaterial">
            <input type="text" class="form-control empty @error('nik') is-invalid @enderror" id="nik" name="nik" value="{{ old('nik') }}" autocomplete="off">
            <label class="floating-label" for="nik">Nomor Induk Kependudukan</label>
            @error('nik')
            <div class="invalid-feedback">
              {{$message}}
            </div>
            @enderror
          </div>
          <div class="form-group form-material floating form-material-file @error('scan_ktp') has-danger @enderror" data-plugin="formMaterial">
            <input type="text" class="form-control empty" readonly="">
            <input type="file" name="scan_ktp">
            <label class="floating-label">Scan Ktp</label>
            @error('scan_ktp')
            <div class="invalid-feedback">
              {{$message}}
            </div>
            @enderror
          </div>
        </div>
          <div class="form-group form-material floating" data-plugin="formMaterial">
            <input type="password" class="form-control empty @error('password') is-invalid @enderror" id="inputPassword" name="password" required autocomplete="new-password">
            <label class="floating-label" for="inputPassword">Password</label>
            @error('password')
            <div class="invalid-feedback">
              {{$message}}
            </div>
            @enderror
          </div>
          <div class="form-group form-material floating" data-plugin="formMaterial">
            <input type="password" class="form-control empty" id="inputPasswordCheck" name="password_confirmation" required autocomplete="new-password">
            <label class="floating-label" for="inputPasswordCheck">Ulangi Password</label>
          </div>
          <div class="form-group form-material floating @error('jenis_kelamin') has-danger @enderror" data-plugin="formMaterial">
            <select name="jenis_kelamin" class="form-control">
              <option value="pria">Laki-Laki</option>
              <option value="wanita">Perempuan</option>
            </select>
            <label class="floating-label">Jenis Kelamin</label>
            @error('jenis_kelamin')
            <div class="invalid-feedback">
              {{$message}}
            </div>
            @enderror
          </div>
         
          <button type="submit" class="btn btn-primary btn-block">Register</button>
        </form>
        <footer class="page-copyright page-copyright-inverse">
          <p>Kelompok G PPL C</p>
          <p>© 2020. All RIGHT RESERVED.</p>
          <div class="social">
            <a class="btn btn-icon btn-pure" href="javascript:void(0)">
          <i class="icon bd-twitter" aria-hidden="true"></i>
        </a>
            <a class="btn btn-icon btn-pure" href="javascript:void(0)">
          <i class="icon bd-facebook" aria-hidden="true"></i>
        </a>
            <a class="btn btn-icon btn-pure" href="javascript:void(0)">
          <i class="icon bd-google-plus" aria-hidden="true"></i>
        </a>
          </div>
        </footer>
      </div>
    </div>
    <!-- End Page -->


@include('layouts.jscore')
<script>
  (function(document, window, $){
    'use strict';

    var Site = window.Site;
    $(document).ready(function(){
      Site.run();
    });
  })(document, window, jQuery);

  $('#pw').hide();

$('#ch').click(function(){
  if($('#ch:checked').val() == 'on'){
    $('#pw').show();
  }else{
    $('#pw').hide();
    
  }
});
</script>
</body>
</html>