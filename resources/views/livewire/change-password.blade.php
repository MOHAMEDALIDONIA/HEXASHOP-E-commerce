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
                            <h4 class=" text-white">Change Password
                              
                                <a href="{{url('userprofile')}}" class="btn btn-danger btn-m text-white float-end" style="margin-left:140px;">Back</a>
                             
                            </h4>
                        </div>
                        <div class="card-body">
                            <form wire:submit="update">
                                
                                <div class="mb-3">
                                    <label>Current Password</label>
                                    <input type="password" wire:model.defer="current_password" class="form-control" />
                                    @error('current_password') <small class="text-danger">{{$message}}</small>   @enderror
                                </div>
                                <div class="mb-3">
                                    <label>New Password</label>
                                    <input type="password" wire:model.defer="password" class="form-control" />
                                    @error('password') <small class="text-danger">{{$message}}</small>   @enderror
                                </div>
                                <div class="mb-3">
                                    <label>Confirm Password</label>
                                    <input type="password" wire:model.defer="password_confirmation" class="form-control" />
                                    @error('password') <small class="text-danger">{{$message}}</small>   @enderror
                                </div>
                                <div class="mb-3 text-end">
                                    <hr>
                                    <button type="submit" class="btn btn-dark">Update Password</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
