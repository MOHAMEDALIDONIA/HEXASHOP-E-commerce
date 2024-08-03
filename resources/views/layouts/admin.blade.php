<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>HEXASHOP Admin</title>
        <!-- plugins:css -->
        <link rel="stylesheet" href="{{asset('adminassets/assets/vendors/mdi/css/materialdesignicons.min.css')}}">
        <link rel="stylesheet" href="{{asset('adminassets/assets/vendors/css/vendor.bundle.base.css')}}">
        <!-- endinject -->
        <!-- Plugin css for this page -->
        <link rel="stylesheet" href="{{asset('adminassets/assets/vendors/jvectormap/jquery-jvectormap.css')}}">
        <link rel="stylesheet" href="{{asset('adminassets/assets/vendors/flag-icon-css/css/flag-icon.min.css')}}">
        <link rel="stylesheet" href="{{asset('adminassets/assets/vendors/owl-carousel-2/owl.carousel.min.css')}}">
        <link rel="stylesheet" href="{{asset('adminassets/assets/vendors/owl-carousel-2/owl.theme.default.min.css')}}">
        <!-- End plugin css for this page -->
        <!-- inject:css -->
        <!-- endinject -->
        <!-- Layout styles -->
        <link rel="stylesheet" href="{{asset('adminassets/assets/css/style.css')}}">
        <!-- End layout styles -->
        <link rel="shortcut icon" href="{{asset('adminassets/assets/images/favicon.png')}}" />
        <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
      </head>
<body>
<div class="container-scroller"> 
    @include('layouts.inc.admin.sidebar')
    <div class="container-fluid page-body-wrapper">
        @include('layouts.inc.admin.navbar')
        <div class="main-panel">
            <div class="content-wrapper">
            @yield('content')
            </div>
        </div>
    </div>  
</div>

      <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="{{asset('adminassets/assets/vendors/js/vendor.bundle.base.js')}}"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="{{asset('adminassets/assets/vendors/chart.js/Chart.min.js')}}"></script>
    <script src="{{asset('adminassets/assets/vendors/progressbar.js/progressbar.min.js')}}"></script>
    <script src="{{asset('adminassets/assets/vendors/jvectormap/jquery-jvectormap.min.js')}}"></script>
    <script src="{{asset('adminassets/assets/vendors/jvectormap/jquery-jvectormap-world-mill-en.js')}}"></script>
    <script src="{{asset('adminassets/assets/vendors/owl-carousel-2/owl.carousel.min.js')}}"></script>
    <script src="{{asset('adminassets/assets/js/jquery.cookie.js')}}" type="text/javascript"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="{{asset('adminassets/assets/js/off-canvas.js')}}"></script>
    <script src="{{asset('adminassets/assets/js/hoverable-collapse.js')}}"></script>
    <script src="{{asset('adminassets/assets/js/misc.js')}}"></script>
    <script src="{{asset('adminassets/assets/js/settings.js')}}"></script>
    <script src="{{asset('adminassets/assets/js/todolist.js')}}"></script>
    <!-- endinject -->
    <!-- Custom js for this page -->
    <script src="{{asset('adminassets/assets/js/dashboard.js')}}"></script>
    <!-- End custom js for this page -->
    @yield('scripts')
</body>
</html>