   <!-- partial:partials/_sidebar.html -->
   <nav class="sidebar sidebar-offcanvas" id="sidebar">
    <div class="sidebar-brand-wrapper d-none d-lg-flex align-items-center justify-content-center fixed-top">
      <a class="sidebar-brand brand-logo" href="index.html"><img style="height: 50px; width:200px" src="{{asset('assets/images/white-logo.png')}}" alt="logo" /></a>
      <a class="sidebar-brand brand-logo-mini" href="index.html"><img src="{{asset('assets/images/logo1.png')}}" alt="logo" /></a>
    </div>
    <ul class="nav">
      <li class="nav-item profile">
        <div class="profile-desc">
          <div class="profile-pic">
            <div class="count-indicator">
              @if (Auth::guard('admin')->user()->image)
              <img class="img-xs rounded-circle" src="{{asset('storage/'.Auth::guard('admin')->user()->image)}}" alt="">
              @endif
              <span class="count bg-success"></span>
            </div>
            <div class="profile-name">
              <h5 class="mb-0 font-weight-normal">{{Auth::guard('admin')->user()->name}}</h5>
              <span>{{Auth::guard('admin')->user()->title}}</span>
            </div>
          </div>
       
        </div>
      </li>
      <li class="nav-item nav-category">
        <span class="nav-link">Navigation</span>
      </li>
      <li class="nav-item menu-items">
        <a class="nav-link" href="{{url('admin/')}}">
          <span class="menu-icon">
            <i class="mdi mdi-view-dashboard"></i>
          </span>
          <span class="menu-title">Dashboard</span>
        </a>
      </li>
      @if (auth()->guard('admin')->user()->hasPermission('products-read'))
        <li class="nav-item menu-items ">
          <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic" aria-expanded="{{Request::is('admin/product*')? 'true':'false'}}" aria-controls="ui-basic">
            <span class="menu-icon">
              <i class="mdi mdi-lan"></i>
            </span>
            <span class="menu-title">Products</span>
            <i class="menu-arrow"></i>
          </a>
          <div class="collapse" id="ui-basic">
            <ul class="nav flex-column sub-menu">
              <li class="nav-item"> <a class="nav-link" href="{{url('admin/product/create')}}">Add Products</a></li>
              <li class="nav-item"> <a class="nav-link" href="{{url('admin/product')}}">View Products</a></li>
          
            </ul>
          </div>
        </li>
      @endif
    
      @if (auth()->guard('admin')->user()->hasPermission('categories-read'))
        <li class="nav-item menu-items">
          <a class="nav-link" data-bs-toggle="collapse" href="#category" aria-expanded="{{Request::is('admin/category*')? 'true':'false'}}" aria-controls="ui-basic">
            <span class="menu-icon">
              <i class="mdi mdi-border-all"></i>
            </span>
            <span class="menu-title">Category</span>
            <i class="menu-arrow"></i>
          </a>
          <div class="collapse" id="category">
            <ul class="nav flex-column sub-menu">
              <li class="nav-item"> <a class="nav-link" href="{{url('admin/category/create')}}">Add Category</a></li>
              <li class="nav-item"> <a class="nav-link" href="{{url('admin/category')}}">View Category</a></li>
          
            </ul>
          </div>
        </li>
      @endif
    
      <li class="nav-item menu-items">
        <a class="nav-link" data-bs-toggle="collapse" href="#color" aria-expanded="{{Request::is('admin/color*')? 'true':'false'}}" aria-controls="color">
          <span class="menu-icon">
            <i class="mdi mdi-invert-colors"></i>
          </span>
          <span class="menu-title">Color</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="color">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link" href="{{url('admin/color/create')}}">Add Color</a></li>
            <li class="nav-item"> <a class="nav-link" href="{{url('admin/color')}}">View Color</a></li>
         
          </ul>
        </div>
      </li>
      <li class="nav-item menu-items">
        <a class="nav-link" data-bs-toggle="collapse" href="#order" aria-expanded="false" aria-controls="order">
          <span class="menu-icon">
            <i class="mdi mdi-cards"></i>
          </span>
          <span class="menu-title">orders</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="order">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link" href="{{url('admin/orders/index')}}">Table Orders</a></li>
            
         
          </ul>
        </div>
      </li>
      <li class="nav-item menu-items">
        <a class="nav-link" data-bs-toggle="collapse" href="#user" aria-expanded="false" aria-controls="ui-basic">
          <span class="menu-icon">
            <i class="mdi mdi-account-outline"></i>
          </span>
          <span class="menu-title">users</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="user">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link" href="{{url('admin/users/index')}}">View Users</a></li>
            
         
          </ul>
        </div>
      </li>
 
   
  
      <li class="nav-item menu-items">
        <a class="nav-link" href="{{url('admin/settings')}}">
          <span class="menu-icon">
            <i class="mdi mdi-settings"></i>
          </span>
          <span class="menu-title">Settings</span>
        </a>
      </li>
      @if (auth()->guard('admin')->user()->hasPermission('admin-read'))
      <li class="nav-item menu-items">
        <a class="nav-link" data-bs-toggle="collapse" href="#admin" aria-expanded="false" aria-controls="ui-basic">
          <span class="menu-icon">
            <i class="mdi mdi-account-outline"></i>
          </span>
          <span class="menu-title">admins</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="admin">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link" href="{{url('admin/admins/view')}}">View admins</a></li>
            
         
          </ul>
        </div>
      </li> 
      @endif
    
     
    
    </ul>
  </nav>