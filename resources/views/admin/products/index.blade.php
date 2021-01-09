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
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">All Products</h3>
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
                      <th>Category</th>
                      <th>Price</th>
                      <th>Discount</th>
                      <th>thumbnail</th>
                      <th>Date Created</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                     @if($products->count() > 0)
                         @php
                            $i = 1;
                         @endphp
                        @foreach($products as $product)
                        <tr>
                          <input type="hidden" class="proDel_val_id" value="{{$product->id}}">
                          <td>{{$i++}}</td>
                          <td>{{ $product->title }}</td>
                          <td>{{ $product->description }}</td>
                          <td>
                            @if($product->categories()->count() > 0)
                                @foreach($product->categories as $children)
                                    {{ $children->title }}
                                @endforeach
                            @else
                                {{ "Product" }}
                            @endif
                         
                          
                          </td>
                          <td>{{ $product->price }}&#8377;</td>
                          <td>{{ $product->discount }}&#8377;</td>
                          <td><img src="{{asset('storage/'.$product->thumbnail)}}" class="img-thumbnail" alt=""></td>
                          <td>{{ $product->created_at }}</td>
                          <td>
                             @if(request()->url() == route('admin.product.trash'))
                              <a href="{{route('admin.product.recoverpro', $product->id)}}" class="btn btn-info btn-success mb-2 text-white" 
                              data-toggle="tooltip"  data-placement = "top" title="Recover">Recover</a> 
                              <button type="button" class="btn btn-info btn-danger proDelbtn" title = "Delete">
                                 Delete
                              </button> 
                             @else
                             <a href="{{route('admin.product.edit', $product->id)}}" class="btn btn-info btn-success mb-2 text-white" 
                              data-toggle="tooltip"  data-placement = "top" title="Edit"><i class="fas fa-edit"></i></a> 
                              <a href="{{route('admin.product.remove', $product->id)}}" class="btn btn-success"
                              data-toggle="tooltip"  data-placement = "top" title="Trash"><i class="fas fa-trash fs"></i></a>
                             
                             @endif                    
                          </td>
                        </tr>
                        @endforeach
                     @else
                       <tr><td colspan = "7">No Products found...</td></tr>
                     @endif
                     
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
              <div class="card-footer clearfix">
                    {{ $products->links()}}
              </div>

            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
      </div><!-- /.container-fluid -->
    </section>
    
    
@endsection


@section('proscript')

<script>
          
          $(document).ready(function(){

                  // ajax header setup
                   $.ajaxSetup({
                       header:{
                         'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
                       }
                   });
                   //. end ajax header setup
                   // click event to proDelBtn
              $('.proDelbtn').on('click', function(e){
                   e.preventDefault();
                   var delete_id = $(this).closest('tr').find('.proDel_val_id').val();
                   //sweet alert initialization
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
                          url:'/product/'+delete_id,
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