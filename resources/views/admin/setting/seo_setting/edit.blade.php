<form action="{{ route('pickpoint.update') }}" method="Post" id="edit_form" enctype="multipart/form-data">
    @csrf
  <div class="modal-body">
      
        <input type="hidden" name="id" value="{{ $data->id }}">
        <div class="form-group">
          <label for="category_name">pickpoint Name</label>
          <input type="text" class="form-control" id="pickup_point_name" name="pickup_point_name" value="{{ $data->pickup_point_name }}" required="">
      </div> 
      <div class="form-group">
        <label for="category_name">pickpoint address</label>
        <input type="text" class="form-control" id="pickup_point_address" name="pickup_point_address" value="{{ $data->pickup_point_address }}" required="">
     </div> 
     <div class="form-group">
      <label for="category_name">pickpoint phone</label>
      <input type="text" class="form-control" id="pickup_point_phone" name="pickup_point_phone" value="{{ $data->pickup_point_phone }}" required="">
    </div> 
    
    <div class="form-group">
      <label for="category_name">pickpoint other phone</label>
      <input type="text" class="form-control" id="pickup_point_phone_two" name="pickup_point_phone_two" value="{{ $data->pickup_point_phone_two }}" required="">
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