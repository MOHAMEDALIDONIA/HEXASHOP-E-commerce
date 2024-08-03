@extends('layouts.frontend')
@section('title','Thank You')
@section('content')
<div class="container" style="text-align: center;padding: 2rem;border: 1px solid #000;border-radius: 8px;box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1); background-color: #fff;margin-top:150px">
    <h1 style="    font-size: 2.5rem;
            margin-bottom: 1rem;
            color: #000;">Thank You!</h1>
            <br>
            @if (session()->has('message'))
                        <div class="alert alert-success">
                        {{ session('message') }}
                        </div>
            @endif
    <p style="   font-size: 1.2rem;
            margin-bottom: 2rem;
            color: #555;">Your order has been added succefully.</p>
    <button class="button" style="     background-color: #000;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            font-size: 1rem;
            cursor: pointer;
            transition: background-color 0.3s ease;" onclick="window.location.href='/'">Go Back Home</button>
</div>
@endsection