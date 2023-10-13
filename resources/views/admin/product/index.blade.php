@extends('layouts.admin')
@section('admin_content')
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.css">
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Product list </h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              
              <a class="btn btn-success" href="{{ route('product.create') }}">+ Add New</a>
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
                <h3 class="card-title">All Product  list </h3>
              </div>
              <!-- /.card-header -->
                <div class="card-body">
                  <div class="container">
                    <div class="row">
                      <div class="col-sm">
                      <h4>category</h4>
                        <select name="category_id" id="category_id" class="submited">
                          <option value="">All</option>
                          @foreach ($category as $row )
                          
                            <option value="{{ $row->id }}">{{ $row->category_name }}</option>
                          @endforeach
                        </select>
                      </div>
                      <div class="col-sm">
                        <h4>Brand</h4>
                        <select name="brand_id" id="brand_id" class="submited">
                          <option value="">All</option>
                          @foreach ($brand as $row )
                         
                            <option value="{{ $row->id }}">{{ $row->brand_name }}</option>
                          @endforeach
                        </select>
                      </div>
                      <div class="col-sm">
                        <h4>warehouse</h4>
                        <select name="warehoues" id="warehoues" class="submited">
                          <option value="">All</option>
                          @foreach ($warehouse as $row )
                         
                            <option value="{{ $row->id }}">{{ $row->warehouse_name }}</option>
                          @endforeach
                        </select>
                      </div>

                      <div class="col-sm">
                        <h4>status</h4>
                        <select name="status" id="status" class="submited">
                          <option value="2">All</option>
                          <option value="1">Active</option>
                          <option value="0">Deactive</option>
                        </select>
                      </div>
                    </div>
                  </div> 
                  <table id="example1" class="table table-bordered table-striped table-sm ytable">
                    <thead>
                    <tr>
                      <th>SL</th>
                      <th>thumbnail</th>
                      <th>Name</th>
                      <th>code</th>
                      <th>category</th>
                      <th>subcategory </th>
                      <th>brand</th>
                      <th>featured</th>
                      <th>today deal</th>
                      <th>status</th>
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
            "processing":true,
            "serverSide":true,
            "searching":true,
              "ajax":{
                "url": "{{ route('product.index') }}", 
                "data":function(e) {
                  e.category_id =$("#category_id").val();
                  e.brand_id =$("#brand_id").val();
                  e.status =$("#status").val();
                  e.warehouse =$("#warehouse").val();
                }
              },
            columns :[
                {data:'DT_RowIndex',name:'DT_RowIndex'},
                {data:'thumbnail',name:'thumbnail'},
                {data:'name',name:'name'},
              {data:'code',name:'code'},
              {data:'category_name',name:'category_name'},
              {data:'subcategory_name',name:'subcategory_name'},
              {data:'brand_name',name:'brand_name'},
              {data:'featured',name:'featured'},
              {data:'today_deal',name:'today_deal'},
              {data:'status',name:'status'},
                {data:'action',name:'action',orderable:true, searchable:true},

            ]
        });
    });

  //deactive featured
	$('body').on('click','.deactive_featured', function(){
		let id=$(this).data('id');
      let url ="{{ url('product/on-featured') }}/"+id;
       $.ajax({
        type: "get",
        url:url,  
        success: function (data) {
          toastr.success(data);
         table.ajax.reload();   
        }
       });
	});

   //active featured
	$('body').on('click','.active_featured', function(){
		let id=$(this).data('id');
      let url ="{{ url('product/active-featured') }}/"+id;
       $.ajax({
        type: "get",
        url:url,  
        success: function (data) {
          toastr.success(data);
         table.ajax.reload();   
        }
       });
	});
//today
  $('body').on('click','.deactive_today', function(){
		let id=$(this).data('id');
      let url ="{{ url('product/on-today') }}/"+id;
      $.ajax({
			url:url,
			type:'get',
			success:function(data){  
	        toastr.success(data);
          $('.ytable').DataTable().ajax.reload();
	      }
	  });
	});

  $('body').on('click','.active_today', function(){
		let id=$(this).data('id');
      let url ="{{ url('product/active-today') }}/"+id;
      $.ajax({
			url:url,
			type:'get',
			success:function(data){  
	        toastr.success(data);
          $('.ytable').DataTable().ajax.reload();
	      }
	  });
	});

  //status
  $('body').on('click','.deactive_status', function(){
		let id=$(this).data('id');
      let url ="{{ url('product/on-status') }}/"+id;
      $.ajax({
			url:url,
			type:'get',
			success:function(data){  
	        toastr.success(data);
	        $('.ytable').DataTable().ajax.reload();
	      }
	  });
	});

  $('body').on('click','.active_status', function(){
		let id=$(this).data('id');
      let url ="{{ url('product/active-status') }}/"+id;
      $.ajax({
			url:url,
			type:'get',
			success:function(data){  
	        toastr.success(data);
	        $('.ytable').DataTable().ajax.reload();
	      }
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
                    $('.ytable').DataTable().ajax.reload();
                  }
                });
              });
          });
      
     //ajax seaching 
     $('body').on('click','.submited', function(){
        $('.ytable').DataTable().ajax.reload();   
      });


</script>

@endsection