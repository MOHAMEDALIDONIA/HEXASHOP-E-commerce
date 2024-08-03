@extends('layouts.admin')
@section('content')
<div class="row">
    @if (session('message'))
    <h3 class="alert alert-success">{{session('message')}}</h3>
    @endif
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card ">
          <div class="card-body">
            <h3 class="card-title">Products Table (Count:{{$products->count()}})
                
              @if (auth()->guard('admin')->user()->hasPermission('products-create'))
                  <a href="{{url('admin/product/create')}}" class="btn btn-primary btn-m text-white float-end">Add Product</a>
              @else
                  <a href="#" class="btn btn-primary btn-m text-white float-end disabled" aria-disabled="true">Add Product</a>
              @endif
            </h3>
          
            <div class="table-responsive">
              <table class="table table-bordered text-white mb-4">
                <thead >
                  <tr>
                    <th> # </th>
                    <th> Name</th>
                    <th> Category</th>
                    <th>Original Price</th>
                    <th> Selling Price </th>
                    <th>Discount Price</th>
                    <th> Quantity </th>
                    <th> Status</th>
                    <th> Action </th>
                  </tr>
                </thead>
                <tbody>
                 @forelse ($products as $product)
                 <tr>
                    <td>{{$product ->id}}</td>
                    <td>{{$product ->name}}</td>
                    @if ($product->category)
                     <td>{{$product->category->name}}</td> 
                     @else
                      <td>No Category</td>
                    @endif
                    <td>{{$product->original_price}}</td>
                    <td>{{$product->selling_price}}</td>
                    @if ($product->discount_price == Null)
                        <td>--</td>
                    @else
                     <td>{{$product->discount_price}}</td>
                    @endif
                    <td>{{$product->quantity}}</td>
                    <td>{{$product ->status == '1' ? 'Hidden':'Visible'}}</td>
                    <td>
                       
                      @if (auth()->guard('admin')->user()->hasPermission('products-update'))
                            <a href="{{url('admin/product/'.$product ->id.'/edit')}}">
                              <label class="badge badge-success">Edit</label> 
                          </a>
                      @else
                        <a href="#" class="btn btn-success btn-s text-white  disabled" aria-disabled="true">Edit</a>
                      @endif
                      @if (auth()->guard('admin')->user()->hasPermission('products-delete'))
                        <a href="" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            <label  class="badge badge-danger">Delete</label> 
                        </a>
                        <!-- Modal -->
                         <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Delete Product</h5>
                                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              
                                <div class="modal-body">
                                  <h4>Are you sure you want to delete this data?</h4>
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <a href="{{url('admin/product/'.$product ->id.'/delete')}}"><button type="button" class="btn btn-primary">Yes,Delete</button></a>
                                </div>
                        
                        
                            </div>
                          </div>
                         </div>
                       @else
                         <a href="#" class="btn btn-danger btn-s text-white  disabled" aria-disabled="true">Delete</a>
                       @endif 
                    </td>
                </tr>
                     
                 @empty
                  <tr>
                    <td colspan="4"> No Product Available</td>
                  </tr>
                    
                 @endforelse
                
       
                </tbody>
              </table>
              <div class="pagination justify-content-center">
                {{$products->links() }}
            </div> 
            </div>
          </div>
        </div>
      </div>
</div>
@endsection 
