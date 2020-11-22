@extends('layouts.master')
@section('head')

@endsection
@section('content')
<div class="page">
    <div class="page-content">
        <div class="page-content container-fluid">
          <div class="panel">
            <div class="panel-heading">
              <div class="text-center">
                <button class="btn btn-{{$w->status == 'peroses' ? 'warning' :($w->status == 'pengajuan' ? 'info' : 'danger')}} rounded-circle"><i class="icon md-refresh-alt" aria-hidden="true"></i></button>
                <h3 class="text-{{$w->status == 'peroses' ? 'warning' :($w->status == 'pengajuan' ? 'info' : 'danger')}} panel-title">{{$w->status == 'peroses' ? 'Pengisian Form' :($w->status == 'pengajuan' ? 'Pengajuan' : 'Pengulangan Pengisian Form')}} Wisata</h3>
              </div>
            </div>
            <div class="panel-body container-fluid">
            <form autocomplete="off" action="{{route('wisata.pengajuan')}}" method="POST" enctype="multipart/form-data">
              @csrf
                <div class="form-group form-material" data-plugin="formMaterial">
                  <label class="form-control-label" for="nama">Nama Tempat Wisata</label>
                <input type="text" class="form-control" {{$w->status == 'pengajuan' ? 'readonly' : null}} id="nama" name="nama_wisata" placeholder="Nama Tempat Wisata" value="{{$w->nama_wisata}}">
                </div>
                <label data-target="#imgmod" data-toggle="modal" class="text-warning" style="cursor: pointer" for="">Lihat gallery foto/priview foto</label>
                <div class="form-group form-material form-material-file" data-plugin="formMaterial">
                  <label class="form-control-label" for="image">Gambar wisata(bisa lebi dari satu gambar)</label>
                  <input type="text" class="form-control" placeholder="Browse.." readonly="">
                  <input type="file" id="image" readonly name="image[]" multiple="">
                </div>
                <label data-target="#modform" data-toggle="modal" class="text-warning" style="cursor: pointer" for="">Baca Aturan Dokumen</label>
                <div class="form-group form-material form-material-file" data-plugin="formMaterial">
                  
                  <label class="form-control-label" for="dokumen">Dokumen Wisata</label>
                  <input type="text" class="form-control" placeholder="Browse.." readonly="">
                  <input type="file" id="dokumen" name="dokumen">
                </div>
                <div class="form-group form-material" data-plugin="formMaterial">
                  <label class="form-control-label" for="desc">Deskripsi Wisata</label>
                  <textarea class="form-control" id="desc" name="deskripsi_wisata" rows="3"></textarea>
                </div>
                <div class="form-group form-material" data-plugin="formMaterial">
                  <label class="form-control-label" for="alamat">Alamat Wisata</label>
                  <textarea class="form-control" id="alamat" name="alamat_wisata" rows="3"></textarea>
                </div>
                <div class="form-group form-material" data-plugin="formMaterial">
                  <label class="form-control-label" for="jam">Jam Operasional</label>
                  <textarea class="form-control" id="jam" name="jam_wisata" rows="3" placeholder="example:senin-minggu :07.00-15.00 WIB"></textarea>
                </div>
                <div class="form-group form-material" data-plugin="formMaterial">
                  <label class="form-control-label" for="select">Jenis Wisata</label>
                  <select class="form-control" name="jenis_wisata" id="select">
                    <option value="budaya/sejarah">Budaya/Sejarah</option>
                    <option value="bahari">Bahari</option>
                    <option value="cagar alam">Cagar Alam</option>
                    <option value="konvensi">Konvensi</option>
                    <option value="agrowisata">Agrowisata</option>
                    <option value="berburuh">Berburuh</option>
                    <option value="ziarah">ziarah</option>
                  </select>
                </div>
                <button type="submit">bbbb</button>
              </form>
            </div>
          </div>       
</div>
    </div>
</div>
<div class="modal fade modal-fall" id="modform" aria-hidden="true" aria-labelledby="exampleModalTitle"
         role="dialog" tabindex="-1">
         <div class="modal-dialog modal-simple">
           <div class="modal-content">
             <div class="modal-header">
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                 <span aria-hidden="true">×</span>
               </button>
               <h4 class="modal-title">Aturan Dokumen</h4>
             </div>
             <div class="modal-body">
              <p>1. File berbentuk pdf</p>
              <p>2. dokumen berupa lampiran-lampiran bahwa wisata yang anda miliki memang sah, minimal suratpengesahan dari kepala desa setempat</p>
              <p>3. diperbolehkan melampirkan hal-hal yang menambah keyakinan bahwa benar tempat wisata ini ada dan memiliki izin</p>
            </div>
             <div class="modal-footer">
                 
               <button type="button" class="btn btn-default btn-pure" data-dismiss="modal">Close</button>
             </div>
           </div>
         </div>
       </div>
       <!-- End Modal -->
       {{-- modal image --}}
       <div class="modal fade modal-fall" id="imgmod" aria-hidden="true" aria-labelledby="exampleModalTitle"
         role="dialog" tabindex="-1">
         <div class="modal-dialog modal-simple">
           <div class="modal-content">
             <div class="modal-header">
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                 <span aria-hidden="true">×</span>
               </button>
               <h4 class="modal-title">Priview image</h4>
             </div>
             <div class="modal-body">
              @forelse ($w->gallery as $i)
              <img src="{{Storage::url('gallery/'.$i->foto)}}" alt="">
                  
              @empty
                  <img id="blah" src="" alt="">
              @endforelse
            </div>
             <div class="modal-footer">
                 
               <button type="button" class="btn btn-default btn-pure" data-dismiss="modal">Close</button>
             </div>
           </div>
         </div>
       </div>
       <!-- End Modal -->
@endsection
@section('footer')
<script>
  $(document).ready(function(){
function readURL(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();
    
    reader.onload = function(e) {
      $('#blah').attr('src', e.target.result);
    }
    
    reader.readAsDataURL(input.files[0]); // convert to base64 string
  }
}

$("#image").change(function() {
  readURL(this);
});
  });
</script>

@endsection