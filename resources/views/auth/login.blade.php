@include('layouts.head')
<link rel="stylesheet" href="{{asset('assets/examples/css/pages/login.css')}}">
<style>
  .page-login:before {
  background-image: url("{{asset('assets/examples/images/login.jpg')}}");
}

</style>
</head>
  <body class="animsition page-login layout-full page-dark">
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
        <p>Silahkan Login Untuk Menikmati Semua Layanan Kami:)</p>
        @error('password')
        <span class="text-danger">{{$message}}</span>
          @enderror
        <form method="POST" action="{{ route('login') }}">
            @csrf
          <div class="form-group form-material floating" data-plugin="formMaterial">
            <input type="email" class="form-control empty" id="inputEmail" name="email" value="{{ old('email') }}" required autocomplete="off" autofocus>
            <label class="floating-label" for="inputEmail">Email</label>
          </div>
          <div class="form-group form-material floating" data-plugin="formMaterial">
            <input type="password" class="form-control empty" id="inputPassword" name="password" required autocomplete="current-password">
            <label class="floating-label" for="inputPassword">Password</label>
          </div>
          <div class="form-group clearfix">
            <div class="checkbox-custom checkbox-inline checkbox-primary float-left">
              <input type="checkbox" id="inputCheckbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
              <label for="inputCheckbox">Remember me</label>
            </div>
            @if (Route::has('password.request'))
            <a class="float-right" href="{{ route('password.request') }}">Forgot password?</a>
                  @endif
          </div>
          <button type="submit" class="btn btn-primary btn-block">Sign in</button>
        </form>
        @if (Route::has('register'))
             <p>Masih Tidak Punya Akun <a href="{{ route('register') }}">Register</a></p>
                            @endif

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
</script>
</body>
</html>