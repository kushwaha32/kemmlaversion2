@extends('admin.layouts.app')
@section('pages')
 <!-- Content Header (Page header) -->
 <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Products</h1>
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
          <h3 class="card-title">Add New Product</h3>
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
        <form method="POST" action="@if(isset($product)) {{route('admin.product.update', $product)}} @else {{route('admin.product.store')}} @endif" enctype = "multipart/form-data">
          <div class = "row">
                <div class="col-md-8">
                   @csrf  
                   @if(isset($product)) 
                     @method('put')
                   @endif                         
                    <div class="card-body">
                    <div class="form-group">
                        <label for="texturl">Title</label>
                        <input type="text" name="title" class="form-control" id="texturl" value="{{@$product->title}}" placeholder="title">
                        <p class="small">http://localhost /<span id="url">{{@$product->slug}}</span></p>
                        <input type="hidden" name="slug" id="slug" value="{{@$product->slug}}">
                    </div>
                    <div class="form-group">
                        <label for="editor">Description</label>
                        <textarea name="discription" class="form-control" id="editor" cols="30" rows="10">{{@$product->description}}</textarea>
                    </div>
                    <div class="form-group">
                        <div class="row">
                              <div class="col-md-6">
                                <label for = "price">Price</label>
                                <div class="input-group mb-3">
                                  <div class="input-group-prepend">
                                    <span class="input-group-text">&#8377;</span>
                                  </div>
                                  <input type="text" class="form-control" placeholder="0.00" id = "price" name="price" value="{{@$product->price}}">
                                </div>
                              </div>
                              <div class="col-md-6">
                                <label for = "discount">Discount</label>
                                <div class="input-group mb-3">
                                  <div class="input-group-prepend">
                                    <span class="input-group-text">&#8377;</span>
                                  </div>
                                  <input type="text" class="form-control" placeholder="0.00" id = "discount" name="discount" value = "{{@$product->discount}}">
                                </div>
                              </div>
                        </div>
                        
                    </div>       
                    </div>
                    <!-- /.card-body -->
                </div>
                <div class="col-md-4">
                    <div class = "border border-top-0 border-right-0 border-bottom-0">
                    <h3 class="mt-4 p-3 pro-side-h">Status</h3>
                    <div class="form-group my-3 px-3">
                        <select class="custom-select" name = "status">
                          <option value = "0" @if(isset($product) && $product->status == 0) {{'selected'}} @endif>Pending</option>
                          <option value = "1" @if(isset($product) && $product->status == 1) {{'selected'}} @endif>Publish</option>
                        </select>
                      </div>
                      <h3 class="mt-4 p-3 pro-side-h">Featured Image</h3>
                      <div class = "px-3 mt-3">
                        <div class="custom-file mb-3">
                          <input type="file" class="custom-file-input inputFileGet" id="customFile" name="thumbnail">
                          <label class="custom-file-label" for="customFile">Choose file</label>
                        </div>
                          <img src="@if(isset($product)) {{asset('storage/'.$product->thumbnail)}} @else {{asset('storage/images/tDPMH.png')}} @endif" class = "img-thumbnail" alt="">
                          <div class="input-group my-3">
                            <div class="input-group-prepend">
                              <div class="input-group-text">
                                <input type="checkbox" id = "featuredPro" @if(isset($product) && $product->featured == 1) {{'checked'}} @endif name = "featuredproduct" value = ""> 
                              </div>
                            </div>
                            <label class="form-control" for="featuredPro">Featured Product</label>
                          </div>
                         
                      </div>
                      @php
                         $ids = (isset($product) && $product->categories->count() > 0) ? Arr::pluck($product->categories->toArray(), 'id') : null ;
                        
                      @endphp
                      <h3 class="mt-4 p-3 pro-side-h">Select Category</h3>
                      <div class="form-group px-3 my-3">
                        <select name="category_id[]" id="parent_id" class="form-control js-example-basic-multiple" multiple="multiple">
                            @if($categories->count() > 0)
                              @foreach($categories as $category)
                                <option value="{{$category->id}}" @if(!is_null($ids) && in_array($category->id, $ids)) {{'selected'}} @endif> {{$category->title}}</option>
                              @endforeach
                            @endif
                        </select>
                    </div>

                      <div class="card-footer">
                      @if(isset($product))
                      <input type="submit" name="submit" class="btn btn-primary" value="Update Product">
                      @else
                      <input type="submit" name="submit" class="btn btn-primary" value="Add Product">
                      @endif
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
          // Featured pro
          $('#featuredPro').on('change', function(){
              if($(this).is(':checked')){
                $(this).val(1);
              }else{
                $(this).val(0);
              }
               
          });// end Featured pro

       });
       $(".custom-file-input").on("change", function() {
          var fileName = $(this).val().split("\\").pop();
          $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
        });
   
   </script>

@endsection