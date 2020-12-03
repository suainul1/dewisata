<form>
    <div class="form-group form-material" data-plugin="formMaterial">
        <label class="form-control-label" for="inputText">Nama Wisata</label>
    <input type="text" class="form-control" id="inputText" value="{{$t->wisata->nama_wisata}}" name="nama" placeholder="Nama" readonly>
      </div>

    <div class="form-group form-material" data-plugin="formMaterial">
        <label class="form-control-label" for="inputText">Nama Pengelola</label>
    <input type="text" class="form-control" id="inputText" value="{{$t->wisata->user->name}}" name="nama" placeholder="Nama" readonly>
      </div>
      
    <div class="form-group form-material" data-plugin="formMaterial">
        <label class="form-control-label" for="inputText">Tanggal Pembelian</label>
    <input type="text" class="form-control" id="inputText" value="{{$t->created_at->format('d-M-Y')}}" name="nama" placeholder="Nama" readonly>
      </div>

    <div class="form-group form-material" data-plugin="formMaterial">
        <label class="form-control-label" for="inputText">Tanggal Booking</label>
    <input type="text" class="form-control" id="inputText" value="{{$t->tanggal_berkunjung}}" name="nama" placeholder="Nama" readonly>
      </div>

    <div class="form-group form-material" data-plugin="formMaterial">
        <label class="form-control-label" for="inputText">Total Harga</label>
    <input type="text" class="form-control" id="inputText" value="{{$t->harga_total}}" name="nama" placeholder="Nama" readonly>
      </div>

    <div class="form-group form-material" data-plugin="formMaterial">
        <label class="form-control-label" for="inputText">Ppn</label>
    <input type="text" class="form-control" id="inputText" value="5%" name="nama" placeholder="Nama" readonly>
      </div>
      <div class="form-group form-material" data-plugin="formMaterial">
        <label class="form-control-label" for="inputText">Status Pembayaran</label>
      <input type="text" class="form-control" id="inputText" value="{{$t->status}}" name="nama" placeholder="Nama" readonly>
      </div>
</form>
