@extends('layouts.admin')
@section('content')
    <div class="row">
      @if (session('message'))
      <h3 class="alert alert-success">{{session('message')}}</h3>
      @endif
        <div class="col-md-12 grid-margin stretch-card">
       
            <div class="card">
              <div class="card-body">
                <h4 class="card-title">Add Discount User
                  <a href="{{url('admin/users/index')}}" class="btn btn-danger btn-m text-white float-end">Back</a> 
                </h4>
                <hr>
                <form class="forms-sample" action="{{url('admin/store/discount/user/'.$user->id)}}" method="POST" enctype="multipart/form-data">
                  @csrf
                  <div class="form-group">
                    <div class="mb-6">

                        <label >DisCount Code</label>
                        <input type="text" name="discount_code" value="{{$user->DiscountCode->discount_code ?? 'no code'}}"  class="form-control text-white">
                        @error('discount_code')<small class="form-text text-danger">{{$message}}</small>@enderror
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="mb-3">

                        <label >discount percentage</label>
                        <input type="text" name="discount_percentage" value="{{$user->DiscountCode->discount_percentage ?? '0'}}"  class="form-control text-white">
                        @error('discount_percentage')<small class="form-text text-danger">{{$message}}</small>@enderror
                    </div>
                  </div>
              
                  <div class="mb-6">
                    <label >Expiry Date</label>
                    <input type="datetime-local" name="expiry_date" value="{{$user->DiscountCode->expiry_date ?? 'null'}}" class="form-control">
                    @error('expiry_date')<small class="form-text text-danger">{{$message}}</small>@enderror
                </div>
               
                  <div class="mb-3" style="margin-left: 20px; margin-top:20px;">
                    <button type="submit" class="btn btn-primary">Update,send by email</button>
                 </div>
               
                 <div class="mb-3" style="margin-left: 20px; margin-top:20px;">
                    <a href="{{url('admin/users/discount-code/delete/'.$user->id)}}" class="btn btn-danger" role="button" aria-pressed="true">Delete Discount Code</a>
                 </div>
                </form>
              </div>
            </div>
          </div>
    </div>
@endsection