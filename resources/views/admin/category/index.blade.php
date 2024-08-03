@extends('layouts.admin')
@section('content')
<div class="row">
    @if (session('message'))
    <h3 class="alert alert-success">{{session('message')}}</h3>
    @endif
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card ">
          <div class="card-body">
            <h3 class="card-title">Category Table(Count : {{$categories->count()??0}})
                
              @if (auth()->guard('admin')->user()->hasPermission('categories-create'))
                <a href="{{url('admin/category/create')}}" class="btn btn-primary btn-m text-white float-end">Add Category</a>
             @else
                <a href="#" class="btn btn-primary btn-m text-white float-end disabled" aria-disabled="true">Add Category</a>
             @endif
            </h3>
          
            <div class="table-responsive">
              <table class="table table-bordered text-white">
                <thead >
                  <tr>
                    <th> # </th>
                    <th> Name</th>
                    <th>Description</th>
                    <th> Status</th>
                    <th>Banner Status</th>
                    <th> Action </th>
                  </tr>
                </thead>
                <tbody>
                 @forelse ($categories as $category)
                 <tr>
                    <td>{{$category ->id}}</td>
                    <td>{{$category ->name}}</td>
                    <td>{{$category->description}}</td>
                    <td>{{$category ->status == '1' ? 'Hidden':'Visible'}}</td>
                    <td>{{$category ->banner_status == '1' ? 'Banner':'Un_Banner'}}</td>
                    <td>
                      @if (auth()->guard('admin')->user()->hasPermission('categories-update'))
                        <a href="{{url('admin/category/'.$category ->id.'/edit')}}">
                            <label class="badge badge-success">Edit</label> 
                        </a>
                      @else
                        <a href="#" class="btn btn-success btn-s text-white  disabled" aria-disabled="true">Edit</a>
                      @endif
                      @if (auth()->guard('admin')->user()->hasPermission('categories-delete'))  
                        <a href="{{url('admin/category/'.$category ->id.'/delete')}}">
                            <label onclick="return confirm('Are you sure,you want to delete this data?')" class="badge badge-danger">Delete</label> 
                        </a>
                      @else
                        <a href="#" class="btn btn-danger btn-s text-white  disabled" aria-disabled="true">Delete</a>
                      @endif  
                    </td>
                </tr>
                     
                 @empty
                  <tr>
                    <td colspan="4"> No Category Available</td>
                  </tr>
                    
                 @endforelse
                
       
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
</div>
@endsection