@extends('layouts.frontend')
@section('title','HEXASHOP')
@section('content')


<div class="main-banner" id="top">
    <div class="container-fluid">
        <div class="row">
       
            <div class="col-lg-6">
                <div class="left-content">
                    <div class="thumb">
                        <div class="inner-content">
                            <h4>We Are Hexashop</h4>
                            <span>wonderful and fashionable clothes</span>
                            <div class="main-border-button">
                                <a href="{{url('/productsview')}}">Browse now!</a>
                            </div>
                        </div>
                        <img src="{{asset('storage/Frontend/left-banner-image.jpg')}}" alt="">
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="right-content">
                    <div class="row">
                      @forelse($banner_categories as $item)
                            <div class="col-lg-6">
                                <div class="right-first-image">
                                    <div class="thumb">
                                        <div class="inner-content">
                                            <h4>{{$item->name}}</h4>
                                            <span>{{$item->small_description}}</span>
                                        </div>
                                        <div class="hover-content">
                                            <div class="inner">
                                                <h4>{{$item->name}}</h4>
                                                <p>{{$item->description}}</p>
                                                <div class="main-border-button">
                                                    <a href="{{url('/category_products/'.$item->id)}}">Discover More</a>
                                                </div>
                                            </div>
                                        </div>
                                        <img src="{{asset('storage/'.$item->image)}}">
                                    </div>
                                </div>
                            </div>
                     @empty
                            
                        <div></div>    
                          
                    @endforelse

                      
                     
                   
                      
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="py-5 bg-white">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 text-center">
                <h4>Welcome to {{$appsetting->website_name?? 'no name'}}</h4>
                 <div class="underline ">
                </div>
                <p>

                    {{$appsetting->description ??'no description'}}
                </p>
            </div>

        </div>
    </div>


</div>
<section class="section" id="kids" >
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="section-heading">
                    <h2>Products Latest</h2>
                    <span>can you see more visit this link : <a href="{{url('/productsview')}}" style="color:red;">Products Latest</a></span>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="men-item-carousel">
                    <div class="owl-men-item owl-carousel">
                        @foreach ($latest_products as $item)
                                <div class="item" style="height: 600px;" >
                                    <div class="thumb">
                                        <div class="hover-content">
                                            <ul>
                                                <li><a href="{{url('/productview/'.$item->id)}}"><i class="fa fa-eye"></i></a></li>
                                                <li><a href="{{url('frontend/addtowishlist/'.$item->id)}}"><i class="fa fa-star"></i></a></li>
                                                
                                            </ul>
                                        </div>
                                        <img src="{{url('storage/'.$item->productImages[0]->image)}}" alt="" style="height:400px">
                                    </div>
                                    <div class="down-content">
                                        <h4>{{$item->name}}</h4>

                                        <span>
                                                @if ($item->discount_price == Null)
                                                <span id="selling-price" style="  font-size: 22px;
                                                color: #000;
                                                font-weight: 600;
                                                margin-right: 8px;">${{$item->selling_price}}</span>
                                                
                                            @else
                                                <span id="discount-price" style="  font-size: 22px;
                                                color: #000;
                                                font-weight: 600;
                                                margin-right: 8px;">${{$item->selling_price - $item->discount_price}}</span>
                    
                                                <span id="selling-price" style="font-size: 18px;
                                                color: #937979;
                                                font-weight: 400;
                                                text-decoration: line-through;">${{$item->selling_price}}</span>
                                                <div>
                                                    <span class="badge badge-danger text-white bg-red" >Discount ({{round(($item->discount_price/$item->selling_price)*100,2)}})%</span>
                                                </div>
                                                        
                                                
                                            @endif
                                        </span>
                               
                                    </div>
                                </div>
                            
                        @endforeach
                      
               
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="section" id="kids">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="section-heading">
                    <h2>Products Trending</h2>
                    <span>can you see more visit this link : <a href="{{url('/tranding-products')}}" style="color:red;">Products Tranding</a></span>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="men-item-carousel">
                    <div class="owl-men-item owl-carousel">
                        @foreach ($tranding_products as $item)
                                <div class="item" style="height: 600px;"  >
                                    <div class="thumb">
                                        <div class="hover-content">
                                            <ul>
                                                <li><a href="{{url('/productview/'.$item->id)}}"><i class="fa fa-eye"></i></a></li>
                                                <li><a href="{{url('frontend/addtowishlist/'.$item->id)}}"><i class="fa fa-star"></i></a></li>
                                                
                                            </ul>
                                        </div>
                                        <img src="{{url('storage/'.$item->productImages[0]->image)}}" alt="" style="height: 400px;" >
                                    </div>
                                    <div class="down-content">
                                        <h4>{{$item->name}}</h4>

                                        <span>
                                                @if ($item->discount_price == Null)
                                                <span id="selling-price" style="  font-size: 22px;
                                                color: #000;
                                                font-weight: 600;
                                                margin-right: 8px;">${{$item->selling_price}}</span>
                                                
                                            @else
                                                <span id="discount-price" style="  font-size: 22px;
                                                color: #000;
                                                font-weight: 600;
                                                margin-right: 8px;">${{$item->selling_price - $item->discount_price}}</span>
                    
                                                <span id="selling-price" style="font-size: 18px;
                                                color: #937979;
                                                font-weight: 400;
                                                text-decoration: line-through;">${{$item->selling_price}}</span>
                                                <div>
                                                    <span class="badge badge-danger text-white bg-red"  >Discount ({{round(($item->discount_price/$item->selling_price)*100,2)}})%</span>
                                                </div>
                                                        
                                                
                                            @endif
                                        </span>
                               
                                    </div>
                                </div>
                            
                        @endforeach
                      
               
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="section" id="kids">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="section-heading">
                    <h2>Offers</h2>
                    <span>can you see more visit this link : <a href="{{url('/offers')}}" style="color:red;">Offers</a></span>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="men-item-carousel">
                    <div class="owl-men-item owl-carousel">
                        @foreach ($offers as $item)
                                <div class="item" style="height: 600px;"  >
                                    <div class="thumb">
                                        <div class="hover-content">
                                            <ul>
                                                <li><a href="{{url('/productview/'.$item->id)}}"><i class="fa fa-eye"></i></a></li>
                                                <li><a href="{{url('frontend/addtowishlist/'.$item->id)}}"><i class="fa fa-star"></i></a></li>
                                                
                                            </ul>
                                        </div>
                                        <img src="{{url('storage/'.$item->productImages[0]->image)}}" alt="" style="height: 400px;" >
                                    </div>
                                    <div class="down-content">
                                        <h4>{{$item->name}}</h4>

                                        <span>
                                           
                                                <span id="discount-price" style="  font-size: 22px;
                                                color: #000;
                                                font-weight: 600;
                                                margin-right: 8px;">${{$item->selling_price - $item->discount_price}}</span>
                    
                                                <span id="selling-price" style="font-size: 18px;
                                                color: #937979;
                                                font-weight: 400;
                                                text-decoration: line-through;">${{$item->selling_price}}</span>
                                                <div>
                                                    <span class="badge badge-danger text-white bg-red" >Discount ({{round(($item->discount_price/$item->selling_price)*100,2)}})%</span>
                                                </div>
                                                        
                                                
                                            
                                        </span>
                               
                                    </div>
                                </div>
                            
                        @endforeach
                      
               
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection