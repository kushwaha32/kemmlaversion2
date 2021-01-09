@extends('admin.layouts.app')
@section('pages')
 <!-- Content Header (Page header) -->
 <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Customer</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard v1</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <section class="content">
     <div class="container-fluid">
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
         <!-- general form elements -->
         <div class="card card-primary box box-primary">
         <div class="card-header">
          <h3 class="card-title">Create Profile</h3>
        </div>  
        @if($errors->any())
            <div class = "alert alert-danger mx-2 mt-3">
                <ul>
                  @foreach($errors->all() as $error)
                      <li>{{ $error }}</li>
                  @endforeach
                </ul>
            </div>
        @endif
        @if(session()->has('message'))
            <div class = "alert alert-success mx-2 mt-3">
                {{ session("message")}}
            </div>
        @endif                           
        <!-- /.card-header -->
        <!-- form start -->
         
        
        <form method="POST" action="{{ route('admin.customer.store')}}" enctype = "multipart/form-data">
          <div class = "row">
                <div class="col-md-8">
                   @csrf    
                    <div class="card-body">
                    <div class="form-group row">
                      <div class="col-sm-6">
                        <label for="texturl">Name</label>
                        <input type="text" name="name" class="form-control" id="texturl" value="" placeholder="title">
                        <p class="small">http://localhost /<span id="url"></span></p>
                        <input type="hidden" name="slug" id="slug" value="">
                      </div>
                      <div class="col-sm-6">
                        <label for="email">Email</label>
                        <input type="text" name="email" class="form-control" id="email" placeholder ="Email">
                      </div>
                        
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-6">
                            <label for="address">Address</label>
                            <input type="text" name="address" class="form-control" id="address" placeholder="Address">
                        </div>
                        <div class="col-sm-6">
                            <label for="contactNo">Contact No</label>
                            <input type="text" name="contact_no" class="form-control" id="contactNO" placeholder="Contact No">
                        </div>
                        
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-6">
                            <label for="password">Password</label>
                            <input type="password" name="password" class="form-control" id="password" placeholder="password">
                        </div>
                        <div class="col-sm-6">
                            <label for="re_type_password">Re-Type Password</label>
                            <input type="password" name="re_type_password" class="form-control" id="contacre_type_passwordtNO" placeholder="Re-Type-Password">
                        </div>
                    </div>
                    <div class="form-group">
                           <label for="status">Select Status</label>
                           <select name="status" id = "status" class="custom-select">
                                <option selected>-- Select Status --</option>
                                <option value="1">Blocked</option>
                                <option value="0">Active</option>
                            </select>
                    </div>
                     <!-- <div class="form-group">
                           <label for="role">Select Role</label>
                           <select name="role" id = "role" class="custom-select text-capitalize">
                                <option selected>-- Select Role --</option>
                                @if(isset($roles) && $roles->count() > 0)
                                   @foreach($roles as $role)
                                     <option value="{{ $role->id }}">{{ $role->name }}</option>
                                   @endforeach
                                @endif
                            </select>
                     </div> -->
                
                    <div class="form-group row">
                       <div class="col-sm-4">
                           <label for="country">Select Country</label>
                           <select name="country" id = "country" class="custom-select countryJsTrig text-capitalize">
                                <option selected>-- Select Country --</option>
                                @if(isset($countries) && $countries->count() > 0)
                                  @foreach($countries as $country)
                                    <option value="{{ $country->id }}">{{ $country->name }}</option>
                                  @endforeach
                                @endif
                            </select>
                       </div>
                       <div class="col-sm-4">
                           <label for="state">Select State</label>
                           <select name="state" id = "state" class="custom-select stateJsTrig text-capitalize">
                                <option selected>-- Select state --</option>
                                
                            </select>
                       </div>
                       <div class="col-sm-4">
                           <label for="city">Select City</label>
                           <select name="city" id = "city" class="custom-select cityJsTrig text-capitalize">
                                <option selected>-- Select City --</option>
                            </select>
                       </div>
                    </div>    
                    </div>
                    <!-- /.card-body -->
                </div>
                <div class="col-md-4">
                    <div class = "border border-top-0 border-right-0 border-bottom-0">
                      <h3 class="mt-4 p-3 pro-side-h">Image</h3>
                      <div class = "px-3 mt-3">
                        <div class="custom-file mb-3">
                          <input type="file" class="custom-file-input inputFileGet" id="customFile" name="thumbnail">
                          <label class="custom-file-label" for="customFile">Choose file</label>
                        </div>
                          <img src="{{asset('storage/images/tDPMH.png')}}" class = "img-thumbnail" alt="">
                      </div>
                      <div class="card-footer">
                      <input type="submit" name="submit" class="btn btn-primary" value="Create User">
                      </div>
                    </div>
                    
                </div>
          </div>
        
  </form>
  
</div>
<!-- /.card -->
</div>
<!--/.col (left) -->
</div>
<!-- /.row -->
</div><!-- /.container-fluid -->
</section>
    
    
@endsection


@section('proscript')
   <script>
       $(function(){
          $('#texturl').on('keyup', function(){
             var url = slugify($(this).val());
             $('#url').html(url);
             $('#slug').val(url)
          });
          // showing img after file selection
          $('.inputFileGet').on('change', function(){
                const file = this.files[0];
                if(file){
                  const reader = new FileReader();
                  $(reader).on("load", function(){
                    $(".img-thumbnail").attr("src", this.result);
                  });
                  reader.readAsDataURL(file);
                }else{
                  $(".img-thumbnail").attr("src", asset('storage/images/tDPMH.png'));
                }
          }); // end showing img after file selection
          // ajax header stup
          $.ajaxSetup({
               headers:{
                 'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
               }
          });
         // country automation start
             $('.countryJsTrig').on('change', function(){
                 $('.stateJsTrig').val(null);
                 $('.stateJsTrig option').remove();
                const id = $('.countryJsTrig option:selected').val(); 
                $.ajax({
                     type:'GET',
                     url:"{{route('admin.state')}}/" + id
   
                }).then(function(data){
                    
                     for(i=0; i<data.length; i++)
                     {
                       var item = data[i]
                       var stateString = new Option(item.name, item.id, false, true);
                       $('.stateJsTrig').append(stateString);
                     }
                     var stateString = '<option selected>-- Select state --</option>';
                    $('.stateJsTrig').append(stateString);
                });

             });
         // country automation end
         // state automation
         $('.stateJsTrig').on('change', function(){
                 $('.cityJsTrig').val(null);
                 $('.cityJsTrig option').remove();
                const id = $('.stateJsTrig option:selected').val(); 
                $.ajax({
                     type:'GET',
                     url:"{{route('admin.city')}}/" + id
   
                }).then(function(data){
                    
                     for(i=0; i<data.length; i++)
                     {
                       var item = data[i]
                       var stateString = new Option(item.name, item.id, false, true);
                       $('.cityJsTrig').append(stateString);
                     }
                     var stateString = '<option selected>-- Select state --</option>';
                    $('.cityJsTrig').append(stateString);
                });

             });

         // end state automation

       });
       $(".custom-file-input").on("change", function() {
          var fileName = $(this).val().split("\\").pop();
          $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
        });
   
   </script>

@endsection