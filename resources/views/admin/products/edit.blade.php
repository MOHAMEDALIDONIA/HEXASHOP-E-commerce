@extends('layouts.admin')
@section('content')
<div class="row">
    @if (session('message'))
    <h3 class="alert alert-success">{{session('message')}}</h3>
    @endif
    @if (session('error'))
    <h3 class="alert alert-danger">{{session('error')}}</h3>
    @endif
    @if ($errors->any())
      <div class="alert alert-warning">
        @foreach ($errors->all() as $error)
            <div>{{$error}}</div>
        @endforeach
      </div>
        
    @endif
    <div class="col-md-12 ">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Edit Product
                    <a href="{{url('admin/product')}}" class="btn btn-danger btn-m text-white float-end">Back</a> 
                  </h3>
                  <hr>

            </div>
            <div class="card-body">
                <form action="{{url('admin/product/'.$product->id.'/update')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Home</button>
                        </li>
                     
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="details-tab" data-bs-toggle="tab" data-bs-target="#details"
                                type="button" role="tab" aria-controls="details" aria-selected="false">
                                Details
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="image-tab" data-bs-toggle="tab" data-bs-target="#image"
                                type="button" role="tab" aria-controls="image" aria-selected="false">
                                Product Image
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="colors-tab" data-bs-toggle="tab" data-bs-target="#colors"
                                type="button" role="tab" aria-controls="colors" aria-selected="false">
                                Product Color
                            </button>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade border p-3 show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                            <div class="mb-3">
                                <label> Select Category</label>
                                <select name="category_id" id="" class="form-control text-white">
                                    @foreach ($categories as $category)
                                    <option value="{{$category->id}}" {{$category->id == $product->category_id ? 'selected':''}} class="text-white">{{$category->name}}</option>

                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label>Product Name</label>
                                <input type="text" name="name"  value="{{$product->name}}" class="form-control" />
                            </div>
                            {{-- <div class="mb-3">
                                <label>Select Brand</label>
                                <select name="brand" id="" class="form-control">
                                    @foreach ($brands as $brand)
                                    <option value="{{$brand->name}}">{{$brand->name}}</option>

                                    @endforeach
                                </select>
                            </div> --}}
                         
                            <div class="mb-3">
                                <label>Description</label>
                                <textarea rows="4" name="description"  value="{{$product->description}}" class="form-control">{{$product->description}}</textarea>
                            </div>

                        </div>
                        <div class="tab-pane fade border p-3 " id="details" role="tabpanel" aria-labelledby="details-tab">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label>Original Price</label>
                                        <input type="text" name="original_price"  value="{{$product->original_price}}" class="form-control" />

                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label>Selling Price</label>
                                        <input type="text" name="selling_price"  value="{{$product->selling_price}}" class="form-control" />

                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label>Dis_Count Price</label>
                                        <input type="text" name="discount_price"  value="{{$product->discount_price}}" class="form-control" />

                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label>Quantity</label>
                                        <input type="number" name="quantity"value="{{$product->quantity}}" class="form-control" />

                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label>Tranding</label>
                                        <input type="checkbox" name="tranding"  {{$product->tranding == '1' ? 'checked':''}} style="width: 50px;height:50px;" />

                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label>Status</label>
                                        <input type="checkbox" name="status" {{$product->status == '1' ? 'checked':''}} style="width: 50px;height:50px;" />

                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="tab-pane fade border p-3 " id="image" role="tabpanel" aria-labelledby="image-tab">
                            <div class="mb-3">
                                <label >Upload Product Image</label>
                                <input type="file" name="image[]" multiple class="form-control">
                            </div>
                            <div>
                                @if($product->productImages)
                                <div class="row">
                                    @foreach($product->productImages as $image)
                                    <div class="col-md-2">
                                        <img src="{{ asset('storage/'.$image->image)}}" style="width:80px; height:80px;" class="me-4 border p-2" alt="img">
                                        <a href="{{url('admin/product-image/'.$image->id.'/delete')}}" class="d-block">Remove</a>

                                    </div>
                                    @endforeach

                                </div>
                                 
                             
                           
                                @else
                                 <h5>No Images Added</h5>
                                @endif
                            </div>
                        </div>
                        <div class="tab-pane fade border p-3 " id="colors" role="tabpanel" aria-labelledby="colors-tab">
                            <div class="mb-3">
                                <label >Selected Color</label>
                                <div class="row">
                                    @forelse($colors as $coloritem)
                                        <div class="col-md-3">
                                          <div class="p-2 border mb-3">
                                                Color:  <input type="checkbox" name="colors[{{$coloritem->id}}]" value="{{$coloritem->id}}" >{{$coloritem->name}}<span class="color-box" style=" display: inline-block; width: 15px;height: 15px;background-color:{{$coloritem->code}}; /* Change this to your desired color */border: 2px solid black; /* Change this to your desired border color */margin-left: 5px;"></span>
                                                <br/>
                                                Quantity: <input type="number" name="colorquantity[{{$coloritem->id}}]" style="width: 70px; border:1px solid">
                                          </div>
                                        </div>
                                    @empty
                                      <div class="col-md-12">
                                        <h1>No Colors Found</h1>
                                        
                                     </div>  
                                    @endforelse   
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-sm table-bordered">
                                        <thead>
                                            <tr>
                                                 <th>Color Name</th>  
                                                 <th>Quantity</th>
                                                 <th>Delete</th> 
                                            </tr>
        
                                            
        
                                        </thead>
                                        <tbody>
                                          
                                         @foreach ($product->productColors as $prodcolor)
                                          @if ($prodcolor->color )
                                                <tr class="prod-color-tr">
                                                
                                                        
                                                
                                                    <td>{{$prodcolor->color->name}}</td>
                                                    <td>
                                                        <div class="input-group mb-3" style="width: 150px;">
                                                            <input type="text" value="{{$prodcolor->quantity}}" class='productColorQuantity form-control form-control-sm'>
                                                            <button type="button" value="{{$prodcolor->id}}" class="updateProductColorBtn btn btn-primary btn-sm text-white">Update</button>
                
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <button type="button" value="{{$prodcolor->id}}" class="deleteProductColorBtn  btn btn-danger btn-sm text-white">Delete</button>
                                                    </td>
                                                </tr>
                                          @else
                                                <tr>
                                                    <td colspan="3"> No Color Found </td>
                                                </tr>
                                          @endif 
                                             
                                         @endforeach
        
                                        </tbody>
        
                                    </table>
        
        
                                </div>
                               
                            </div>
                        </div>
                    </div>
                    <div>
                        <button type="submit" class="btn btn-primary mt-3">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<meta name="csrf-token" content="{{ csrf_token() }}">
<script>
    $(document).ready(function(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $(document).on('click','.updateProductColorBtn', function(){
            var product_id = "{{$product->id}}";
            var prod_color_id = $(this).val();
            var qty = $(this).closest('.prod-color-tr').find('.productColorQuantity').val();
            // alert(prod_color_id);
            if(qty <= 0 ){
                alert('Quantity is required');
                return false;
            }
            if(qty > {{$product->quantity}} ){
                alert('Please,enter number smaller than product quantity');
                return false;
            }
            var data ={
                
                'product_id': product_id,
                'qty':qty
            };
            $.ajax({
                type:"POST",
                url:"/admin/product-color/"+prod_color_id,
                data:data,
             
                success:function(response){
                    alert(response.message)
                }


            });

        });
        $(document).on('click','.deleteProductColorBtn', function(){
            
            var prod_color_id = $(this).val();
            var thisClick = $(this);
        
            $.ajax({
                type:"POST",
                url:"/admin/product-color/"+prod_color_id+"/delete",
                success:function(response){
                    thisClick.closest('.prod-color-tr').remove();
                    alert(response.message)
                }


            });

        });

    });
</script>
@endsection