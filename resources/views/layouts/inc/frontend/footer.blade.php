    <!-- ***** Footer Start ***** -->
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="first-item">
                        <div class="logo">
                          <a href="{{url('/')}}"> <img src="{{asset('storage/white-logo.png')}}" alt="hexashop ecommerce templatemo"></a>
                        </div>
                        <ul>
                            <li class="text-white">{{$appsetting->address ??'no address'}}</li>
                            <li class="text-white">{{$appsetting->email ?? 'no email'}}</li>
                            <li class="text-white">{{$appsetting->phone1 ?? 'no phone1'}}</li>
                            <li class="text-white">{{$appsetting->phone2 ??'no phone2'}}</li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3">
                    <h4>Shopping</h4>
                    <ul>
                        <li><a href="{{url('productsview')}}">latest products</a></li>
                        <li><a href="{{url('tranding-products')}}">trending products</a></li>
                        <li><a href="{{url('offers')}}">offers</a></li>
                    </ul>
                </div>
                <div class="col-lg-3">
                    <h4>Social Media</h4>
                    <ul>
                        <li><a href="{{$appsetting->facebook??'#'}}"><i class="fa fa-facebook"></i> Facebook</a></li>
                        <li><a href="{{$appsetting->twitter ?? '#'}}"><i class="fa fa-twitter"></i>Twitter</a></li>
                        <li><a href="{{$appsetting->instagram ?? '#'}}"><i class="fa fa-instagram"></i>Instagram</a></li>
                        <li><a href="{{$appsetting->youtube?? '#'}}"><i class="fa fa-youtube"></i>Youtube</a></li>
                    </ul>
                </div>
                <div class="col-lg-3">
                    <h4>Help &amp; Information</h4>
                    <ul>
                        <li><a href="#">About Us</a></li>
                        <li><a href="#">Help</a></li>
                        <li><a href="#">Contact Us</a></li>
                    </ul>
                </div>
              
            </div>
        </div>
    </footer>