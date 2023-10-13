@extends('layouts.admin')
@section('admin_content')
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.css">
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Ware Houes</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <button class="btn btn-primary" data-toggle="modal" data-target="#categoryModal"> + Add New</button>
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
                <h3 class="card-title">All ware Houes list here</h3>
              </div>
              <!-- /.card-header -->
                <div class="card-body">
                  <table id="example1" class="table table-bordered table-striped table-sm ytable">
                    <thead>
                    <tr>
                      <th>SL</th>
                      <th>warehoues Name</th>
                      <th>warehoues Slug</th>
                      <th>Address</th>
                      <th>phone</th>
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
<div class="modal fade" id="categoryModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add New warehoues</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{ route('warehoues.store') }}" method="Post" id="add_form" enctype="multipart/form-data">
      	@csrf
      <div class="modal-body">
        <div class="form-group">
            <label for="category_name">warehoues Name</label>
            <input type="text" class="form-control" id="warehouse_name" name="warehouse_name" required="">
        </div> 
        <div class="form-group">
          <label for="category_name">warehoues address</label>
          <input type="text" class="form-control" id="warehouse_address" name="warehouse_address" required="">
       </div> 
       <div class="form-group">
        <label for="category_name">warehoues phone</label>
        <input type="text" class="form-control" id="warehouse_phone" name="warehouse_phone" required="">
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

$(function category(){
          table=$('.ytable').DataTable({
            processing:true,
            serverSide:true,
            ajax:"{{ route('warehoues.index') }}",
            columns:[
                {data:'DT_RowIndex',name:'DT_RowIndex'},
              {data:'warehouse_name',name:'warehouse_name'},
              {data:'warehouse_slug',name:'warehouse_slug'},
              {data:'warehouse_address',name:'warehouse_address'},
              {data:'warehouse_phone',name:'warehouse_phone'},
                {data:'action',name:'action',orderable:true, searchable:true},

            ]
        });
    });


	$('body').on('click','.edit', function(){
		let cat_id=$(this).data('id');
		$.get("warehoues/edit/"+cat_id, function(data){
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
            $('#categoryModal').modal('hide');
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