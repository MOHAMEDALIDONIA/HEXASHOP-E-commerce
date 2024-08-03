<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title> Discount Code Mail</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
</head>
<body>
    <h1>Hello {{$user->name}},</h1>
    <br>

    <hr>
    <div class="alert alert-success" role="alert">
        <h4 class="alert-heading"></h4>
        <p> Our dear customer, because you are a distinguished customer, we have decided to give him the discount code is :({{$user->DiscountCode->discount_code}}) and discount percentage:(%{{$user->DiscountCode->discount_percentage}}) for you and you can use it for a period of ({{$days}}) days from now. Thank you for using HEXASHOP website. If you want to shop and see offers, take advantage of the code now. Click on the link.</p>
        <hr>
         <center><a href="{{route('home')}}"><button type="button" class="btn btn-success">Shopping Now</button></a></center>
      
      </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/js/bootstrap.bundle.min.js"></script>
</body>
</html>