
<div class="row">
    <div class="col-md-12 ">
        <div class="card">
            <div class="card-header">
              <h3>My Orders (Count:{{$orders->count()}})
            
              </h3>
             <hr>
            </div>
            <div class="card-body">
                  <form wire:submit="filter" >
                    <div class="row">
                        <div class="col-md-3">
                            <label >Filter by Date</label>
                            <input type="date" wire:model.defer="date"  class="form-control">
                            @error('date')
                            <small class="form-text text-danger">{{$message}}</small> 
                            @enderror
                        </div>
                        <div class="col-md-3">
                            <label >Filter by Status</label>
                          <select wire:model.defer="status"  class="form-select">
                            <option value="">Select All Status</option>
                            <option value="in progress">In Progress</option>
                            <option value="completed">Completed</option>
                            <option value="cancelled">Cancelled</option>
                            <option value="out-for-delivery">Out for delivery</option>
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
                    <table class="table table-bordered text-white">
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
                          <td><a href="{{url('admin/orders/view/'.$order->id.'/'.$order->user_id)}}" class="btn btn-primary btn-sm">View</a></td>
                      </tr>
                           
                       @empty
                        <tr>
                          <td colspan="9"> No order Available</td>
                        </tr>
                          
                       @endforelse
                      
             
                      </tbody>
                    </table>
                    {{-- <div class="pagination justify-content-center">
                        {{$orders->links() }}
                    </div>  --}}
                  </div>

            </div>
            
        </div>
    </div>  
</div>             
