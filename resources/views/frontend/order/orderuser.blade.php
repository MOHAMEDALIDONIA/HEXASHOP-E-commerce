@extends('layouts.frontend')
@section('title','Order')
@section('content')
<div class="row">
    <div class="col-md-12 ">
        @if (session('message'))
        <h6 class="alert alert-success">{{session('message')}}</h6>
        @endif
        <div class="card" style="max-width:1440px;margin-top: 120px;">
            <div class="card-header">
              <h3>My orders({{$user_orders->count()}})
              </h3>
              <hr>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-striped">
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
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                      @forelse ($user_orders as $order)
                        <tr>
                            <td>{{$order ->id}}</td>
                            <td>{{$order ->tracking_no}}</td>
                            <td>{{$order->fullname}}</td>
                            <td>{{$order->payment_mode}}</td>
                            <td>{{$order->location_type}}</td>
                            <td>{{$order->delivery_date}}</td>
                            <td>{{$order->created_at->format('Y-m-d')}}</td>
                            <td>{{$order->status_message}}</td>
                            <td><a href="{{url('frontend/orders/view/items/'.$order->id)}}" class="btn btn-primary btn-sm">View order item</a></td>
                        </tr>
                          
                      @empty
                      <tr>
                        <td colspan="9"> <h4>NO orders. if you buy now visit link <a href="{{url('/productsview')}}" style="color: red;">shopping now</a></h4></td>
                       </tr>
                          
                      @endforelse
      


                    </tbody>


                </table>
            </div>
        </div>
    </div>
</div>  

@endsection
@section('script')
{{-- <meta name="csrf-token" content="{{ csrf_token() }}">
<script>
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
     $('#removewishlistitem').click(function(e) {
        e.preventDefault(); // Prevent default action (page reload)

        var WishListItemId = $(this).data('product-id'); // Get product_id from data attribute
        var thisClick = $(this);

        // AJAX request
        jQuery.ajax({
            url: "/frontend/wishlistitem/delete/"+WishListItemId, // Route to your Laravel controller action
            method: 'GET',
            data: {
                product_id: WishListItemId // CSRF token
                
            },
            success: function(response) {
                // Handle success response
                thisClick.closest('.wishlistitem-tr').remove();
                alert(response.message);
            },
            error: function(xhr, status, error) {
                // Handle error responses
                console.error('Error:', status, error);
                alert('Error adding product to wishlist.');
            }
        });
    });
  });


</script> --}}

@endsection