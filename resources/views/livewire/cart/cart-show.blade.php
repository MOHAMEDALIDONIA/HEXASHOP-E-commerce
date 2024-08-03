<div >
  
    <div class="card" style="max-width: 1640px;margin-top: 150px;">
        @if (session()->has('message'))
        <div class="alert alert-success">
           {{ session('message') }}
        </div>
       @endif
       @if (session()->has('error'))
       <div class="alert alert-danger">
          {{ session('error') }}
       </div>
      @endif
        <div class="row">
            <div class="col-md-10 cart">
                <div class="title">
                    <div class="row">
                  
                        <div class="col"><h4><b>Shopping Cart</b></h4></div>
                        <div class="col align-self-center text-right text-muted">({{$cartlist->sum('quantity')??0}})items</div>
                    </div>
                    
                   
                </div>    
                @forelse ($cartlist as $item)
                    <div class="row border-top border-bottom">
                        <div class="row main align-items-center">
                            @if ($item->product->productImages)
                             <div class="col-2"><a href="{{url('/productview/'.$item->product->id)}}"><img class="img-fluid" src="{{asset('storage/'.$item->product->productImages[0]->image)}}"></a></div>
                            @endif
                           
                            <div class="col">
                                <div class="row text-muted">{{$item->product->name}}</div>
                                @if ($item->ProductColor)
                                 <div class="row">Color:{{$item->ProductColor->color->name}}</div>
                                @endif
                               
                            </div>
                            @if($item->product->discount_price == Null)
                             <div class="col-md-2">${{$item->product->selling_price}}</div>
                            @else
                             <div class="col-md-2">${{$item->product->selling_price - $item->product->discount_price}}</div>
                            @endif
                            <div class="col-md-2">
                                <span class="btn btn1" wire:loading.attr="disabled" wire:click="decrementQuantity({{$item->id}})"><i class="fa fa-minus"></i></span>
                                <input type="text" id="numberorder" name="quantity" value="{{$item->quantity}}" readonly class="input-quantity" />
                                <span class="btn btn1" wire:loading.attr="disabled" wire:click="incrementQuantity({{$item->id}})"><i class="fa fa-plus"></i></span>
                            </div>
                            @if($item->product->discount_price == Null)
                            <div class="col-md-2">${{$item->product->selling_price * $item->quantity}}</div>
                            @php $TotalPrice +=  $item->product->selling_price * $item->quantity @endphp
                           @else
                            <div class="col-md-2">${{($item->product->selling_price - $item->product->discount_price) * $item->quantity}}</div>
                            @php $TotalPrice += ($item->product->selling_price - $item->product->discount_price) * $item->quantity @endphp
                           @endif
                           <div class="col-md-2">
                            <button type="button" wire:loading.attr="disabled" wire:click="removeCartItem({{$item->id}})" class="btn btn-danger btn-sm">
                                <span wire:loading.remove wire:target="removeCartItem({{$item->id}})">
                                    <i class="fa fa-trash"></i> Remove
                                </span>
                                <span wire:loading wire:target="removeCartItem({{$item->id}})">
                                    <i class="fa fa-trash"></i> Removing..
                                </span>
                            </button>
                          </div>
                        </div>
                    </div>
                 @empty 
                 <h4>NO Cartlist Added</h4>  
                @endforelse
               
             
                <div class="back-to-shop"><a href="{{url('/productsview')}}">&leftarrow;<span class="text-muted">Back to shop</span></a></div>
            </div>
            <div class="col-md-2 summary">
                <div><h5><b>Summary</b></h5></div>
                <hr>
                <div class="row">
                    <div class="col" style="padding-left:0;">ITEMS ({{$cartlist->sum('quantity')??0}})</div>
                    
                </div>
                @if ($user->DiscountCode()->count() > 0)
                    
                        <p>GIVE CODE</p>
                        <input  readonly value="{{$user->DiscountCode->discount_code}}" >
                        
                   
                    <div class="row" style="border-top: 1px solid rgba(0,0,0,.1); padding: 2vh 0;">
                        <div class="col">Before Discount</div>
                        <div class="col text-right">${{($TotalPrice)}}</div>
                    </div>
                    <div class="row" style="border-top: 1px solid rgba(0,0,0,.1); padding: 2vh 0;">
                        <div class="col">TOTAL PRICE</div>
                        <div class="col text-right">${{$TotalPrice-($TotalPrice*($user->DiscountCode->discount_percentage/100))}}</div>
                    </div>
                @else
                        <div class="row" style="border-top: 1px solid rgba(0,0,0,.1); padding: 2vh 0;">
                            <div class="col">TOTAL PRICE</div>
                            <div class="col text-right">${{$TotalPrice}}</div>
                        </div>    
                @endif
            
              
                <a href="{{url('/checkout')}}"  id="buttontem" class="btn btn-outline-dark btn-lg " role="button" aria-pressed="true">Checkout</a>
            </div>
        </div>
        
    </div>

</div>
