@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="col-md-12 ">
        @if (session('message'))
         <h6 class="alert alert-success mb-3">{{session('message')}}</h6>
        @endif

        <div class="card">
            <div class="card-header">
              <h3>My Orders Details
            
              </h3>

            </div>
            <div class="card-body">
                <h4 class="text-primary">
                    <i class="fa fa-shopping-cart text-dark"></i>My Order Details
                    <a href="{{url('admin/orders/index')}}" class="btn btn-danger btn-sm float-end mx-1">Back</a>
                    <a href="{{url('admin/invoice/generate/'.$order->id)}}" class="btn btn-primary btn-sm float-end mx-1">Download invoice</a>
                    <a href="{{url('admin/invoice/'.$order->id.'/view')}}" target="_blank" class="btn btn-warning btn-sm float-end mx-1">View invoice</a>
                    <a href="{{url('admin/invoice/'.$order->id.'/print')}}" target="_blank" class="btn btn-success btn-sm float-end mx-1">Print invoice</a>
                    <a href="{{url('admin/invoice/send-by-email/'.$order->id.'/'.$order->user_id)}}"  class="btn btn-info btn-sm float-end mx-1">Send invoice Via Mail</a>
                </h4>
                <hr>
                <div class="row">
                    <div class="col-md-6">
                        <h5>Order Details </h5>
                        <hr> 
                        <h6>Order Id:{{$order->id}}</h6>
                        <h6>Tracking Id/No:{{$order->tracking_no}}</h6>
                        <h6>Order Date:{{$order->created_at->format('d-m-Y h:i A')}}</h6>
                        <h6>Delivary Date:{{$order->delivery_date}}</h6>
                        <h6>Payment Mode:{{$order->payment_mode}}</h6>
                        <h6>Prefer Delivary Time: {{$order->prefer_delivary_time}}</h6>
                        <h6>Location Type:{{$order->location_type}}</h6>
                        @if($order->delivary_instructions != null)
                         <h6>Delivary Instructions:{{$order->delivary_instructions}}</h6>
                        @endif
                        <h6 class="border p-2 text-success">
                            Order Status Message: <span class="text-uppercase">{{$order->status_message}}</span>
                        </h6>
                    </div>
                    <div class="col-md-6">
                        <h5>User Details </h5>
                        <hr> 
                        <h6>Full Name:{{$order->fullname}}</h6>
                        <h6>Email Id:{{$order->email}}</h6>
                        <h6>Phone:{{$order->phone}}</h6>
                        <h6>Address:{{$order->address}}</h6>
                        <h6>Pin Code:{{$order->pincode}}</h6>
                        @if ($discount_user && $discount_user->DiscountCode)
                         <h6>DisCount Code:({{$discount_user->DiscountCode->discount_code}})</h6> 
                         <h6>Percentage Discount:(%{{$discount_user->DiscountCode->discount_percentage}})</h6>
                       @endif
                      
                    </div>
                </div>
                <br>
                <h5>Order Items({{$order->orderItem->sum('quantity')}})</h5>
                <hr>
                <div class="table-responsive">
                    <table class="table table-bordered text-white">
                      <thead >
                        <tr>
                          <th>Item Id</th>
                          <th> Image</th>
                          <th>Product</th>
                          <th>Price</th>
                          <th>Quantity</th>
                          <th> Total </th>
                        </tr>
                      </thead>
                      <tbody>
                        @php
                        $totalprice = 0 ;
                       @endphp
                       @forelse ($order->orderItem as $item)
                     
                       <tr>
                          <td>{{$item->id}}</td>
                          
                            @if ($item->productColor != null)
                               <td>{{$item->product->name}}-Color:{{$item->productColor->color->name}}</td>
                                
                            @else
                                <td>{{$item->product->name}}</td>
                            @endif
                          
                          <td>
                           @if($item->product->productImages) 
                            <img src="{{asset('storage/'.$item->product->productImages[0]->image)}}" style="width: 50px; height: 50px" alt="">
                           @else
                            <img src="" style="width: 50px; height: 50px" alt="">
                          @endif
                        </td>
                          <td>{{$item->price}}</td>
                          <td>{{$item->quantity}}</td>
                          <td>
                             {{$item->quantity * $item->price}}
                          </td>
                      </tr>
                        @php
                        $totalprice += $item->quantity * $item->price
                        @endphp
                           
                       @empty
                        <tr>
                          <td colspan="6"> No Color Available</td>
                        </tr>
                          
                       @endforelse
                       @if ($discount_user && $discount_user->DiscountCode)
                          <tr>
                            <td colspan="5" class="fw-bold">Total Before Discount:</td>
                            <td colspan="1" class="fw-bold">${{$totalprice}}</td>
                          </tr>
                          <tr>
                            <td colspan="5" class="fw-bold">Total Price:</td>
                            <td colspan="1" class="fw-bold">${{$totalprice-($totalprice*($discount_user->DiscountCode->discount_percentage/100))}}</td>
                          </tr>
                       @else
                        <tr>
                          <td colspan="5" class="fw-bold">Total Price:</td>
                          <td colspan="1" class="fw-bold">${{$totalprice}}</td>
                        </tr>
                       @endif
                  
                      </tbody>
                    </table>
                  </div>
        <div class="card border mt-3">
            <div class="card-body">
                <h4>Order Process (Order Status Updates)</h4>
                <hr>
                <div class="row">
                    <div class="col-md-5">
                        <form action="{{url('admin/orders/update/'.$order->id)}}" method="POST">
                            @csrf
                            @method('PUT')
                            
                            <label >Update Your Order Status</label>
                            <div class="input-group">
                                <select name="order_status"  class="form-select">
                                    <option value="">Select Orders Status</option>
                                    <option value="in progress"{{Request::get('status')== 'in progress'? 'selected':''}}>In Progress</option>
                                    <option value="completed"{{Request::get('status')== 'completed'? 'selected':''}}>Completed</option>
                                    <option value="cancelled"{{Request::get('status')== 'cancelled'? 'selected':''}}>Cancelled</option>
                                    <option value="out-for-delivery"{{Request::get('status')== 'out-for-delivery'? 'selected':''}}>Out for delivery</option>
                                  </select>
                                  <button type="submit" class="btn btn-primary text-white">Update</button>
                            </div>
                            <div class="col-md-7">
                                <br>
                                <h4 class="mt-3">Current Order Status: <span class="text-uppercase">{{$order->status_message}}</span></h4>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>   
@endsection