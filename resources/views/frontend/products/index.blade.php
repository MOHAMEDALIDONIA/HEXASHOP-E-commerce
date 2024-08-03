@extends('layouts.frontend')
@section('title','Latest Products')
@section('content')
@if (session('alert'))
    <div class="alert alert-info text-center" style="margin-top: 150px;margin-bottom:-150px;" role="alert">
    {{session('alert')}}
    </div>  
@endif
<div class="page-heading" id="top">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="inner-content">
                    <h2>Check Our Products</h2>
                  
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
            @foreach ($products as $product)
            <div class="col-lg-4">
                <div class="item "  style="height:600px;"">
                    <div class="thumb">
                        <div class="hover-content">
                            <ul>
                                <li><a href="{{url('/productview/'.$product->id)}}"><i class="fa fa-eye"></i></a></li>
                                <li><a href="{{url('frontend/addtowishlist/'.$product->id)}}"><i class="fa fa-star"></i></a></li>
                               
                            </ul>
                        </div>
                     
                        @if($product->productImages->count() > 0)
                        <a href="{{url('/productview/'.$product->id)}}">
                            <img src="{{asset('storage/'.$product->productImages[0]->image)}}" alt="{{$product->name}}" style="height:400px;" >
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

        


            @endforeach

        </div>
    </div>
</div>
<div class="pagination justify-content-center">
    {{$products->links() }}
</div>

   
@endsection