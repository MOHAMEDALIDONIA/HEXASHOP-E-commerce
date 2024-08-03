@extends('layouts.admin')
@section('title','Admin Setting')
@section('content')
<div class="row">
    @if (session('message'))
    <h6 class="alert alert-success">{{session('message')}}</h6>
    @endif
    <div class="col-md-12 grid-margin">
        <form action="{{url('admin/settings')}}" method="POST">
            @csrf
            <div class="card mb-3">
                <div class="card-header bg-primary">
                    <h3 class="text-white mb-0">Website Settings</h3>

                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label >Website Name</label>
                            <input type="text" name="website_name" value="{{$setting->website_name ?? ''}}" class="form-control text-white"/>
                        </div>
                      
                   
                  
                        <div class="col-md-12 mb-3">
                            <label > Description</label>
                            <textarea rows="4" name="description" class="form-control text-white" style="height:100px;">{{$setting->description ?? ''}}</textarea>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label >Address</label>
                            <textarea rows="3" name="address" class="form-control text-white">{{$setting->address ?? ''}}</textarea>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label >Phone 1</label>
                            <input type="text" value="{{$setting->phone1 ?? ''}}" name="phone1" class="form-control text-white"/>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label >Phone 2</label>
                            <input type="text" name="phone2" value="{{$setting->phone2 ?? ''}}" class="form-control text-white"/>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label >Email  </label>
                            <input type="email" name="email" value="{{$setting->email ?? ''}}" class="form-control text-white"/>
                        </div>
                    
                        <div class="col-md-6 mb-3">
                            <label >Facebook(Optional)</label>
                            <input type="text" name="facebook" value="{{$setting->facebook ?? ''}}" class="form-control text-white"/>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label >Twitter(Optional)</label>
                            <input type="text" name="twitter" value="{{$setting->twitter ?? ''}}" class="form-control text-white"/>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label >Instagram(Optional)</label>
                            <input type="text" name="instagram" value="{{$setting->instagram ?? ''}}" class="form-control text-white"/>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label >Youtube(Optional)</label>
                            <input type="text" name="youtube" value="{{$setting->youtube ?? ''}}" class="form-control text-white"/>
                        </div>
                    </div>
                    <div class="text-end">
                        <button type="submit" class="btn btn-primary text-white">Save Setting</button>
                    </div>
                </div>
            </div>
      
           
           
        </form>
    </div>
</div>
@endsection