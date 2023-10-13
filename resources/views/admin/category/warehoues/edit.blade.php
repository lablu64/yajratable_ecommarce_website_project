<form action="{{ route('warehoues.update') }}" method="Post" id="edit_form" enctype="multipart/form-data">
    @csrf
  <div class="modal-body">
      
        <input type="hidden" name="id" value="{{ $data->id }}">
        <div class="form-group">
          <label for="category_name">warehoues Name</label>
          <input type="text" class="form-control" id="warehouse_name" name="warehouse_name" value="{{ $data->warehouse_name }}" required="">
      </div> 
      <div class="form-group">
        <label for="category_name">warehoues address</label>
        <input type="text" class="form-control" id="warehouse_address" name="warehouse_address" value="{{ $data->warehouse_address }}" required="">
     </div> 
     <div class="form-group">
      <label for="category_name">warehoues phone</label>
      <input type="text" class="form-control" id="warehouse_phone" name="warehouse_phone" value="{{ $data->warehouse_phone }}" required="">
  </div>  
  </div>
  <div class="modal-footer">
    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
    <button type="Submit" class="btn btn-primary"><span class=" loading d-none">...</span>  Submit</button>
  </div>
  </form>
  
  <script type="text/javascript">
    $('#edit_form').submit(function(e){
        e.preventDefault();
        var url = $(this).attr('action');
        var request =$(this).serialize();
        $.ajax({
          url:url,
          type:'post',
          async:false,
          data:request,
          success:function(data){  
            toastr.success(data);
            $('#edit_form')[0].reset();
            $('#editModal').modal('hide');
            table.ajax.reload();
          }
        });
      });
  </script>