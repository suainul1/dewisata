   <!-- Modal edit-->
<div class="modal fade modal-fall" id="editBalas{{$b->id}}" aria-hidden="true" aria-labelledby="exampleModalTitle"
   role="dialog" tabindex="-1">
   <div class="modal-dialog modal-simple">
     <div class="modal-content">
       <div class="modal-header">
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true">×</span>
         </button>
         <h4 class="modal-title">Edit Komentar</h4>
       </div>
       <div class="modal-body">
       <form action="{{route('komentar.editBalas',$b->id)}}" method="POST" enctype="multipart/form-data">
           @csrf
           @method('put')
           <div class="form-group">
           <textarea name="balas" required class="form-control" rows="5" placeholder="Comment here">{{$b->isi}}</textarea>
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