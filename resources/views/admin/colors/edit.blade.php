@extends('layouts.admin')
@section('content')
    <div class="row">
      @if (session('message'))
      <h3 class="alert alert-success">{{session('message')}}</h3>
      @endif
        <div class="col-md-12 grid-margin stretch-card">
       
            <div class="card">
              <div class="card-body">
                <h4 class="card-title">Edit Color
                  <a href="{{url('admin/color')}}" class="btn btn-danger btn-m text-white float-end">Back</a> 
                </h4>
                <hr>
                <form class="forms-sample" action="{{url('admin/color/update/'.$color->id)}}" method="POST" enctype="multipart/form-data">
                  @csrf
                  <div class="form-group">
                    <label >Name</label>
                    <input type="text" class="form-control text-white"  name="name" value="{{$color->name}}" placeholder="name">
                    @error('name')
                    <small class="form-text text-danger">{{$message}}</small> 
                    @enderror
                  </div>
                  <div class="form-group">
                    <label >Code</label>
                    <input type="text" class="form-control text-white"  name="code" value="{{$color->code}}" placeholder="code->(name or # code css)">
                    @error('code')
                    <small class="form-text text-danger">{{$message}}</small> 
                    @enderror
                  </div>
                  <div class="col-md-6 mb-3">
                    <label>Status</label><br>
                    <input type="checkbox" name="status" {{$color->status=='1'?'checked':''}}  style=" width: 20px;height:20px; "/>  Checked = hidden,Un-checked = visible 
                
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