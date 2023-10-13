@extends('layouts.admin')
@section('admin_content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.6.0/bootstrap-tagsinput.css" integrity="sha512-3uVpgbpX33N/XhyD3eWlOgFVAraGn3AfpxywfOTEQeBDByJ/J7HkLvl4mJE1fvArGh4ye1EiPfSBnJo2fgfZmg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<script type="text/javascript" src="http://bootstrap-tagsinput.github.io/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js"></script>
<style type="text/css">
  .bootstrap-tagsinput .tag {
    background: #428bca;;
    border: 1px solid white;
    padding: 1 6px;
    padding-left: 2px;
    margin-right: 2px;
    color: white;
    border-radius: 4px;
  }
</style>


  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>website page</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Website page</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
       <form action="{{ route('website.setting.update',$setting->id)}}" method="post" id="edit_form" enctype="multipart/form-data">
        @csrf
       	<div class="row">
          <!-- left column -->
          <div class="col-md-8">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Add website</h3>
              </div>
              <!-- /.card-header -->
                <div class="card-body">
                  <div class="row">
                    <div class="form-group col-lg-6">
                      <label for="exampleInputEmail1">currency  <span class="text-danger">*</span> </label>
                       <select class="form-control" name="currency" id="">
                        <option  {{ $setting->currency =='৳' ? 'selected' : '' }}  value="৳">taka(৳)</option>
                        <option  {{ $setting->currency =='₹' ? 'selected' : '' }} value="₹">Rupee(₹)</option>
                        <option {{ $setting->currency =='$' ? 'selected' : '' }} value="$">Dollar($) </option>
                       </select>
                    </div>
                    <div class="form-group col-lg-6">
                      <label for="exampleInputPassword1">phone one <span class="text-danger">*</span> </label>
                      <input type="text" class="form-control"  name="phone_one" value="{{ $setting->phone_one }}"  required="">
                    </div>
                  </div>
                 
                 
                  <div class="row">
                    <div class="form-group col-lg-6">
                      <label for="exampleInputEmail1">phone two <span class="text-danger">*</span> </label>
                      <input type="text" class=form-control name="phone_two" value="{{ $setting->phone_two}}"   required="">
                    </div>
                    <div class="form-group col-lg-6">
                      <label for="exampleInputPassword1">email</label><br>
                      <input type="text" class="form-control"  name="main_email" value="{{ $setting->main_email }}" >
                    </div>
                  </div>
                  <div class="row">
                    <div class="form-group col-lg-6">
                      <label for="exampleInput">super email  </label>
                      <input type="email" class="form-control" name="support_email" value="{{ $setting->support_email }}" >
                    </div>
                   
                    <div class="form-group col-lg-6">
                      <label for="exampleInput">facebook  </label>
                      <input type="text" name="facebook"  class="form-control" value="{{ $setting->facebook }}" >
                    </div>
                  </div>
                  

                  <div class="row">
                    <div class="form-group col-lg-6">
                      <label for="exampleInputEmail1">twitter</label><br>
                      <input type="text" class="form-control"   name="twitter" value="{{ $setting->twitter }}"  />
                    </div>
                    <div class="form-group col-lg-6">
                      <label for="exampleInputPassword1">Instragram</label><br>
                      <input type="text" class="form-control"  name="instagram"  value="{{ $setting->instagram }}"  />
                    </div>
                  </div>

                  <div class="row">
                    <div class="form-group col-lg-6">
                      <label for="exampleInputEmail1">linkedin</label><br>
                      <input type="text" class="form-control"   name="linkedin"  value="{{ $setting->linkedin }}" />
                    </div>
                    <div class="form-group col-lg-6">
                      <label for="exampleInputPassword1">Youtube</label><br>
                      <input type="text" class="form-control"  name="youtube" value="{{ $setting->youtube }}"  />
                    </div>
                  </div>

                  <div class="row">
                    <div class="form-group col-lg-6">
                      <label for="exampleInputEmail1">logo   </label><br>
                      <input type="text" class="form-control" name="logo" value="{{ $setting->logo }}" >
                   
                    </div>
                    <div class="form-group col-lg-6">
                      <label for="exampleInputEmail1">Fivcon   <span class="text-danger">*</span> </label><br>
                      <input type="text" class="form-control" name="favicon" value="{{ $setting->favicon }}">
                   
                    </div>
                  </div>


                  <div class="row">
                    <div class="form-group col-lg-12">
                      <label for="exampleInputPassword1">address </label>
                      <textarea class="form-control textarea" name="address"> {{ $setting->address }} </textarea>
                    </div>
                  </div>

                  <button class="btn btn-info ml-2" type="submit">Submit</button>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
           </div>
            <!-- /.card -->
          <!-- right column -->
       
          
         </div>
        </form>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script type="text/javascript" src="https://jeremyfagis.github.io/dropify/dist/js/dropify.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://jeremyfagis.github.io/dropify/dist/css/dropify.min.css">
<script src="{{ asset('public/backend') }}/plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>


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
         $('#edit_form').ajax.reload();
        }
      });
    });
</script>

<script type="text/javascript">
  $('.dropify').dropify();  //dropify image
  $("input[data-bootstrap-switch]").each(function(){
      $(this).bootstrapSwitch('state', $(this).prop('checked'));
    });

</script>


@endsection