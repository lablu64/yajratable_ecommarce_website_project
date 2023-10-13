@extends('layouts.admin')
@section('admin_content')
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.css">
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Sub Category</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <button class="btn btn-primary" data-toggle="modal" data-target="#subcategoryModal"> + Add New</button>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
     <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">All sub categories list </h3>
              </div>
              <!-- /.card-header -->
                <div class="card-body">
                  <table id="example1" class="table table-bordered table-striped table-sm ytable">
                    <thead>
                    <tr>
                      <th>SL</th>
                      <th>Category Name</th>
                      <th>SubCategory Name</th>
                      <th>SubCategory Slug</th>
                      <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>

                    </tbody>
                  </table>

                  <form id="deleted_form" action="" method="POST">
                    @csrf
                    @method('GET')
                   
                </form>
                </div>
	          </div>
	      </div>
	  </div>
	</div>
</section>
</div>

{{-- category insert modal --}}
<div class="modal fade" id="subcategoryModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add New Category</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{ route('subcategory.store') }}" method="Post" id="add_form" enctype="multipart/form-data">
      	@csrf
      <div class="modal-body">
        <div class="form-group">
            <label for="category_name">SubCategory Name</label>
            <input type="text" class="form-control" id="subcategory_name" name="subcategory_name" required="">
            <small id="emailHelp" class="form-text text-muted">This is your main category</small>
          </div> 
         
          <div class="form-group">
            <label for="category_name">category</label>
            @php
              $category=App\Models\Category::all();
            @endphp
            
            <select class="form-control" name="category_id">
              @foreach ($category as $item)
              
              <option value="{{ $item->id }}">{{ $item->category_name }}</option>
              @endforeach
            </select>
              
        
           
            </div>  
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        <button type="Submit" class="btn btn-primary"><span class="loading d-none">...</span>  Submit</button>
      </div>
      </form>
    </div>
  </div>
</div>

{{-- edit modal --}}
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Category</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="modal_body">
        
      </div>
    </div>
  </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.js"></script>

<script type="text/javascript">
  $('.dropify').dropify();

</script>

<script type="text/javascript">

$(function subcategory(){
          table=$('.ytable').DataTable({
            processing:true,
            serverSide:true,
            ajax:"{{ route('subcategory.index') }}",
            columns:[
                {data:'DT_RowIndex',name:'DT_RowIndex'},
              {data:'category_name',name:'category_name'},
              {data:'subcategory_name',name:'subcategory_name'},
              {data:'subcategory_slug',name:'subcategory_slug'},	
                {data:'action',name:'action',orderable:true, searchable:true},

            ]
        });
    });


	$('body').on('click','.edit', function(){
		let cat_id=$(this).data('id');
		$.get("subcategory/edit/"+cat_id, function(data){
			 $("#modal_body").html(data);
		});
	});



      //store coupon ajax call
    $('#add_form').submit(function(e){
        e.preventDefault();
        $('.loading').removeClass('.d-none');
        var url = $(this).attr('action');
        var request =$(this).serialize();
        $.ajax({
          url:url,
          type:'post',
          async:false,
          data:request,
          success:function(data){  
            toastr.success(data);
            $('#add_form')[0].reset();
            $('.loading').addClass('.d-none');
            $('#subcategoryModal').modal('hide');
            table.ajax.reload();
          }
        });
      });

      //delete
        $(document).ready(function(){
              $(document).on('click', '#delete_category',function(e){
                  e.preventDefault();
                  var url = $(this).attr('href'); 
                  $("#deleted_form").attr('action',url); 
                  swal({
                      title: "Are you sure?",
                      text: "Once deleted, you will not be able to recover this imaginary file!",
                      icon: "warning",
                      buttons: true,
                      dangerMode: true,
                    })
                    .then((willDelete) => {
                    if (willDelete) {
                       $("#deleted_form").submit();
                    } else {
                       swal("Your imaginary file is safe!");
                    }
                  });
               });
      
              //data passed through here
              $('#deleted_form').submit(function(e){
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
                    $('#deleted_form')[0].reset();
                     table.ajax.reload();
                  }
                });
              });
          });
      
      

</script>

@endsection