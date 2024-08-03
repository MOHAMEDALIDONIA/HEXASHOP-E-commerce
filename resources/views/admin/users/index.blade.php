@extends('layouts.admin')
@section('content')

<div class="row">
    @if (session('message'))
    <h3 class="alert alert-success">{{session('message')}}</h3>
    @endif
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card ">
          <div class="card-body">
            <h3 class="card-title">User Table(Count:{{$totalcount}})
                {{-- <a href="{{url('admin/color/create')}}" class="btn btn-primary btn-m text-white float-end">Add User</a> --}}
            </h3>
          
            <div class="table-responsive">
              <table class="table table-bordered text-white">
                <thead >
                  <tr>
                    <th>Id User</th>
                    <th> Name</th>
                    <th>Email</th>
                    <th>Image</th>
                    <th>Discount Code</th>
                    <th>Expiry Code Date</th>
                    <th>NO.of order</th>
                    <th> Action </th>
                  </tr>
                </thead>
                <tbody>
                @forelse ($users as $user)
                 <tr>
                    <td>{{$user ->id}}</td>
                    <td>{{$user ->name}}</td>
                    <td>{{$user->email}}</td>
                    <td>
                        @if ($user->image != null)
                           <img src="{{url('storage/'.$user->image)}}" alt="" style="width:70px;height:70px;"> 
                        @else
                            <img src="{{asset('/storage/userprofile.jpg')}}" alt="User Image" class="profile-image" style="width:70px;height:70px;">
                        @endif
                     
                    </td>
                    @if ($user->DiscountCode()->count()>0)
                      <td>{{$user->DiscountCode->discount_code}}//Percentage({{$user->DiscountCode->discount_percentage}}%)</td>
                      <td>{{$user->DiscountCode->expiry_date}}</td>
                    @else
                       <td>__</td> 
                       <td>__</td>
                    @endif
                 
                    <td>{{$user->Order->count()}}</td>
                    <td>
                        <a href="{{route('discount.form',$user->id)}}">
                            <label class="badge badge-success">Add discount_code</label> 
                        </a>
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
                               <a href="{{url('admin/users/'.$user->id.'/delete')}}"><button type="button" class="btn btn-primary">Yes,Delete</button></a>
                              </div>
                       
                       
                          </div>
                        </div>
                      </div>
                     
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
            <div class="pagination justify-content-center">
                {{$users->links() }}
            </div>
          </div>
        </div>
      </div>
</div>
@endsection