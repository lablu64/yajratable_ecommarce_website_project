<form action="{{ route('category.update') }}" method="Post" id="edit_form" enctype="multipart/form-data">
    @csrf
  <div class="modal-body">
      <div class="form-group">
        <input type="hidden" name="id" value="{{ $data->id }}">
        <label for="category_name">Category Name</label>
        <input type="text" class="form-control" id="category_name" name="category_name" value="{{ $data->category_name }}">
        <small id="emailHelp" class="form-text text-muted">This is your main category</small>
      </div> 
      {{-- <div class="form-group">
        <label for="category_name">Category Icon</label>
        <input type="file" class="dropify" id="icon" name="icon" required="">
      </div>   --}}
      {{-- <div class="form-group">
        <label for="category_name">Show on Homepage</label>
       <select class="form-control" name="home_page">
         <option value="1">Yes</option>
         <option value="0">No</option>
       </select>
        <small id="emailHelp" class="form-text text-muted">If yes it will be show on your home page</small>
      </div>   --}}
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