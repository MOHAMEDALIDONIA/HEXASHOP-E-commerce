@extends('layouts.frontend')
@section('title','Order Items')
@section('content')
<div class="row" style="margin-top: 130px;">
    <h5 style="">Order Items({{$order->orderItem->sum('quantity')}}).<h5> if you want back click here <a href="{{url('user-orders-view')}}" style="font-size: 22px;color:red;" >(Back)</a></h5></h5>
 
    <hr>
    <div class="table-responsive">
        <table class="table table-bordered ">
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
              <td colspan="6"> No order item Available</td>
            </tr>
              
           @endforelse
          
           <tr>
            <td colspan="5" class="fw-bold">Total Price:</td>
            <td colspan="1" class="fw-bold">${{$totalprice}}</td>
          </tr>
          </tbody>
        </table>
     
      </div>
     
</div>
@endsection