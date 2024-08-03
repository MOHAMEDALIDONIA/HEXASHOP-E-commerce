@extends('layouts.admin')
@section('content')
    <div class="row">
      @if (session('message'))
      <h3 class="alert alert-success">{{session('message')}}</h3>
      @endif
        <div class="col-md-12 grid-margin stretch-card">
       
            <div class="card">
              <div class="card-body">
                <h4 class="card-title">Add Category
                  <a href="{{url('admin/category')}}" class="btn btn-danger btn-m text-white float-end">Back</a> 
                </h4>
                <hr>
                <form class="forms-sample" action="{{url('admin/category/store')}}" method="POST" enctype="multipart/form-data">
                  @csrf
                  <div class="col-md-6 mb-3">
                    <label >Name</label>
                    <input type="text" class="form-control text-white"  name="name" placeholder="name">
                  </div>
                  <div class="col-md-6 mb-3">
                    <label >Small Description</label>
                    <input type="text" class="form-control text-white"  name="small_description" placeholder="small_description">
                  </div>
                  <div class="col-md-12 mb-3">
                    <label >Description</label>
                    <textarea rows="6" name="description" class="form-control"></textarea>
                  </div>
                  <div class="col-md-6 mb-3">
                    <label>Image</label>
                    <input type="file" name="image" class="form-control"/>
                    @error('image')
                    <small class="form-text text-danger">{{$message}}</small> 
                    @enderror
                
                </div>
                  <div class="col-md-6 mb-3">
                    <label class="mb-2">Status</label><br>
                    <input type="checkbox" name="status" style=" width: 20px;height:20px; "/>  Checked = hidden,Un-checked = visible 
                
                </div>
                <div class="col-md-6 mb-3 ">
                  <label class="mb-2">Banner Status</label><br>
                  <input type="checkbox" name="banner_status" style=" width: 20px;height:20px; "/>  Checked = banner,Un-checked = unbanner
              
               </div>
                         
              </div>
         
                  
               
                  <div class="mb-3" style="margin-left: 20px;">
                    <button type="submit" class="btn btn-primary">Save</button>
                 </div>
               
                </form>
              </div>
            </div>
          </div>
    </div>
@endsection