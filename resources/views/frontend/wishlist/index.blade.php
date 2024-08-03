@extends('layouts.frontend')
@section('title','Wishlist')
@section('content')
<div class="row">
    <div class="col-md-12 ">
        @if (session('message'))
        <h6 class="alert alert-success">{{session('message')}}</h6>
        @endif
        <div class="card" style="max-width:1040px;margin-top: 120px;">
            <div class="card-header">
              <h3>My WishList({{$wishlist->count()}})
              </h3>
              <hr>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            
                            <th>products</th>
                            <th>price</th>
                            <th>discount price</th>
                            <th>remove</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($wishlist as $wishlistitem)
                        @if ($wishlistitem->product)
                            <tr class="wishlistitem-tr">
                                <td><a href="{{url('productview/'.$wishlistitem->product->id)}}">
                                    <img src="{{asset('storage/'.$wishlistitem->product->productImages[0]->image)}}" style="width: 50px; height: 50px" alt="">
                                    {{$wishlistitem->product->name}}
                                </a></td>
                                @if ($wishlistitem->product->discount_price == Null)
                                
                                    <td class="price" style="  font-size: 22px;
                                    color: #000;
                                    font-weight: 600;">$ {{$wishlistitem->product->selling_price}}</td>
                             
                                
                                    <td class="price">__</td>
                             
                            @else
                                
                                    <td class="price"style="font-size: 18px;
                                    color: #937979;
                                    font-weight: 400;
                                    text-decoration: line-through;">$ {{$wishlistitem->product->selling_price}}</td>
                             
                                
                                    <td class="price"style="  font-size: 22px;
                                    color: #000;
                                    font-weight: 600;
                                    margin-right: 8px;">${{$wishlistitem->product->selling_price - $wishlistitem->product->discount_price}}</td>
                             

                            @endif
                              
                               
                                <td>
                                    <a href="#" data-toggle="modal" data-target="#exampleModal"  ><label class="btn btn-danger btn-sm" ><i class="fa fa-trash"></i>Remove</label> </a>
                                             <!-- Modal -->
                                            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Delete Wishlistitem</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                    </div>
                                                    
                                                    <div class="modal-body">
                                                        <h4>Are you sure you want to delete this data?</h4>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    <a href="{{url('/frontend/wishlistitem/delete/'.$wishlistitem->id)}}"><button type="button" class="btn btn-danger">Yes,Delete</button></a>
                                                    </div>
                                            
                                            
                                                </div>
                                                </div>
                                            </div>    
                                </td>
                            </tr>
                        @endif
                        @empty
                            <tr>
                                <td colspan="4"> <h4>NO Wishlist Added</h4></td>
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