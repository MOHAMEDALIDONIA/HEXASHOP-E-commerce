<div class="col-12 grid-margin">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Order Delivary Today </h4>
        <h4>Today Date:({{date('Y-m-d')}})</h4>
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
              @forelse ($order_delivary_today as $order)
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
                      <a href="#" wire:click.prevent="cancel({{$order->id}})" class="btn btn-warning btn-sm">Cancelled</a>
                      <a href="#" wire:click.prevent="complete({{$order->id}})" class="btn btn-success btn-sm">Completed</a>
                    </td>
                </tr>
                      
                  @empty
                  <tr>
                    <td colspan="9"> No order Available</td>
                  </tr>
                    
             @endforelse
            
          
            </tbody>
          </table>
          {{-- <div class="pagination justify-content-center">
            {{$order_delivary_today->links() }}
        </div>  --}}
       </div>
      </div>
    </div>
  </div>
