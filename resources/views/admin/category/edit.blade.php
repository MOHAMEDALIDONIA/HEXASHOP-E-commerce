@extends('layouts.admin')
@section('content')
    <div class="row">
      @if (session('message'))
      <h3 class="alert alert-success">{{session('message')}}</h3>
      @endif
        <div class="col-md-12 grid-margin stretch-card">
       
            <div class="card">
              <div class="card-body">
                <h4 class="card-title">Edit Category
                  <a href="{{url('admin/category')}}" class="btn btn-danger btn-m text-white float-end">Back</a> 
                </h4>
                <hr>
                <form class="forms-sample" action="{{url('admin/category/'.$category->id.'/update')}}" method="POST" enctype="multipart/form-data">
                  @csrf
                  <div class="col-md-16 mb-3">
                    <label >Name</label>
                    <input type="text" class="form-control text-white"  name="name" value="{{$category->name}}" placeholder="name">
                  </div>
                  <div class="col-md-6 mb-3">
                    <label>Small Description</label>
                    <textarea rows="3" name="small_description"   class="form-control">{{$category->small_description}}</textarea>
                    @error('small_description')
                    <small class="form-text text-danger">{{$message}}</small> 
                    @enderror
                
                </div>
                  <div class="col-md-12 mb-3">
                    <label>Description</label>
                    <textarea rows="3" name="description"   class="form-control">{{$category->description}}</textarea>
                    @error('description')
                    <small class="form-text text-danger">{{$message}}</small> 
                    @enderror
                
                </div>
                <div class="col-md-6 mb-3">
                  <label>Image</label>
                  <input type="file" name="image"   class="form-control"/>
                  @if ($category->image)
                    <img src="{{ asset('storage/'.$category->image)}}" width="80px" height="80px"/>
                    @error('image')
                    <small class="form-text text-danger">{{$message}}</small> 
                    @enderror
                  @endif
                
              
              </div>

                  <div class="col-md-6 mb-3">
                    <label class="mb-2">Status</label><br>
                    <input type="checkbox" name="status" {{$category->status=='1'?'checked':''}} style=" width: 20px;height:20px; "/>  Checked = hidden,Un-checked = visible 
                
                </div>
                <div class="col-md-6 mb-3">
                  <label class="mb-2">Banner Status</label><br>
                  <input type="checkbox" name="banner_status" {{$category->banner_status=='1'?'checked':''}} style=" width: 20px;height:20px; "/>  Checked = banner,Un-checked = unbanner
              
               </div>
                
                  
               
                  <div class="mb-3" style="margin-left: 20px; margin-top:20px;">
                    <button type="submit" class="btn btn-primary">Update</button>
                 </div>
               
                </form>
              </div>
            </div>
          </div>
    </div>
@endsection