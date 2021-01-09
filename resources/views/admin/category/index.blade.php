@extends('admin.layouts.app')
@section('pages')
     <!-- Content header -->
     <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Category</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Simple Tables</li>
            </ol>
          </div>
        </div>
      </div>
    </section>
     <!-- /.Content header -->
     <!-- Main Content -->
     <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">All Category</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class = "row">
                <div class = "col-12">
                  @if(session()->has('message'))
                    <div class= "alert alert-success">
                      {{session('message')}}
                    </div>
                  @endif
                </div>
              </div>
                <table class="table table-bordered table-responsive-sm">
                  <thead>                  
                    <tr>
                      <th>#</th>
                      <th>Title</th>
                      <th>Description</th>
                      <th >Slug</th>
                      <th >Category</th>
                      <th >Created At</th>
                      <th >Action</th>
                    </tr>
                  </thead>
                  <tbody>
                     @if($categories)
                    @php
                          $i = 1 
                    @endphp
                        @foreach($categories as $category)
                             <tr>
                                <input type="hidden" class = "catDel_val_id" value = "{{$category->id}}">
                                <td>{{ $i++ }}</td>
                                <td>{{ $category->title }}</td>
                                <td>{{ $category->description }}</td>
                                <td>{{ $category->slug}}</td>
                                <td>
                                   @if($category->childrens->count() > 0)
                                       @foreach( $category->childrens as $children )
                                          {{ $children->title }},
                                       @endforeach
                                   @else
                                     <strong>{{ "Parent Category" }}</strong>
                                   @endif
                                </td>
                                <td>{{ $category->created_at }}</td>
                                <td>
                                   
                                   @if(request()->url() == route('admin.category.trash'))
                                   <a href = "{{route('admin.category.recovercat', $category->id)}}" class = "btn btn-info btn-success">
                                      Recover
                                    </a> 
                                   @else
                                    <a href = "{{route('admin.category.edit', $category->id)}}" class = "btn btn-info btn-success">
                                      Edit
                                    </a> | 
                                    <a href="{{route('admin.category.remove', $category->id)}}" class = "btn btn-success">Remove</a>
                                   <button type = "button" class = "btn btn-info btn-danger catDelbtn">
                                      <i class = "fas fa-trash"></i>
                                    </button>
                                   @endif
                                   
                                </td>
                            </tr>
                        @endforeach
                      @else
                       <tr>
                          <td colspan = "5">No Category Found..</td>
                       </tr>
                     @endif
                   
                    
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
              <div class="card-footer clearfix">
                <ul class="pagination pagination-sm m-0 float-right">
                {{ $categories->links() }}
                </ul>
              </div>
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
         
        </div>
       
      </div><!-- /.container-fluid -->
    </section>    
     <!-- /.Main Content -->
@endsection

@section('catscript')
    <script>
       
        $(document).ready(function(){
           // Setup ajax header
           $.ajaxSetup({
             header:{
               'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
             }
           });
           // ./ Setup ajax header
           // apply event to delete category btn
           $('.catDelbtn').on('click', function(e){
                e.preventDefault();
                var delete_id = $(this).closest("tr").find('.catDel_val_id').val();
              
                
                swal({
                    title: "Are you sure?",
                    text: "Once deleted, you will not be able to recover this data!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                  })
                  .then((willDelete) => {
                    if (willDelete) {
                        var data = {
                          "_token":'{{ csrf_token() }}',
                          "id":delete_id,
                        };
                        $.ajax({
                          type:"DELETE",
                          url:'/category/'+delete_id,
                          data:data,
                          success:function(response){
                            swal(response.status,{
                              icon:"success",
                            }).then((result)=>{
                                location.reload();
                            });
                          }
                        });

                      
                    } 
                  });
                
           });
        });
      
    </script>

@endsection