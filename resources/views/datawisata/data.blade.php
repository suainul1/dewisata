@extends('layouts.master')
@section('head')
<link rel="stylesheet" href="{{asset('assets/examples/css/uikit/dropdowns.css')}}">
<link rel="stylesheet" href="{{asset('global/vendor/summernote/summernote.css')}}">
<script>
  function act(){
    var i =document.getElementById("formT");
    i.action = "{{route('wisata.konfirmasi','terima')}}";
    
    i.submit();
    
  }
</script>
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
                <th scope="col">Nama Pemilik Wisata</th>
                <th scope="col">Tanggal Publish</th>
                <th scope="col">Status</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($wisata as $i=>$w)
              <tr>
              <th scope="row">{{$i+1}}</th>
              <td>{{$w->user->name}}</td>
              <td>{{$w->created_at}}</td>
              <td><span class="badge badge-outline badge-{{($w->status == 'proses') ? 'warning' : (($w->status == 'tolak') ? 'danger' :'success')}}">{{Str::title($w->status)}}</span></td>
                <td>
                <a href="{{route('wisata.detail',$w->slug)}}"><button type="button" class="btn btn-info waves-effect waves-classic"><i class="icon md-eye" aria-hidden="true"></i>Detail</button></a>
                     <div class="dropdown" style="display: inline">
                     <button type="button" class="btn btn-{{($w->status == 'proses') ? 'warning' : (($w->status == 'tolak') ? 'danger' :'success')}} dropdown-toggle waves-effect waves-classic" id="exampleColorDropdown3" data-toggle="dropdown" aria-expanded="false"><i class="icon md-brush" aria-hidden="true"></i>{{$w->status == 'proses' ? 'Proses Pengisian' : ($w->status == 'tolak' ? 'di Tolak' :($w->status == 'terima' ? 'di Terima' :'Pengajuan'))}}</button>
                      <div class="dropdown-menu dropdown-menu-success" aria-labelledby="exampleColorDropdown3" role="menu">
                      <form id="formT" action="" method="post">
                        @csrf
                        @method('put')
                      <input type="number" name="id" hidden value="{{$w->id}}">
                      </form>
                        <a class="dropdown-item" onclick="act()" href="javascript:void(0)" role="menuitem">Terima</a>
                        <a class="dropdown-item" data-target="#prompt" data-toggle="modal" href="javascript:void(0)" role="menuitem">Tolak</a>
                       </div>
                    </div>
                     <!-- Modal ktp-->
         <div class="modal fade modal-fall" id="prompt" aria-hidden="true" aria-labelledby="exampleModalTitle"
         role="dialog" tabindex="-1">
         <div class="modal-dialog modal-simple">
           <div class="modal-content">
             <div class="modal-header">
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                 <span aria-hidden="true">×</span>
               </button>
               <h4 class="modal-title">Anda Yakin Ingin Menolak</h4>
             </div>
             <div class="modal-body">
             <form action="{{route('wisata.konfirmasi')}}" method="post">
               @csrf
               @method('put')
               <input type="number" name="id" hidden value="{{$w->id}}">
               <div class="form-group form-material" data-plugin="formMaterial">
                <label class="form-control-label" for="textarea">Alasan Ditolak</label>
                <textarea id="summernote" data-plugin="summernote" class="form-control" id="textarea" name="pesan" rows="3"></textarea>
              </div>
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-primary">Kirim</button>
            </form>
              <button type="button" class="btn btn-default btn-pure" data-dismiss="modal">Close</button>
             </div>
           </div>
         </div>
       </div>
       <!-- End Modal -->
                </td>
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
<script src="{{asset('global/vendor/summernote/summernote.min.js')}}"></script>
<script src="{{asset('global/js/Plugin/summernote.js')}}"></script>
    
<script src="{{asset('assets/examples/js/forms/editor-summernote.js')}}"></script>
<script src="{{asset('global/js/Plugin/input-group-file.js')}}"></script>
@endsection