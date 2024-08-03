@extends('layouts.admin')
@section('content')
<div class="row">
  @if (session('message'))
  <h3 class="alert alert-success">{{session('message')}}</h3>
  @endif
  <div class="col-md-12 ">
      <div class="card">
          <div class="card-header">
            <h3>My Orders (Count:{{$orders->count()}})
          
            </h3>
           <hr>
          </div>
          <div class="card-body">
                <form action="" method="GET" >
                  <div class="row">
                      <div class="col-md-3">
                          <label >Filter by Date</label>
                          <input type="date" name="date" value="{{Request::get('date') ?? date('Y-m-d')}}"  class="form-control">
                          @error('date')
                          <small class="form-text text-danger">{{$message}}</small> 
                          @enderror
                      </div>
                      <div class="col-md-3">
                          <label >Filter by Status</label>
                          <select name="status"  class="form-select">
                              <option value="">Select All Status</option>
                              <option value="in progress"{{Request::get('status')== 'in progress'? 'selected':''}}>In Progress</option>
                              <option value="completed"{{Request::get('status')== 'completed'? 'selected':''}}>Completed</option>

                              <option value="cancelled"{{Request::get('status')== 'cancelled'? 'selected':''}}>Cancelled</option>
                              <option value="out-for-delivery"{{Request::get('status')== 'out-for-delivery'? 'selected':''}}>Out for delivery</option>
                            </select>
                      </div>
                      <div class="col-md-6">
                          <br>
                          <button type="submit" class="btn btn-primary">Filter</button>
                      </div>
                  </div>
                </form>
                <hr>
                <div class="table-responsive">
                  <table class="table table-bordered text-white" id="orderTable">
                    <thead >
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
                   @forelse ($orders as $order)
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
                        <td>
                          <a href="{{url('admin/orders/view/'.$order->id.'/'.$order->user_id)}}" class="btn btn-primary btn-sm">View</a>
                          <a href="" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            <label  class="btn btn-danger btn-sm">Delete</label> 
                        </a>
                        <!-- Modal -->
                         <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Delete Order</h5>
                                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              
                                <div class="modal-body">
                                  <h4>Are you sure you want to delete this data?</h4>
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <a href="{{url('admin/order/'.$order ->id.'/delete')}}"><button type="button" class="btn btn-primary">Yes,Delete</button></a>
                                </div>
                        
                        
                            </div>
                          </div>
                         </div>
                        </td>
                    </tr>
                         
                     @empty
                      <tr>
                        <td colspan="9"> No order Available</td>
                      </tr>
                        
                  @endforelse
                    
           
                    </tbody>
                  </table>
                  <div class="pagination justify-content-center">
                      {{$orders->appends(request()->query())->links() }}
                  </div> 
                </div>

          </div>
          
      </div>
  </div>  
</div>

@endsection
@section('scripts')
<script>

  // Enable pusher logging - don't include this in production
  Pusher.logToConsole = true;

  var pusher = new Pusher('5aea90499ca2522eb917', {
    cluster: 'eu'
  });

  var channel = pusher.subscribe('order');
  channel.bind('orderdata', function(data) {
    
      
          // Get the table body
          var table = document.getElementById("orderTable").getElementsByTagName('tbody')[0];

          // Create a new row
          var newRow = table.insertRow();
      
      
          // Insert cells into the new row
          var cell1 = newRow.insertCell(0);
          var cell2 = newRow.insertCell(1);
          var cell3 = newRow.insertCell(2);
          var cell4 = newRow.insertCell(3);
          var cell5 = newRow.insertCell(4);
          var cell6 = newRow.insertCell(5);
          var cell7 = newRow.insertCell(6);
          var cell8 = newRow.insertCell(7);
          var cell9 = newRow.insertCell(8);
    

          // Add text to the new cells
          cell1.innerHTML = `${data.order.id}`;
          cell2.innerHTML = `${data.order.tracking_no}`;
          cell3.innerHTML = `${data.order.fullname}`;
          cell4.innerHTML = `${data.order.payment_mode}`;
          cell5.innerHTML = `${data.order.location_type}`;
          cell6.innerHTML = `${data.order.delivery_date}`;
          cell7.innerHTML = `${data.order.created_at}`;
          cell8.innerHTML = `${data.order.status_message}`;
        
          cell9.innerHTML = `${data.order.discount_code}`;
          let actionCell = newRow.insertCell(9);
          let anchor = document.createElement('a');
                  anchor.innerHTML = 'View';
                  anchor.href = '/admin/orders/view/' + data.order.id +'/'+data.order.user_id;
                  anchor.className = 'btn btn-primary btn-sm';
          // let anchor1 = document.createElement('a');
          // anchor1.innerHTML = 'Delete';
          // anchor1.href = '/admin/order/' + data.order.id +'/';
          // anchor1.className = 'btn btn-danger btn-sm';        
                  // Open in new tab if needed
                  actionCell.appendChild(anchor);
                  // actionCell.appendChild(anchor1);
  });
</script>
@endsection