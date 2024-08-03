<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Link</title>
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
      
</head>

<body>

    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper full-page-wrapper">
          <div class="row w-100 m-0">
            <div class="content-wrapper full-page-wrapper d-flex align-items-center auth login-bg">
              <div class="card col-lg-4 mx-auto">
                <div class="card-body px-5 py-5">
                  <h3 class="card-title text-left mb-3">Send Link</h3>
                  <br>
                  <p class="text-center text-sm ">Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.</p>
                  <form method="POST" action="{{ route('send.link') }}" >
                    @csrf
                    @if(Session::has('message'))
                    <div class="alert alert-primary" role="alert">
                        {{Session::get('message')}}
                    </div>
                   @endif
                    <div class="form-group">
                      <label> email </label>
                      <input type="email" placeholder="Email" name="email" :value="old('email')" required autofocus  class="form-control p_input">
                    </div>
                    @if(Session::has('error'))
                      <small class="form-text text-danger">{{Session::get('error')}}</small>
                    @endif
  
                    
                    </div>
                    <div class="text-center">
                      <button type="submit" class="btn btn-primary btn-block enter-btn">Email Password Reset Link</button>
                    </div>
                    {{-- <div class="d-flex">
                      <button class="btn btn-facebook me-2 col">
                        <i class="mdi mdi-facebook"></i> Facebook </button>
                      <button class="btn btn-google col">
                        <i class="mdi mdi-google-plus"></i> Google plus </button>
                    </div>
                    <p class="sign-up">Don't have an Account?<a href="#"> Sign Up</a></p> --> --}}
                  </form>
                </div>
              </div>
            </div>
            <!-- content-wrapper ends -->
          </div>
          <!-- row ends -->
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
</body>

</html>