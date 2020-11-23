@extends('layouts.master')
@section('head')
<link rel="stylesheet" href="{{asset('global/vendor/summernote/summernote.css')}}">

@endsection
@section('content')
<div class="page">
    <div class="page-content">
        <div class="page-content container-fluid">
            <div class="panel">
                <div class="panel-heading">
                    <div class="text-center">
                        <button
                            class="btn btn-{{$wisata->status == 'proses' ? 'warning' :($wisata->status == 'pengajuan' ? 'info' : 'danger')}} rounded-circle"><i
                                class="icon md-refresh-alt" aria-hidden="true"></i></button>
                        <h3
                            class="text-{{$wisata->status == 'proses' ? 'warning' :($wisata->status == 'pengajuan' ? 'primary' : 'danger')}} panel-title">
                            {{$wisata->status == 'proses' ? 'Pengisian Form' :($wisata->status == 'pengajuan' ? 'Menunggu Proses Pengajuan' : 'Pengulangan Pengisian Form')}}
                            Wisata</h3>
                            @if ($wisata->status == 'tolak')
                            <div class="modal fade modal-fall" id="pesan" aria-hidden="true"
                            aria-labelledby="exampleModalTitle" role="dialog" tabindex="-1">
                            <div class="modal-dialog modal-simple">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                        <h4 class="modal-title">Aturan Dokumen</h4>
                                    </div>
                                    <div class="modal-body">
                                        {!!$wisata->pesan!!}
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default btn-pure"
                                            data-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <span style="display:block;margin-top: -2%" class="text-danger">untuk melihat alasan <u data-target="#pesan" data-toggle="modal" style="cursor:pointer;color : rgb(247, 131, 131)">klik</u></span>
                            @endif
                    </div>
                </div>
                <div class="panel-body container-fluid">
                    <form autocomplete="off" action="{{route('wisata.pengajuan')}}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div class="form-group form-material" data-plugin="formMaterial">
                            <label class="form-control-label" for="nama">Nama Tempat Wisata</label>
                            <input type="text" class="form-control" {{$wisata->status == 'pengajuan' ? 'readonly' : null}}
                                id="nama" name="nama_wisata" placeholder="Nama Tempat Wisata"
                                value="{{$wisata->nama_wisata}}">
                        </div>
                        <label data-target="#imgmod" data-toggle="modal" class="text-warning" style="cursor: pointer"
                            for="">Lihat gallery foto/priview foto</label>
                        @if ($wisata->status != 'pengajuan')
                        <div class="form-group form-material form-material-file" data-plugin="formMaterial">
                            <label class="form-control-label" for="image">Gambar wisata(bisa lebi dari satu
                                gambar)</label>
                            <input type="text" class="form-control" placeholder="Browse.." readonly="">
                            <input type="file" id="image" name="image[]" multiple="">
                        </div>
                        @endif
                        @if ($wisata->status != 'pengajuan')
                        <div class="modal fade modal-fall" id="modform" aria-hidden="true"
                            aria-labelledby="exampleModalTitle" role="dialog" tabindex="-1">
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
                                        <p>2. dokumen berupa lampiran-lampiran bahwa wisata yang anda miliki memang sah,
                                            minimal suratpengesahan dari kepala desa setempat</p>
                                        <p>3. diperbolehkan melampirkan hal-hal yang menambah keyakinan bahwa benar
                                            tempat wisata ini ada dan memiliki izin</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default btn-pure"
                                            data-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Modal -->
                        {{-- modal image --}}
                        <label data-target="#modform" data-toggle="modal" class="text-warning" style="cursor: pointer;"
                            for="">Baca Aturan Dokumen</label>
                        <div class="form-group form-material form-material-file" data-plugin="formMaterial">
                            <label class="form-control-label" for="dokumen">Dokumen Wisata</label>
                            <input type="text" class="form-control" placeholder="Browse.." readonly="">
                            <input type="file" id="dokumen" name="dokumen">
                        </div>
                        @else
                        <br>
                        <a href="{{Storage::url('dokumen/'.$wisata->dokumen_wisata)}}" target="_blank"
                            class="text-info">Lihat Dokumen</a>
                        @endif
                        <div class="form-group form-material" data-plugin="formMaterial">
                            <label class="form-control-label" for="desc">Deskripsi Wisata</label>
                            <textarea id="summernote" data-plugin="summernote" class="form-control" id="desc" name="deskripsi_wisata" rows="3">{{$wisata->deskripsi_wisata}}</textarea>
                        </div>
                        <div class="form-group form-material" data-plugin="formMaterial">
                            <label class="form-control-label" for="alamat">Alamat Wisata</label>
                            <textarea class="form-control" id="alamat" name="alamat_wisata"
                                {{$wisata->status == 'pengajuan' ? 'readonly' : null}}
                                rows="3">{{$wisata->alamat_wisata}}</textarea>
                        </div>
                        <div class="form-group form-material" data-plugin="formMaterial">
                            <label class="form-control-label" for="jam">Jam Operasional</label>
                            <textarea class="form-control" id="jam" name="jam_wisata" rows="3"
                                {{$wisata->status == 'pengajuan' ? 'readonly' : null}}
                                placeholder="example:senin-minggu :07.00-15.00 WIB">{{$wisata->jam_operasional}}</textarea>
                        </div>
                        <div class="form-group form-material" data-plugin="formMaterial">
                          <label class="form-control-label" for="nik">Nomor Induk kependudukan</label>
                          <input type="text" class="form-control" {{$wisata->status != 'tolak' ? 'readonly' : null}}
                              id="nik" name="nik" placeholder="Nik"
                              value="{{$wisata->nik}}">
                      </div>
                    <img style="width: 30%; height:200px;" id="ktpi" src="{{Storage::url('ktp/'.$wisata->scan_ktp)}}" alt="">
                    @if ($wisata->status == 'tolak') 
                    <div class="form-group form-material form-material-file" data-plugin="formMaterial">
                        <label class="form-control-label" for="ktp">Change KTP</label>
                        <input type="text" class="form-control" placeholder="change.." readonly="">
                        <input type="file" id="ktp" id="ktp" name="scan_ktp">
                    </div>
                    @endif  
                        <div class="form-group form-material mt-2" data-plugin="formMaterial">
                            <label class="form-control-label" for="select">Jenis Wisata</label>
                            <select readonly class="form-control" name="jenis_wisata" id="select">
                                @php
                                    $a = ['budaya/sejarah','bahari','cagar alam','konvensi','agrowisata','berburuh','ziarah'];
                                @endphp
                                @foreach ($a as $i)
                            <option value="{{$i}}" {{$i == $wisata->jenis_wisata ? 'selected' : ($wisata->status == 'pengajuan' ? 'disabled' : null)}}>{{Str::title($i)}}</option>
                                    
                                @endforeach
                               
                            </select>
                        </div>
                        @if (auth()->user()->role == 'pengelola_wisata')
                        <button type="{{$wisata->status == 'pengajuan' ? 'button' : 'submit'}}"
                            class="btn btn-block btn-primary waves-effect waves-classic">Submit</button>
                            @endif
                        </form>      
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade modal-fall" id="imgmod" aria-hidden="true" aria-labelledby="exampleModalTitle" role="dialog"
    tabindex="-1">
    <div class="modal-dialog modal-simple">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title">Priview image</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    @forelse ($wisata->status == 'tolak' ? [] : $wisata->gallery as $i)
                    <div class="col-md-12 mb-5">
                        <img style="width: 100%; height:300px;" src="{{Storage::url('gallery/'.$i->foto)}}" alt="">
                    </div>
                    @empty
                    <div id="blah"></div>
                    @endforelse
                </div>

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
<script src="{{asset('global/vendor/summernote/summernote.min.js')}}"></script>
<script src="{{asset('global/js/Plugin/summernote.js')}}"></script>
    
<script src="{{asset('assets/examples/js/forms/editor-summernote.js')}}"></script>
<script src="{{asset('global/js/Plugin/input-group-file.js')}}"></script>
<script>
    $(document).ready(function () {
        if ("{{$wisata->status == 'pengajuan'}}") {
            $('#summernote').summernote('disable');
        }
        function readURL(input) {
            for (let index = 0; index < input.files.length; index++) {
                if (input.files && input.files[index]) {
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        $('#blah').append(
                            `<img style="width: 100%; height:300px;" src="${e.target.result}" alt="">`);

                    }

                    reader.readAsDataURL(input.files[index]); // convert to base64 string
                }
            }
        }
        function readURLKtp(input) {
          if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        $('#ktpi').attr('src',
                            e.target.result);

                    }

                    reader.readAsDataURL(input.files[0]); // convert to base64 string
                }
        }

        $("#image").change(function () {
            readURL(this);
        });
        $("#ktp").change(function () {
            readURLKtp(this);
        });
    });
</script>

@endsection