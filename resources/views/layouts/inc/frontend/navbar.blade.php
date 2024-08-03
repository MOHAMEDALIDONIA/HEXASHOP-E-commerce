    <!-- ***** Preloader Start ***** -->
    <div id="preloader">
        <div class="jumper">
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>  
    <!-- ***** Preloader End ***** -->
    
    
    <!-- ***** Header Area Start ***** -->
    <header class="header-area header-sticky">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <nav class="main-nav">
                        <!-- ***** Logo Start ***** -->
                        <a href="{{url('/')}}" class="logo">
                            <img src="{{asset('assets/images/logo.png')}}">
                        </a>
                        <!-- ***** Logo End ***** -->
                        <!-- ***** Menu Start ***** -->
                        <ul class="nav">
                            <li class="scroll-to-section"><a href="{{url('/')}}" class="active">Home</a></li>
                            <li class="submenu">
                                <a href="javascript:;">Category</a>
                                <ul>
                                    @if ($categories->count() > 0)
                                    @foreach ($categories as $category)
                                    <li><a href="{{url('/category_products/'.$category->id)}}">{{$category->name}}</a></li>
                                    @endforeach
                                   @else
                                   <li><a href="#">not categories</a></li>
                                       
                                   @endif
                                 
                                
                                </ul>
                            </li>
                       
                            
                         
                            <li class="submenu">
                                <a href="javascript:;">Pages</a>
                                <ul>
                                    
                                    <li><a href="{{url('/productsview')}}">Products</a></li>
                                    <li><a href="{{url('/tranding-products')}}">Trending Products</a></li>
                                    <li><a href="{{url('/offers')}}">Offers</a></li>
                                    <li><a href="contact.html">Contact Us</a></li>
                                    <li><a href="about.html">About Us</a></li>
                                </ul>
                            </li>
                          
                            <li class="scroll-to-section">
                                 
                                        <div class="search-container">
                                            <a >Search</a>
                                            <form action="{{route('search')}}" method="GET">
                                                
                                                <div class="search-box">
                                                    <input type="text" name="search" class="search-input" value="{{Request::get('search')}}" id="search-input" placeholder="Type your search...">
                                                    <button class="search-button" type="submit" id="search-button">Go</button>
                                                </div>
                                            </form>
                                        </div>
                                   
                                 
                                
                            </li>
                            
                                @guest
                                        @if (Route::has('login'))
                                            <li class="scroll-to-section">
                                                <a  href="{{ route('login') }}">Login</a>
                                            </li>
                                        @endif
                
                                        @if (Route::has('register'))
                                            <li class="scroll-to-section">
                                                <a  href="{{ route('register') }}">Register</a>
                                            </li>
                                        @endif    
                                @else
                                        <li class="submenu">
                                          <a href="javascript:;">{{Auth::user()->name}}</a> 
                                            <ul>
                                                 <li><a href="{{url('/userprofile')}}"><i class="fa fa-user"></i>Profile</a></li>
                                                <li><a href="{{url('/wishlistview')}}"><i class="fa fa-star"></i> My Wishlist</a></li>
                                                <li><a href="{{url('/cartview')}}"><i class="fa fa-shopping-cart"></i>My Cart</a></li>
                                                <li><a href="{{url('/user-orders-view')}}"><i class="fa fa-bars"></i>My orders</a></li>
                                               
                                                <li>
                                                    <a  href="{{ route('logout') }}"
                                                     onclick="event.preventDefault();
                                                                document.getElementById('logout-form').submit();">
                                                    <i class="fa fa-sign-out"></i>  log out
                                                 </a>
                                                </li>
                                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                                    @csrf
                                                </form>
                                            </ul>
                                        </li>
                                 
                                @endguest
                   
                            
                        </ul>        
                        <a class='menu-trigger'>
                            <span>Menu</span>
                        </a>
                        <!-- ***** Menu End ***** -->
                    </nav>
                </div>
            </div>
        </div>
    </header>
    <!-- ***** Header Area End ***** -->