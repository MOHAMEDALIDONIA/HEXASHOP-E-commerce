@extends('layouts.admin')
@section('content')
 
   @if (session('message'))
    <h2 class="alert alert-success">{{session('message')}}</h2>
   @endif
   <div class="row">
    <div class="col-sm-4 grid-margin">
      <div class="card" style="height:300px;">
        <div class="card-body">
          <h3>Total Products</h3>
          <div class="row">
            <div class="col-8 col-sm-12  my-auto">
              
            
              @foreach ($categories as $item)
                <h6 class="text-white font-weight-normal">{{$item->name}}->>({{$item->products()->sum('quantity')}})</h6>
              @endforeach
              <hr>
              <div class="d-flex d-sm-block d-md-flex align-items-center">
                <h4 class="mb-0">Total Products ->>({{$total_products}})</h4>
               
              </div>
            </div>
            
          </div>
        </div>
      </div>
    </div>
    <div class="col-sm-4 grid-margin">
      <div class="card" style="height:300px;">
        <div class="card-body">
          <h3>Number of Orders </h3>
          <div class="row">
            <div class="col-8 col-sm-12  my-auto">

              <h6 class="text-white font-weight-normal">Cash On Delivary->>({{$order_cash->count()??0}})</h6>
              
              <h6 class="text-white font-weight-normal">Online Payment->>({{$order_online->count()??0}})</h6>
              <hr>
              <div class="d-flex d-sm-block d-md-flex align-items-center">
                <h4 class="mb-0">Total Orders->>({{$total_orders}})</h4>
                
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>
    <div class="col-sm-4 grid-margin">
      <div class="card" style="height:300px;">
        <div class="card-body">
          <h3>Total gain</h3>
          <div class="row">
            <div class="col-8 col-sm-12  my-auto">
              
              <h6 class="text-white font-weight-normal">The price of products from the factory->>${{$totalOriginalPrice}}</h6>
              <h6 class="text-white font-weight-normal">The selling price of products->>${{$totalSellingPrice}}</h6>
              <h6 class="text-white font-weight-normal">The discount price of products->>${{$totalDiscountPrice}}</h6>
              <hr>
              <div class="d-flex d-sm-block d-md-flex align-items-center">
                <h4 class="mb-0">Total gain->>(${{$totalSellingPrice-$totalOriginalPrice-$totalDiscountPrice}})</h4>
                
              </div>
            </div>
        
          
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="row ">
    <div class="col-12 grid-margin">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">Order Today </h4>
          
           <h4>Today Date:({{date('Y-m-d')}})</h4>
          
          ,if you want see more-><a href="{{url('admin/orders/index')}}" style="color:red;a:hover{color:black;}">click here</a>
          <div class="table-responsive">
            <table class="table">
              <thead>
                <tr>
                
                  <th>Order ID</th>
                  <th>Tracking No</th>
                  <th>Username</th>
                  <th>Payment Mode</th>
                  <th>Location Type</th>
                  <th>Delivary Date</th>
                  <th>Ordered Date</th>
                  <th>Status Massage</th>
                  
                   <th>Discount Code</th> 
                  
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                @forelse ($orders_today as $order)
                    <tr>
                      <td>{{$order ->id}}</td>
                      <td>{{$order ->tracking_no}}</td>
                      <td>{{$order->fullname}}</td>
                      <td>{{$order->payment_mode}}</td>
                      <td>{{$order->location_type}}</td>
                      <td>{{$order->delivery_date}}</td>
                      <td>{{$order->created_at->format('Y-m-d')}}</td>
                      <td>{{$order->status_message}}</td>
                      @if ($order->users && $order->users->DiscountCode)
                        <td>({{$order->users->DiscountCode->discount_code}})//Percentage(%{{$order->users->DiscountCode->discount_percentage}})</td> 
                        @else
                        <td>__</td>
                      @endif
                      <td><a href="{{url('admin/orders/view/'.$order->id.'/'.$order->user_id)}}" class="btn btn-primary btn-sm">View</a></td>
                  </tr>
                        
                    @empty
                    <tr>
                      <td colspan="9"> No order Available</td>
                    </tr>
                      
               @endforelse
              
            
              </tbody>
            </table>
            <div class="pagination justify-content-center mt-2">
              {{$orders_today->links() }}
          </div> 
         </div>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <div class="row">
            <div class="col-12">
              <div class="d-flex align-items-center align-self-start">
                <h3 class="mb-0">This Year Orders</h3>
                
              </div>
            </div>
           
          </div>
          <h2 class="text-white font-weight-normal mt-3">{{$thisYearOrders}}</h2>
          <br>
          <a href="{{url('admin/orders/index')}}" style="text-decoration-line: underline;">view</a>
        </div>
      </div>
    </div>
    <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <div class="row">
            <div class="col-12">
              <div class="d-flex align-items-center align-self-start">
                <h3 class="mb-0">This Month Orders</h3>
              
              </div>
            </div>
        
          </div>
          <h2 class="text-white font-weight-normal mt-3">{{$thisMonthOrders}}</h2>
          <br>
          <a href="{{url('admin/orders/index')}}" style="text-decoration-line: underline;">view</a>
        </div>
      </div>
    </div>
    <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <div class="row">
            <div class="col-12">
              <div class="d-flex align-items-center align-self-start">
                <h3 class="mb-0">Users</h3>
              
              </div>
            </div>
        
          </div>
          <h2 class="text-white font-weight-normal mt-3">{{$users ?? 0}}</h2>
          <br>
          <a href="{{url('admin/users/index')}}" style="text-decoration-line: underline;">view</a>
        </div>
      </div>
    </div>
    <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <div class="row">
            <div class="col-12">
              <div class="d-flex align-items-center align-self-start">
                <h3 class="mb-0">NO. Item Order</h3>
              
              </div>
            </div>
        
          </div>
          <h2 class="text-white font-weight-normal mt-3">{{$total_order_items->sum('quantity') ?? 0}}</h2>
          
        </div>
      </div>
    </div>
  </div>
  <div class="row ">
    <livewire:admin.order.delivery-order/>
  </div>
  <div class="row">
    <div class="col-md-4 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">Transaction History</h4>
          <canvas id="transaction-history" class="transaction-chart"></canvas>
          <div class="bg-gray-dark d-flex d-md-block d-xl-flex flex-row py-3 px-4 px-md-3 px-xl-4 rounded mt-3">
            <div class="text-md-center text-xl-left">
              <h6 class="mb-1">Transfer to Paypal</h6>
              <p class="text-muted mb-0">07 Jan 2019, 09:12AM</p>
            </div>
            <div class="align-self-center flex-grow text-right text-md-center text-xl-right py-md-2 py-xl-0">
              <h6 class="font-weight-bold mb-0">$236</h6>
            </div>
          </div>
          <div class="bg-gray-dark d-flex d-md-block d-xl-flex flex-row py-3 px-4 px-md-3 px-xl-4 rounded mt-3">
            <div class="text-md-center text-xl-left">
              <h6 class="mb-1">Tranfer to Stripe</h6>
              <p class="text-muted mb-0">07 Jan 2019, 09:12AM</p>
            </div>
            <div class="align-self-center flex-grow text-right text-md-center text-xl-right py-md-2 py-xl-0">
              <h6 class="font-weight-bold mb-0">$593</h6>
            </div>
          </div>
        </div>
      </div>
    </div>
   <livewire:to-do-list/>
  </div>   
  <div class="row ">
    <div class="col-12 grid-margin">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">Interactive Users</h4>
          <div class="table-responsive">
            <table class="table">
              <thead>
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
             
                @forelse ($latest_users as $user)
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
        </div>
      </div>
    </div>
  </div>
    
@endsection