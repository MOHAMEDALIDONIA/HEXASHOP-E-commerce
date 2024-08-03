<div>
    <div style="margin-top:120px;">
        <div class="py-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-6">
        
                        @if (session('message'))
                            <h5 class="alert alert-success mb-2">{{ session('message') }}</h5>
                        @endif
        
                        {{-- @if ($errors->any())
                        <ul class="alert alert-danger">
                            @foreach ($errors->all() as $error)
                            <li class="text-danger">{{ $error }}</li>
                            @endforeach
                        </ul>
                        @endif --}}
        
                        <div class="card shadow">
                            <div class="card-header bg-dark">
                                <h4 class="mb-0 text-white">Update Data
                                    <a href="{{url('userprofile')}}" class="btn btn-danger btn-m text-white float-end" style="margin-left:200px;">Back</a>
                                </h4>
                            </div>
                            <div class="card-body">
                                <form wire:submit="update" enctype="multipart/form-data">
                                    
                                    <div class="mb-3">
                                        <label>Name</label>
                                        <input type="text" wire:model.defer="name" value="" class="form-control" />
                                        @error('name') <small class="text-danger">{{$message}}</small>   @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label>email</label>
                                        <input type="email" wire:model.defer="email" value="{{$user->email}}" class="form-control" />
                                        @error('email') <small class="text-danger">{{$message}}</small>   @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label>Image</label>
                                        <input type="file" wire:model.defer="image"  class="form-control" />
                                        @if ($user->image != null)
                                        <img src="{{asset('storage/'.$user->image)}}" alt="User Image" class="profile-image" style="width: 70px;height:70px;"> 
                                      @else
                                          <img src="{{asset('/storage/userprofile.jpg')}}" alt="User Image" class="profile-image" style="width: 70px;height:70px;">
                                      @endif
                                        @error('image') <small class="text-danger">{{$message}}</small>   @enderror
                                    </div>
                                    <div class="mb-3 text-end">
                                        <hr>
                                        <button type="submit" class="btn btn-dark">Update </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</div>
