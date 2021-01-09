@extends('admin.layouts.app')
@section('pages')
 <!-- Content Header (Page header) -->
 <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Category</h1>
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
    <!-- body of category -->
   <section class = "content">
    
   <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary box box-primary">
              <div class="card-header">
                @if(isset($category))
                <h3 class="card-title">Edit Category</h3>
                @else
                <h3 class="card-title">Add New Category</h3>
                @endif
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
              <form method = "POST" action = "@if(isset($category)) {{route('admin.category.update', $category->id)}}
               @else {{ route('admin.category.store') }} @endif">
                 @csrf
                 @if(isset($category))
                    @method('PUT')
                 @endif
                <div class="card-body">
                  <div class="form-group">
                    <label for="texturl">Title</label>
                    <input type="text" name = "title" class="form-control" id="texturl" value = "{{@$category->title}}" 
                    placeholder="title">
                    <p class = "small">{{ config('app.url') }} /<span id = "url">{{@$category->slug}}</span></p>
                    <input type = "hidden" name = "slug" id = "slug" value = "{{@$category->slug}}">
                  </div>
                  <div class="form-group">
                    
                    <label for="editor">Description</label>
                    <textarea name="description" class = "form-control" id="editor" cols="30" rows="10"></textarea>
                  </div>
                  <div class="form-group">
                     @php 
                        $ids = (isset($category->childrens) && $category->childrens->count() > 0) ? 
                        Arr::pluck($category->childrens, 'id') : null
                     @endphp
                    <label for="parent_id">Select Category</label>
                    <select name="parent_id[]" id="parent_id" class = "form-control js-example-basic-multiple" multiple="multiple">
                       @if(isset($categories))
                           <option value="0">Top Level</option>
                           @foreach($categories as $cat)
                             <option value="{{ $cat->id}}" @if(!is_null($ids) && in_array($cat->id, $ids)) {{'selected'}} @endif>{{ @$cat->title}}</option>
                           @endforeach
                       @endif
                       option
                    </select>
                  </div>
                
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                   @if(isset($category))
                   <input type="submit" name = "submit" class = "btn btn-primary" value = "Edit Category">
                   @else
                  <input type="submit" name = "submit" class = "btn btn-primary" value = "Add Category">
                  @endif
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
    <!-- /.body of category -->
@endsection

@section('script')
   <script type = "text/javascript">
       $(function(){
          $('#texturl').on('keyup', function(){
             var url = slugify($(this).val());
             $('#url').html(url);
             $('#slug').val(url)
          });
          //$('#parent_id').select2(); 
       });
       $(document).ready(function() {
            $('.js-example-basic-multiple').select2();
        });
   </script>

@endsection