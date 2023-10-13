<form action="{{ route('subcategory.update') }}" method="Post" id="edit_form" enctype="multipart/form-data">
    @csrf
  <div class="modal-body">
      <div class="form-group">
        <input type="hidden" name="id" value="{{ $data->id }}">
        <label for="category_name">SubCategory Name</label>
        <input type="text" class="form-control" id="subcategory_name" name="subcategory_name" value="{{ $data->subcategory_name }}">
        </div>    
  </div>
  <div class="form-group">
    <label for="category_name">category</label>
    @php
    $category=App\Models\Category::all();
   @endphp
  
    
      <select class="form-control" name="category_id">
        <option disabled >choose your category</option>
        @foreach ($category as $item)
        <option {{ $item->id ==$data->category_id ? 'selected' : '' }} value="{{ $item->id }}">{{ $item->category_name }}</option>
        @endforeach
      </select>
      
   
   
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