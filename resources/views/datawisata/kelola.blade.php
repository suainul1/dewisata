@extends('layouts.master',['title'=>'Kelola Wisata','body' => 'page-faq'])
@section('head')
<link rel="stylesheet" href="{{asset('global/vendor/summernote/summernote.css')}}">
<script>
    function deleteh(c) {
        var zz = confirm('apakah anda yakin ingin menghapus?');
        if (zz) {
            document.getElementById(`fharga${c}`).submit();
        }
    }
    function deletgallery(params) {
        var l = confirm('apakah anda yakin ingin menghapus?'); 
        if(l){
            document.getElementById(`fgallery${params}`).submit();
        }
    }
    
</script>
<script>
    function hapus(id) {
        $(`.${id}`).remove();
    }
</script>
@endsection
@section('content')

<!-- Page -->
<div class="page">
    <div class="page-header">
        <h1 class="page-title">{{$wisata->nama_wisata}}</h1>
    </div>

    <div class="page-content container-fluid">
        <div class="row">
            <div class="col-xl-3 col-md-4">
                <!-- Panel -->
                <div class="panel">
                    <div class="panel-body">
                        <div class="list-group faq-list" role="tablist">
                            <a class="list-group-item active" data-toggle="tab" href="#category-1"
                                aria-controls="category-1" role="tab">Deskripsi</a>
                            <a class="list-group-item" data-toggle="tab" href="#category-2" aria-controls="category-2"
                                role="tab">Tiket</a>
                            <a class="list-group-item" data-toggle="tab" href="#category-3" aria-controls="category-3"
                                role="tab">Kelola Dana</a>
                            <a class="list-group-item" data-toggle="tab" href="#category-4" aria-controls="category-4"
                                role="tab">kelola Gallery</a>
                        </div>
                    </div>
                </div>
                <!-- End Panel -->
            </div>

            <div class="col-xl-9 col-md-8">
                <!-- Panel -->
                <div class="panel">
                    <div class="panel-body">
                        <div class="tab-content">
                            <!-- Categroy 1 -->
                            <div class=" tab-pane animation-fade active" id="category-1" role="tabpanel">
                                <div class="panel-group panel-group-simple panel-group-continuous" id="accordion2"
                                    aria-multiselectable="true" role="tablist">
                                    <!-- Question 1 -->
                                    <div class="panel">
                                        <div class="panel-heading" id="question-1" role="tab">
                                            <a class="panel-title" aria-controls="answer-1" aria-expanded="true"
                                                data-toggle="collapse" href="#answer-1" data-parent="#accordion2">
                                                Pengaturan Umum Wisata
                                            </a>
                                        </div>
                                        <div class="panel-collapse collapse show" id="answer-1"
                                            aria-labelledby="question-1" role="tabpanel">
                                            <div class="panel-body">
                                                <form action="{{route('wisata.update',$wisata->slug)}}" method="post">
                                                    @csrf
                                                    @method('put')
                                                    <div class="form-group form-material" data-plugin="formMaterial">
                                                        <label class="form-control-label" for="jam">Jam
                                                            Operasional</label>
                                                        <textarea class="form-control" id="jam" name="jam_wisata"
                                                            rows="3"
                                                            {{$wisata->status == 'pengajuan' ? 'readonly' : null}}
                                                            placeholder="example:senin-minggu :07.00-15.00 WIB">{{$wisata->jam_operasional}}</textarea>
                                                    </div>
                                                    <div class="form-group form-material mt-2"
                                                        data-plugin="formMaterial">
                                                        <label class="form-control-label" for="select">Jenis
                                                            Wisata</label>
                                                        <select readonly class="form-control" name="jenis_wisata"
                                                            id="select">
                                                            @php
                                                            $a = ['budaya/sejarah','bahari','cagar
                                                            alam','konvensi','agrowisata','berburuh','ziarah'];
                                                            @endphp
                                                            @foreach ($a as $i)
                                                            <option value="{{$i}}"
                                                                {{$i == $wisata->jenis_wisata ? 'selected' : ($wisata->status == 'pengajuan' ? 'disabled' : null)}}>
                                                                {{Str::title($i)}}</option>

                                                            @endforeach

                                                        </select>
                                                    </div>
                                                    <textarea id="summernote" data-plugin="summernote"
                                                        name="deskripsi_wisata"
                                                        rows="3">{{$wisata->deskripsi_wisata}}</textarea>
                                                    <button type="submit"
                                                        class="btn btn-block btn-primary waves-effect waves-classic">Save</button>

                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Question 1 -->
                                </div>
                            </div>
                            <!-- End Categroy 1 -->

                            <!-- Categroy 2 -->
                            <div class="tab-pane animation-fade" id="category-2" role="tabpanel">
                                <div class="panel-group panel-group-simple panel-group-continuous" id="accordion"
                                    aria-multiselectable="true" role="tablist">
                                    <!-- Question 5 -->
                                    <div class="panel">
                                        <div class="panel-heading" id="question-5" role="tab">
                                            <a class="panel-title" aria-controls="answer-5" aria-expanded="true"
                                                data-toggle="collapse" href="#answer-5" data-parent="#accordion">
                                                Kelola Tiket Anda
                                            </a>
                                        </div>
                                        <div class="panel-collapse collapse show" id="answer-5"
                                            aria-labelledby="question-5" role="tabpanel">
                                            <div class="panel-body">
                                                <form action="{{route('harga.create',$wisata->slug)}}" method="post">
                                                    @csrf
                                                    <div class="row wad">
                                                        @forelse ($wisata->tiket as $i)
                                                        <div class="col-md-6 col-sm-6">

                                                            <div class="form-group">
                                                                <div class="input-group input-group-icon">
                                                                    <span onclick="deleteh({{$i->id}})"
                                                                        class="input-group-addon bg-danger"
                                                                        style="cursor: pointer">
                                                                        <span class="icon md-close"
                                                                            aria-hidden="true"></span>
                                                                    </span>
                                                                    <input type="text" value="{{$i->nama}}"
                                                                        name="nama[]"
                                                                        {!!$i->nama == 'harga_masuk' ? 'readonly' : null !!}
                                                                        class="form-control" placeholder="nama tiket">

                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 col-sm-6">
                                                            <div class="form-group">
                                                                <div class="input-group">
                                                                    <span class="input-group-addon">Rp</span>
                                                                    <input type="text" value="{{$i->harga}}"
                                                                        name="harga[]" class="form-control"
                                                                        placeholder="wajib di isi">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        @empty
                                                        <div class="col-md-6 col-sm-6">
                                                            <div class="form-group">
                                                                <div class="input-group input-group-icon">
                                                                    <span class="input-group-addon bg-danger"
                                                                        style="cursor: pointer">
                                                                        <span class="icon md-close"
                                                                            aria-hidden="true"></span>
                                                                    </span>
                                                                    <input readonly type="text" value="harga_masuk" name="nama[]"
                                                                         class="form-control"
                                                                        placeholder="nama tiket">

                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 col-sm-6">
                                                            <div class="form-group">
                                                                <div class="input-group">
                                                                    <span class="input-group-addon">Rp</span>
                                                                    <input type="text" name="harga[]"
                                                                        class="form-control" placeholder="wajib di isi">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        @endforelse
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="d-flex justify-content-center">
                                                                <button type="submit"
                                                                    class="btn btn-round btn-primary btn-pill-left waves-effect waves-classic">Save</button>
                                                                <button id="addbtn" type="button"
                                                                    class="btn btn-round btn-primary btn-pill-right waves-effect waves-classic">Add</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Question 5 -->
                                </div>
                            </div>
                            <!-- End Categroy 2 -->

                            <!-- Categroy 3 -->
                            <div class="tab-pane animation-fade" id="category-3" role="tabpanel">
                                <div class="panel-group panel-group-simple panel-group-continuous" id="accordion1"
                                    aria-multiselectable="true" role="tablist">
                                    <!-- Question 8 -->
                                    <div class="panel">
                                        <div class="panel-heading" id="question-8" role="tab">
                                            <a class="panel-title" aria-controls="answer-8" aria-expanded="true"
                                                data-toggle="collapse" href="#answer-8" data-parent="#accordion1">
                                                <b>Kelola Bank</b>
                                            </a>
                                        </div>
                                        <div class="panel-collapse collapse" id="answer-8" aria-labelledby="question-8"
                                            role="tabpanel">
                                            <div class="panel-body">
                                                @php
                                                if(auth()->user()->bank()->exists()){
                                                $c ='update';
                                                $d = auth()->user()->bank->id;
                                                }else{
                                                $c = 'create';
                                                $d = null;
                                                }
                                                @endphp
                                                <form action="{{route('bank.'.$c,$d)}}" method="post">
                                                    @csrf
                                                    @if (auth()->user()->bank()->exists())
                                                    @method('put')
                                                    @endif
                                                    <div class="form-group form-material" data-plugin="formMaterial">
                                                        <label class="form-control-label" for="inputText">Nama Pemilik
                                                            Rekening</label>
                                                        <input type="text" class="form-control"
                                                            value="{{auth()->user()->bank->nama ?? null}}"
                                                            id="inputText" name="nama" placeholder="Atas Nama">
                                                    </div>
                                                    <div class="form-group form-material" data-plugin="formMaterial">
                                                        <label class="form-control-label" for="inputText">Nomor
                                                            Rekening</label>
                                                        <input type="text" class="form-control" id="inputText"
                                                            name="no_rekening"
                                                            value="{{auth()->user()->bank->no_rekening ?? null}}"
                                                            placeholder="Nomor Rekening">
                                                    </div>
                                                    <div class="form-group form-material" data-plugin="formMaterial">
                                                        <label class="form-control-label" for="select">Jenis
                                                            Bank</label>
                                                        <select class="form-control" name="bank" id="select">
                                                            @foreach ($bank as $b)
                                                            <option value="{{$b['code']}}"
                                                                {{(auth()->user()->bank->bank ?? 'c') == $b['code'] ? 'selected' : null}}>
                                                                {{$b['name']}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <button type="submit"
                                                        class="btn btn-block btn-primary waves-effect waves-classic">Save</button>

                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Question 8 -->
                                    <!-- Question 10 -->
                                    <div class="panel">
                                        <div class="panel-heading" id="question-10" role="tab">
                                            <a class="panel-title" aria-controls="answer-10" aria-expanded="false"
                                                data-toggle="collapse" href="#answer-10" data-parent="#accordion1">
                                                <b>Pencairan Dana</b>
                                            </a>
                                        </div>
                                        <div class="panel-collapse collapse" id="answer-10"
                                            aria-labelledby="question-10" role="tabpanel">
                                            <div class="panel-body">
                                                <form action="{{route('bank.pencairan')}}" method="post">
                                                    @csrf
                                                    <div class="form-group form-material" data-plugin="formMaterial">
                                                        <label class="form-control-label" for="inputText">Jumlah
                                                            Pencairan Dana</label>
                                                        <input type="number" class="form-control" id="inputText"
                                                            name="jumlah" placeholder="Jumlah Pencairan">
                                                    </div>
                                                    <button type="submit"
                                                        class="btn btn-block btn-primary waves-effect waves-classic">Send</button>

                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Question 10 -->
                                </div>
                            </div>
                            <!-- End Categroy 3 -->

                            <!-- Categroy 4 -->
                            <div class="tab-pane animation-fade" id="category-4" role="tabpanel">
                                <div class="panel-group panel-group-simple panel-group-continuous" id="accordion3"
                                    aria-multiselectable="true" role="tablist">
                                    <!-- Question 11 -->
                                    <div class="panel">
                                        <div class="panel-heading" id="question-11" role="tab">
                                            <a class="panel-title" aria-controls="answer-11" aria-expanded="true"
                                                data-toggle="collapse" href="#answer-11" data-parent="#accordion3">
                                                Semua Foto
                                            </a>
                                        </div>
                                        <div class="panel-collapse collapse show" id="answer-11"
                                            aria-labelledby="question-11" role="tabpanel">
                                            <div class="panel-body">
                                                <div class="float-right">
                                                    <button type="button" data-target="#gallery" data-toggle="modal"
                                                        class="btn btn-pure btn-danger icon md-plus waves-effect waves-classic"></button>
                                                </div>
                                                <div class="row">
                                                    @foreach ($wisata->gallery as $g)
                                                    <form id="fgallery{{$g->id}}" action="{{route('wisata.destroy-foto',$g->id)}}" method="post">
                                                        @csrf
                                                        @method('delete')
                                                    </form>
                                                    <div class="col-md-4">
                                                        <img style="height: 200px" class="card-img-top w-full"
                                                            src="{{Storage::url('gallery/'.$g->foto)}}"
                                                            alt="Card image cap">
                                                        <div style="cursor: pointer" class="bg-primary card-block" onclick="deletgallery({{$g->id}})">
                                                            <center>
                                                                <h3 style="display:inline"
                                                                    class="card-title text-light">Hapus</h3>
                                                            </center>
                                                        </div>
                                                    </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Question 11 -->
                                </div>
                            </div>
                            <!-- End Categroy 4 -->
                        </div>
                    </div>
                </div>
                <!-- End Panel -->
            </div>
        </div>
    </div>
</div>
<!-- End Page -->
<div class="modal fade modal-fall" id="gallery" aria-hidden="true" aria-labelledby="exampleModalTitle" role="dialog"
    tabindex="-1">
    <div class="modal-dialog modal-simple">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title">Tambah Foto</h4>
            </div>
            <div class="modal-body">
                <form action="{{route('wisata.update',$wisata->slug)}}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="form-group form-material form-material-file" data-plugin="formMaterial">
                        <label class="form-control-label" for="image">Gambar wisata(bisa lebi dari satu
                            gambar)</label>
                        <input type="text" class="form-control" placeholder="Browse.." readonly="">
                        <input type="file" id="image" name="image[]" multiple="">
                    </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
                </form>
                <button type="button" class="btn btn-default btn-pure" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@foreach ($wisata->tiket as $i)
<form id="fharga{{$i->id}}" action="{{route('harga.destroy',$i->id)}}" method="post">
    @csrf
    @method('delete')
</form>
@endforeach
@endsection
@section('footer')
<script src="{{asset('global/vendor/summernote/summernote.min.js')}}"></script>
<script src="{{asset('global/js/Plugin/summernote.js')}}"></script>

<script src="{{asset('assets/examples/js/forms/editor-summernote.js')}}"></script>
<script src="{{asset('global/js/Plugin/input-group-file.js')}}"></script>
<script>
    $(document).ready(function () {

        function f(c) {
            return `<div class="col-md-6 col-sm-6 ${c}">
                <div class="form-group">
                    <div class="input-group input-group-icon">
                        <span onclick="hapus('${c}')" class="input-group-addon bg-danger"
                            style="cursor: pointer">
                            <span class="icon md-close"
                                aria-hidden="true"></span>
                        </span>
                        <input type="text" name="nama[]"
                             class="form-control"
                            placeholder="nama tiket">

                    </div>
                </div>
            </div>
            <div class="col-md-6 col-sm-6 ${c}">
                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon">Rp</span>
                        <input type="text" name="harga[]"
                            class="form-control" placeholder="harga tiket">
                    </div>
                </div>
            </div>`;

        }
        $("#addbtn").on('click', function () {

            $(".wad").append(f(Math.random().toString(36).substring(7)));
        });
    });
</script>
@endsection