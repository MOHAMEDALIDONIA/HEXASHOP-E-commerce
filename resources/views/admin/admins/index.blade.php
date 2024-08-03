@extends('layouts.admin')
@section('content')

<div class="row">
    @if (session('message'))
    <h3 class="alert alert-success">{{session('message')}}</h3>
    @endif
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card ">
          <div class="card-body">
            <h3 class="card-title">Admin Table(Count:{{$totalcount}})
                @if (auth()->guard('admin')->user()->hasPermission('admin-create'))
                   <a href="{{url('admin/admins/create')}}" class="btn btn-primary btn-m text-white float-end">Add Admin</a>
                @else
                   <a href="#" class="btn btn-primary btn-m text-white float-end disabled" aria-disabled="true">Add Admin</a>
                @endif
            </h3>
          
            <div class="table-responsive">
              <table class="table table-bordered text-white">
                <thead >
                  <tr>
                    <th>Id Admin</th>
                    <th> Name</th>
                    <th>Title</th>
                    <th>Email</th>
                    <th>Image</th>
                    <th> Action </th>
                  </tr>
                </thead>
                <tbody>
                 @forelse ($admins as $admin)
                 <tr>
                    <td>{{$admin ->id}}</td>
                    <td>{{$admin ->name}}</td>
                    <td>{{$admin->title}}</td>
                    <td>{{$admin->email}}</td>
                    <td>
                        @if ($admin->image != null)
                           <img src="{{url('storage/'.$admin->image)}}" alt="" style="width:70px;height:70px;"> 
                        @else
                            <img src="{{asset('/storage/userprofile.jpg')}}" alt="User Image" class="profile-image" style="width:70px;height:70px;">
                        @endif
                     
                    </td>
             
                    <td>
                    @if (auth()->guard('admin')->user()->hasPermission('admin-update'))
                        <a href="{{url('admin/admins/edit/'.$admin->id)}}">
                            <label class="badge badge-success">Edit</label> 
                        </a>
                    @else
                      <a href="#" class="btn btn-success btn-s text-white  disabled" aria-disabled="true">Edit</a>
                    @endif
                    @if (auth()->guard('admin')->user()->hasPermission('admin-delete'))    
                        <a href="#" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            <label  class="badge badge-danger">Delete</label> 
                        </a>
                           <!-- Modal -->
                      <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLabel">Delete User</h5>
                              <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            
                              <div class="modal-body">
                                <h4>Are you sure you want to delete this data?</h4>
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                               <a href="{{url('admin/admins/delete/'.$admin->id)}}"><button type="button" class="btn btn-primary">Yes,Delete</button></a>
                              </div>
                       
                       
                          </div>
                        </div>
                      </div>
                    @else
                        <a href="#" class="btn btn-danger btn-s text-white  disabled" aria-disabled="true">Delete</a>
                    @endif  
                     
                    </td>
                </tr>
                     
                 @empty
                  <tr>
                    <td colspan="7"> No user Available</td>
                  </tr>
                    
                 @endforelse
                
       
                </tbody>
              </table>
              
            </div>
            <br>
            {{-- <div class="pagination justify-content-center">
                {{$admins->links() }}
            </div> --}}
          </div>
        </div>
      </div>
</div>
@endsection