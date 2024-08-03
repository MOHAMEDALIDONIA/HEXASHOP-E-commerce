@extends('layouts.admin')
@section('content')

<div class="row">
    @if (session('message'))
    <h3 class="alert alert-success">{{session('message')}}</h3>
    @endif
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card ">
          <div class="card-body">
            <h3 class="card-title">Color Table (Count:{{$colors->count()}})
                <a href="{{url('admin/color/create')}}" class="btn btn-primary btn-m text-white float-end">Add Color</a>
            </h3>
          
            <div class="table-responsive">
              <table class="table table-bordered text-white">
                <thead >
                  <tr>
                    <th> # </th>
                    <th> Name</th>
                    <th>Code</th>
                    <th> Status</th>
                    <th> Action </th>
                  </tr>
                </thead>
                <tbody>
                 @forelse ($colors as $color)
                 <tr>
                    <td>{{$color ->id}}</td>
                    <td>{{$color ->name}}</td>
                    <td>{{$color->code}}</td>
                    <td>{{$color ->status == '1' ? 'Hidden':'Visible'}}</td>
                    <td>
                        <a href="{{url('admin/color/'.$color ->id.'/edit')}}" >
                            <label class="badge badge-success">Edit</label> 
                        </a>
                        <a href="{{url('admin/color/'.$color ->id.'/delete')}}">
                            <label onclick="return confirm('Are you sure,you want to delete this data?')" class="badge badge-danger">Delete</label> 
                        </a>
                    </td>
                </tr>
                     
                 @empty
                  <tr>
                    <td colspan="5"> No Color Available</td>
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