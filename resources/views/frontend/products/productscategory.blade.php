@extends('layouts.frontend')
@section('title')
{{$category->name}}
@endsection
@section('content')



    
<!-- ***** Main Banner Area Start ***** -->
<div class="page-heading" id="top">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="inner-content">
                    <h2>{{$category->name}}</h2>
                    <span>{{$category->description}}</span>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- ***** Main Banner Area End ***** -->

<div class="section" id="products">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-heading">
                    <h2>Our Latest Products</h2>
                    <span>Check out all of our products.</span>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            @forelse ($products as $product)
            <div class="col-lg-4">
                <div class="item" style="height: 600px;">
                    <div class="thumb">
                        <div class="hover-content">
                            <ul>
                                <li><a href="{{url('/productview/'.$product->id)}}"><i class="fa fa-eye"></i></a></li>
                                <li><a href="{{url('frontend/addtowishlist/'.$product->id)}}"><i class="fa fa-star"></i></a></li>
                                
                            </ul>
                        </div>
                     
                        @if($product->productImages->count() > 0)
                        <a href="{{url('/productview/'.$product->id)}}">
                            <img src="{{asset('storage/'.$product->productImages[0]->image)}}" alt="{{$product->name}}"  style="height:400px;">
                        </a>
                        @endif

                    </div>
                    <div class="mt-2">
                        <h4>{{$product->name}}</h4>
                        @if ($product->discount_price == Null)
                            <span id="selling-price" style="  font-size: 22px;
                            color: #000;
                            font-weight: 600;
                            margin-right: 8px;">${{$product->selling_price}}</span>
                            
                        @else
                            <span id="discount-price" style="  font-size: 22px;
                            color: #000;
                            font-weight: 600;
                            margin-right: 8px;">${{$product->selling_price - $product->discount_price}}</span>

                            <span id="selling-price" style="font-size: 18px;
                            color: #937979;
                            font-weight: 400;
                            text-decoration: line-through;">${{$product->selling_price}}</span>
                             <div>
                                <span class="badge badge-danger" >Discount ({{round(($product->discount_price/$product->selling_price)*100,2)}})%</span>
                             </div>
                                       
                            
                        @endif
                    </div>
                  
                </div>
            </div>

            @empty
            <div class="container">

                <h1 style="margin-top: 150px;">No Products in this category </h1>

            </div>


            @endforelse

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
     $('.addtowishlist').click(function(e) {
        e.preventDefault(); // Prevent default action (page reload)

        var productId = $(this).data('product-id'); // Get product_id from data attribute

        // AJAX request
        jQuery.ajax({
            url: "/frontend/addtowishlist/"+productId, // Route to your Laravel controller action
            method: 'GET',
            data: {
                product_id: productId // CSRF token
                
            },
            success: function(response) {
                // Handle success response
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
