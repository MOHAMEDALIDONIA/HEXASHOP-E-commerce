@extends('layouts.frontend')
@section('title')
{{$product->name}}
@endsection
@section('content')
<div class="card mb-3" style="max-width: 1140px;margin-top:150px;">
    <div class="row no-gutters">
      <div class="col-md-7">
        <div id="carouselExampleInterval"    class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
             @if ($product->productImages)
               @foreach ($product->productImages as $key=>$productImage)
                <div class="carousel-item {{$key == 0 ?'active':''}}" data-interval="3000">
                    <img src="{{asset('storage/'.$productImage->image)}}"  class=" w-100" alt="{{$product->name}}">
                </div>
               @endforeach
                 
             @endif 
          
            
            </div>
            <a class="carousel-control-prev" href="#carouselExampleInterval" role="button" data-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleInterval" role="button" data-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="sr-only">Next</span>
            </a>
          </div>
      </div>
      <div class="col-md-5">
        <div class="card-body">
          <h5 class="card-title">Name({{$product->name}})</h5>
          <hr>
           <h4 class="card-title">Price</h4>
                
                    
                    @if ($product->discount_price == Null)
                        <span id="selling-price" style="  font-size: 22px;
                        color: #000;
                        font-weight: 600;
                        margin-top:-10px;">${{$product->selling_price}}</span>
                        
                    @else
                        <span id="discount-price" style="  font-size: 22px;
                        color: #000;
                        font-weight: 600;
                         margin-bottom:20px;">${{$product->selling_price - $product->discount_price}}</span>
                       <br>
                        <span id="selling-price" style="font-size: 18px;
                        color: #937979;
                        font-weight: 400;
                        text-decoration: line-through;">${{$product->selling_price}}</span>
                        
                        <span class="badge badge-danger" >Discount ({{round(($product->discount_price/$product->selling_price)*100,2)}})%</span>
                        
                                
                        
                    @endif
          <hr>
          <h4 class="card-title">Description</h4>     
          <p class="card-text">{{$product->description}}</p>
         <hr>
           <h4 class="card-title">Shopping</h4>
           <form action="{{url('/frontend/addtocart/'.$product->id)}}" method="post" style="margin-top:-10px;">
             @csrf
                        <h6>Select Color</h6>
                        @if($product->productColors->count()> 0) 
                        @if($product->productColors)
                     
                            @foreach ( $product->productColors as $color)
                            <div class="form-check" style="margin-top:10px;margin-left:-20px">
                                <input class="form-check-input" type="radio" name="color" value="{{$color->id}}" id="flexRadioDefault1">
                                @if ($color->color->code == 'black' ||$color->color->code == '#000')
                                  <label class="form-check-label" style="border: #000 1px solid; padding: 2px 10px; cursor: pointer; border-radius: 4px;background:{{$color->color->code}};color:#fff;">
                                    {{$color->color->name}}({{$color->quantity}})
                                  </label>
                                @else
                                  <label class="form-check-label" style="border: #000 1px solid; padding: 2px 10px; cursor: pointer; border-radius: 4px;background:{{$color->color->code}};color:#000;">
                                    {{$color->color->name}}({{$color->quantity}})
                                  </label> 
                                @endif
                            
                              </div>
                          
                           @endforeach
                     
                           @error('color')
                           <small  class="form-text text-danger">{{$message}}</small>
                           @enderror
           
                        @endif
                        <div>
            

                        </div>
                        
                        @else
                            @if($product->quantity > 0)
                              <label class="btn-sm py-1 mt-2 text-white bg-success">In Stock ({{$product->quantity}})</label>
                              <p class="card-text">The product is not available in more than one color</p>
                            @else
                             <label class="btn-sm py-1 mt-2 text-white bg-danger">Out of Stock</label>
                            @endif
                        @endif   
                <h6 style="margin-top: 10px;">Number of order</h6>
                    <div style="display: flex;align-items: center; margin-top:10px;margin-bottom:20px; ">
                      <span class="btn btn1" onclick="decrementValue()"><i class="fa fa-minus"></i></span>
                      <input type="text" id="numberorder" name="quantity" value="1" readonly class="input-quantity" />
                      <span class="btn btn1" onclick="incrementValue()"><i class="fa fa-plus"></i></span>
                  
                    </div>
                  
                <button type="submit" id="buttontem" class="btn btn-outline-dark" style="margin-top:0px;">Add to cart</button>
           </form>
           <hr>
           <h4 class="card-title" style="margin-bottom:-10px;">Actions</h4>
           <a href="{{url('/frontend/addtowishlist/'.$product->id)}}" id="buttontem" class="btn btn-outline-dark btn-lg " role="button" aria-pressed="true">Add to wishlist</a>
           <a href="{{url('/productsview')}}" id="buttontem" class="btn btn-outline-dark btn-lg " role="button" aria-pressed="true">Back to shopping</a>
        </div>
      </div>
    </div>
  </div>
    
@endsection
@section('script')
<script>
    $('.carousel').carousel()
    var counter = 1; // Initialize a counter variable

 function incrementValue() {
    // Get the input element by its id
    var inputElement = document.getElementById('numberorder');
    
    // Increment the counter
    counter++;

    // Update the value of the input element
    inputElement.value = counter;
}
function decrementValue() {
    // Get the input element by its id
    var inputElement = document.getElementById('numberorder');
    
    // Increment the counter
    counter--;
    if (counter == 0) {
        counter = 1;
        
    }

    // Update the value of the input element
    inputElement.value = counter;
}
</script>
@endsection