<!DOCTYPE html>
<html lang="en">
<head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">
        <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900&display=swap" rel="stylesheet">
       
        <link href="{{asset('assets/images/logo1.png')}}" rel="icon">
        <title> @yield('title')</title>
    
    
        <!-- Additional CSS Files -->
        <link rel="stylesheet" type="text/css" href="{{asset('assets/css/bootstrap.min.css')}}">
    
        <link rel="stylesheet" type="text/css" href="{{asset('assets/css/font-awesome.css')}}">
    
        <link rel="stylesheet" href="{{asset('css/custom.css')}}">
    
        <link rel="stylesheet" href="{{asset('assets/css/templatemo-hexashop.css')}}">
    
        <link rel="stylesheet" href="{{asset('assets/css/owl-carousel.css')}}">
    
        <link rel="stylesheet" href="{{asset('assets/css/lightbox.css')}}">
        <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
    <!--
    
    TemplateMo 571 Hexashop
    
    https://templatemo.com/tm-571-hexashop
    
    -->
    @livewireStyles
</head>
<body>
    <div id="app">
        @include('layouts.inc.frontend.navbar')
  
        <main {{--class="py-4"--}}>
            @yield('content')
        </main>
        
        @include('layouts.inc.frontend.footer')
    </div>
    <meta name="csrf-token" content="{{ csrf_token() }}">
     <!-- jQuery -->
     <script src="{{asset('assets/js/jquery-2.1.0.min.js')}}"></script>

     <!-- Bootstrap -->
     <script src="{{asset('assets/js/popper.js')}}"></script>
     <script src="{{asset('assets/js/bootstrap.min.js')}}"></script>
 
     <!-- Plugins -->
     <script src="{{asset('assets/js/owl-carousel.js')}}"></script>
     <script src="{{asset('assets/js/accordions.js')}}"></script>
     <script src="{{asset('assets/js/datepicker.js')}}"></script>
     <script src="{{asset('assets/js/scrollreveal.min.js')}}"></script>
     <script src="{{asset('assets/js/waypoints.min.js')}}"></script>
     <script src="{{asset('assets/js/jquery.counterup.min.js')}}"></script>
     <script src="{{asset('assets/js/imgfix.min.js')}}"></script> 
     <script src="{{asset('assets/js/slick.js')}}"></script> 
     <script src="{{asset('assets/js/lightbox.js')}}"></script> 
     <script src="{{asset('assets/js/isotope.js')}}"></script> 
     
     <!-- Global Init -->
     <script src="{{asset('assets/js/custom.js')}}"></script>
      
     <script>
 
         $(function() {
             var selectedClass = "";
             $("p").click(function(){
             selectedClass = $(this).attr("data-rel");
             $("#portfolio").fadeTo(50, 0.1);
                 $("#portfolio div").not("."+selectedClass).fadeOut();
             setTimeout(function() {
               $("."+selectedClass).fadeIn();
               $("#portfolio").fadeTo(50, 1);
             }, 500);
                 
             });
         });
 
     </script>
     {{-- <script>
        $('#search-button').on('click',function(){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var formData ={search: $('#search-input').val()};
            $.ajax({
                url: '{{route('search')}}', // Your AJAX endpoint
                type: 'POST',
                data: {
                    search: $('#search-input').val(), // Example data
                    // other data if necessary
                },
                success: function(response) {
                    if (response.redirect) {
                        window.location.href = response.redirect; // Redirect to the URL provided
                    }
                },
                error: function(xhr) {
                    // Handle error
                    console.error(xhr.responseText);
                }
            });

   
        });
     </script> --}}
    
        @yield('script')
        @include('sweetalert::alert', ['cdn' => "https://cdn.jsdelivr.net/npm/sweetalert2@9"])

        @livewireScripts
</body>
</html>