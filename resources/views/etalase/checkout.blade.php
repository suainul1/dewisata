@extends('layouts.master',['title' => 'Pilih Harga'])
@section('content')
<div class="page">
    <div class="row">
        <div class="col-md-6 offset-3">
<div class="panel" style="margin-top: 4%">
    <div class="panel-heading">
    <h3 class="panel-title">Pilih Harga</h3>
    </div>
    <div class="panel-body container-fluid">
    <form onsubmit="return confirm('apakah anda yakin?')" action="{{route('etalase.checkout',$w->slug)}}" autocomplete="off" method="POST">
        @csrf   
        <table class="table">
                <thead>
                  <tr>
                    <th scope="col">No</th>
                    <th scope="col">Nama Varian Harga</th>
                    <th scope="col">Harga</th>
                    <th scope="col">Jumlah</th>
                    <th scope="col">Pilih</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($tiket as $i=>$t)
                        
                    <tr>
                    <th scope="row">{{$i+1}}</th>
                    <td>{{$t->nama}}</td>
                    <td>{{$t->harga}}</td>
                    <td><input type="number" value="1" name="orang[]" class="form-control" id="inputText" placeholder="Jumlah Orang"></td>
                    <td><input type="checkbox" id="inputUnchecked" {!! $t->nama == 'harga_masuk' ? 'required' : null !!} value="{{$t->id}}" name="harga[]"></td>
                    </tr>
                    @endforeach
                </tbody>
              </table>
              <div class="form-group form-material" data-plugin="formMaterial">
                <label class="form-control-label" for="berkunjung">Tanggal Berkunjung</label>
                <input type="date" class="form-control" required
                    id="berkunjung" name="berkunjung" placeholder="Atur Tanggal Berkunjung"
                    >
                    @if(session()->get('error'))
                    <span class="text-danger">{!! session()->get('error') !!} </span>
                    @endif  
                  </div>
            <button type="submit" class="btn btn-primary btn-block btn-round waves-effect waves-classic">Kirim</button>
                        
          </form>
    </div>
  </div>

</div>
</div>
</div>
@endsection