@extends('layouts.frontend')
@section('title','User Profile')
@section('content')
<div class="profile-card">
    @if ($user->image != null)
      <img src="{{asset('storage/'.$user->image)}}" alt="User Image" class="profile-image"> 
    @else
        <img src="{{asset('/storage/userprofile.jpg')}}" alt="User Image" class="profile-image">
    @endif
   
    <div class="profile-info">
        <h1 class="username">{{$user->name}}</h1>
        <p class="user-email">{{$user->email}}</p>
        <hr style="height:10px;">
        <div class="button-container">
            <a href="{{url('/userprofile/change-password/'.$user->id)}}" class="btn btn-outline-dark btn-lg " role="button" aria-pressed="true">Change Password ?</a>
            <a href="{{url('userprofile/update-data/'.$user->id)}}" class="btn btn-outline-dark btn-lg " role="button" aria-pressed="true">Update User Data</a>
            <a href="{{url('/user-orders-view')}}" class="btn btn-outline-dark btn-lg " role="button" aria-pressed="true">view Orders</a>
            <a href="{{url('/cartview')}}" class="btn btn-outline-dark btn-lg " role="button" aria-pressed="true">view Cart</a>
            <a href="{{url('/wishlistview')}}" class="btn btn-outline-dark btn-lg " role="button" aria-pressed="true">view Wishlist</a>
            
        </div>
      
    </div>
   
</div>

    
@endsection