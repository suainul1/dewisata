  <!-- Modal ktp-->
<div class="modal fade modal-fall" id="harga{{$t->id}}" aria-hidden="true" aria-labelledby="exampleModalTitle"
  role="dialog" tabindex="-1">
  <div class="modal-dialog modal-simple">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
        <h4 class="modal-title">Detail harga</h4>
      </div>
      <div class="modal-body">
        <table class="table">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Jenis Tiket</th>
                <th scope="col">Harga</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($t->harga as $ii=>$h)
                <tr>
                    <th scope="row">{{$ii+1}}</th>
                    <td>{{$h->nama}}</td>
                    <td>{{$h->harga}}</td>
                    </tr>
                    @endforeach
            </tbody>
          </table>
    </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default btn-pure" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<!-- End Modal -->