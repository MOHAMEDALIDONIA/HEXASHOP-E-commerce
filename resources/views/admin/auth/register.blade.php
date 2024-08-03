<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Admin</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="{{asset('adminassets/assets/css/custom.css')}}">
</head>

<body>
    <div class="login-dark">
        <form action="{{route('admin.register')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <h2 class="text-center">Register Form</h2>
            <div class="illustration"><i class="icon ion-ios-locked-outline"></i></div>
            <div class="form-group"><input class="form-control" type="text" name="name" :value="old('name')"  placeholder="Your Name" required autofocus autocomplete="name"></div>
            <div class="form-group"><input class="form-control" type="email" name="email" placeholder="Email" :value="old('email')" required autocomplete="username" ></div>
            <div class="form-group"><input class="form-control" type="title" name="title" placeholder="title" :value="old('title')"  ></div>
            <div class="form-group"><input class="form-control" type="file" name="image" placeholder="image"   ></div>

            <div class="form-group"><input class="form-control" type="password" name="password" placeholder="Password" required autocomplete="new-password" ></div>
            <div class="form-group"><input class="form-control" type="password" name="password_confirmation" placeholder="Confirm Password" required autocomplete="new-password" ></div>
            <div class="form-group"><button class="btn btn-primary btn-block" type="submit">Register</button></div></form>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/js/bootstrap.bundle.min.js"></script>
</body>

</html>