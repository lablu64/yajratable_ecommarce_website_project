<form action="{{ route('chailcategory.update') }}" method="Post" id="edit_form" enctype="multipart/form-data">
    @csrf
  <div class="modal-body">
   
        <input type="hidden" name="id" value="{{ $data->id }}">
    
      <div class="form-group">
        <label for="category_name">Category/Subcategory </label>
        <select class="form-control" name="subcategory_id" required="">
          @php 
                $category=DB::table('categories')->get();
             
            @endphp
          @foreach($category as $row)
          @php
            $subcat=DB::table('sub_categories')->where('category_id',$row->id)->get();
         
          @endphp
              
              <option disabled="" style="color: blue;" >{{ $row->category_name }}</option>
              @foreach($subcat as $row)
                  <option  value="{{ $row->id }}"> ---- {{ $row->subcategory_name }}</option>
              @endforeach    
          @endforeach
        </select>
      </div>
      <div class="form-group">
        <label for="category_name">Child Category Name</label>
        <input type="text" class="form-control"  name="chail_name" value="{{ $data->chail_name }}" required="">
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