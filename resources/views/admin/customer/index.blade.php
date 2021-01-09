@extends('admin.layouts.app')
@section('pages')
     <!-- Content header -->
     <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Customer</h1>
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
                <h3 class="card-title">All Customer</h3>
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
                      <th>Name</th>
                      <th>Email</th>
                      <th>Contact</th>
                      <th>Created At</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                     @if(isset($users) && $users->count() > 0)
                    @php
                          $i = 1 
                    @endphp
                        @foreach($users as $user)
                             <tr>
                                <input type="hidden" class = "catDel_val_id" value = "{{$user->id}}">
                                <td>{{ $i++ }}</td>
                                <td class="text-capitalize"><a href="{{ route('admin.customer.show', $user->id) }}">{{ $user->name }}</a></td>
                                <td>{{ $user->email}}</td>
                                <td>{{ $user->profile->phone }}</td>
                                <td>{{ $user->created_at }}</td>
                                <td>
                                  
                                    <a href = "{{ route('admin.customer.edit', $user->id) }}" class = "btn btn-info btn-success">
                                      Edit
                                    </a> | 
                                    <a href="{{ route('admin.customer.remove', $user->id) }}" class = "btn btn-success">Remove</a>
                                  
                                </td>
                            </tr>
                        @endforeach
                      @else
                       <tr>
                          <td colspan = "5">No users Found..</td>
                       </tr>
                     @endif
                   
                    
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
              <div class="card-footer clearfix">
                <ul class="pagination pagination-sm m-0 float-right">
               
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