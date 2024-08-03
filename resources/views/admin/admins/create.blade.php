@extends('layouts.admin')
@section('content')
    <div class="row">
      @if (session('message'))
      <h3 class="alert alert-success">{{session('message')}}</h3>
      @endif
        <div class="col-md-12 grid-margin stretch-card">
       
            <div class="card">
              <div class="card-body">
                <h4 class="card-title">Add Admin
                  <a href="{{url('admin/admins/view')}}" class="btn btn-danger btn-m text-white float-end">Back</a> 
                </h4>
                <hr>
                <form class="forms-sample" action="{{route('admin.create')}}" method="POST" enctype="multipart/form-data">
                  @csrf
                  <div class="form-group col-md-6 mb-3">
                    <label >Name</label>
                    <input type="text" class="form-control text-white"  name="name" placeholder="name">
                    @error('name')
                    <small class="form-text text-danger">{{$message}}</small> 
                    @enderror
                  </div>
                  <div class="form-group col-md-6 mb-3">
                    <label >Email</label>
                    <input type="text" class="form-control text-white"  name="email" placeholder="enter email">
                    @error('email')
                    <small class="form-text text-danger">{{$message}}</small> 
                    @enderror
                  </div>
                  <div class="form-group col-md-6 mb-3">
                    <label >Title</label>
                    <input type="text" class="form-control text-white"  name="title" placeholder="enter title">
                    @error('title')
                    <small class="form-text text-danger">{{$message}}</small> 
                    @enderror
                  </div>
                  <div class="col-md-6 mb-3">
                    <label>Image</label>
                    <input type="file" name="image" class="form-control"/>
                    @error('image')
                    <small class="form-text text-danger">{{$message}}</small> 
                    @enderror
                
                    </div>
                    <div class="form-group col-md-6 mb-3">
                        <label >Password</label>
                        <input type="password" class="form-control text-white"  name="password" placeholder="enter password">
                        @error('password')
                        <small class="form-text text-danger">{{$message}}</small> 
                        @enderror
                      </div>
                      <div class="form-group col-md-6 mb-3">
                        <label >Password Confirmation</label>
                        <input type="password" class="form-control text-white"  name="password_confirmation" placeholder="enter password confirmation">
                        @error('password_confirmation')
                        <small class="form-text text-danger">{{$message}}</small> 
                        @enderror
                      </div>
                      <div class="col-md-12 mb-3">
                        <h3>Permissions</h3>
                        <hr>
                        <p>
                            <a class="btn btn-primary" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                               Admins
                            </a>
                            <a class="btn btn-primary" data-bs-toggle="collapse" href="#productExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                                Products
                             </a>
                             <a class="btn btn-primary" data-bs-toggle="collapse" href="#categoryExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                                Category
                             </a>
                         
                          </p>
                          <div class="collapse" id="collapseExample">
                            <div class="card card-body">
                                <div class="row">
                                    <div class="col-sm-3">
                                        <div class="form-check form-check-primary">
                                            <label class="form-check-label">
                                              <input type="checkbox" class="form-check-input" name="permissions[]" value="admin-create"> Create Admin </label>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-check form-check-primary">
                                            <label class="form-check-label">
                                              <input type="checkbox" class="form-check-input" name="permissions[]" value="admin-read"> Read Admin </label>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-check form-check-primary">
                                            <label class="form-check-label">
                                              <input type="checkbox" class="form-check-input" name="permissions[]" value="admin-update" > Update Admin</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-check form-check-primary">
                                            <label class="form-check-label">
                                              <input type="checkbox" class="form-check-input" name="permissions[]" value="admin-delete"> Delete Admin</label>
                                        </div>
                                    </div>
                                </div>
                              
                            </div>
                          </div>
                          <div class="collapse" id="productExample">
                            <div class="card card-body">
                                <div class="row">
                                    <div class="col-sm-3">
                                        <div class="form-check form-check-primary">
                                            <label class="form-check-label">
                                              <input type="checkbox" class="form-check-input" name="permissions[]" value="products-create"> Create product </label>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-check form-check-primary">
                                            <label class="form-check-label">
                                              <input type="checkbox" class="form-check-input" name="permissions[]" value="products-read"> Read Product</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-check form-check-primary">
                                            <label class="form-check-label">
                                              <input type="checkbox" class="form-check-input" name="permissions[]" value="products-update" > Update Product</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-check form-check-primary">
                                            <label class="form-check-label">
                                              <input type="checkbox" class="form-check-input" name="permissions[]" value="products-delete"> Delete Product</label>
                                        </div>
                                    </div>
                                </div>
                              
                            </div>
                          </div>
                          <div class="collapse" id="categoryExample">
                            <div class="card card-body">
                                <div class="row">
                                    <div class="col-sm-3">
                                        <div class="form-check form-check-primary">
                                            <label class="form-check-label">
                                              <input type="checkbox" class="form-check-input" name="permissions[]" value="categories-create"> Create  Category</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-check form-check-primary">
                                            <label class="form-check-label">
                                              <input type="checkbox" class="form-check-input" name="permissions[]" value="categories-read"> Read Category</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-check form-check-primary">
                                            <label class="form-check-label">
                                              <input type="checkbox" class="form-check-input" name="permissions[]" value="categories-update" > Update Category </label>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-check form-check-primary">
                                            <label class="form-check-label">
                                              <input type="checkbox" class="form-check-input" name="permissions[]" value="categories-delete"> Delete Category</label>
                                        </div>
                                    </div>
                                </div>
                              
                            </div>
                          </div>
                      </div>
               
                  <div class="col-md-6 mb-3" >
                    <button type="submit" class="btn btn-primary">Save</button>
                 </div>
               
                </form>
              </div>
            </div>
          </div>
    </div>
@endsection