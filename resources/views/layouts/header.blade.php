@include("layouts.html.top")
<body class="  ">
    <!-- loader Start -->
    <div id="loading">
      <div class="loader simple-loader">
          <div class="loader-body"></div>
      </div>    
    </div>
    <!-- loader END -->
    
    <aside class="sidebar sidebar-default sidebar-white sidebar-base navs-rounded-all ">
        <div class="sidebar-header d-flex align-items-center justify-content-start">
            <a href="{{url("home")}}" class="navbar-brand">
                <!--Logo start-->
                <div class="logo-main">
                    <div class="logo-normal">
                        <img src="{{ asset('assets/images') }}/car.svg" alt="" style="width: 32px">
                    </div>
                    <div class="logo-mini">
                        <img src="{{ asset('assets/images') }}/car.svg" alt="" style="width: 32px">
                    </div>
                </div>
                <h5 class="logo-title">Haha CarWash</h5>
                <!--Logo end-->
            </a>
            <div class="sidebar-toggle" data-toggle="sidebar" data-active="true">
                <i class="icon">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M4.25 12.2744L19.25 12.2744" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                        <path d="M10.2998 18.2988L4.2498 12.2748L10.2998 6.24976" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                    </svg>
                </i>
            </div>
        </div>
        <div class="sidebar-body pt-0 data-scrollbar">
            <div class="sidebar-list">
                <!-- Sidebar Menu Start -->
                <ul class="navbar-nav iq-main-menu" id="sidebar-menu">
                    <li class="nav-item static-item">
                        <a class="nav-link static-item disabled" href="#" tabindex="-1">
                            <span class="default-icon">Home</span>
                            <span class="mini-icon">-</span>
                        </a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link {{ Request::segment(1) == 'home' ? 'active' : '' }}" aria-current="page" href="{{ url('/home') }}">
                            <i class="icon">
                                <img src="{{ asset('assets/images') }}/sidebar/{{ Request::segment(1) == 'home' ? 'home-white.svg' : 'home.svg' }}" alt="" style="width: 20px;" >
                            </i>
                            <span class="item-name">Home</span>
                        </a>
                    </li>
                    <li><hr class="hr-horizontal"></li>
                    <li class="nav-item static-item">
                        <a class="nav-link static-item disabled" href="#" tabindex="-1">
                            <span class="default-icon">Transaction</span>
                            <span class="mini-icon">-</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::segment(1) == 'transaction' ? 'active' : '' }}"  href="{{ url('/transaction') }}">
                            <i class="icon">
                                <img src="{{ asset('assets/images') }}/sidebar/{{ Request::segment(1) == 'transaction' ? 'transaction-white.svg' : 'transaction.svg' }}" alt="" style="width: 20px;" >
                            </i>
                            <span class="item-name">Transaction</span>
                        </a>
                    </li>
                    <li><hr class="hr-horizontal"></li>
                    <li class="nav-item static-item">
                        <a class="nav-link static-item disabled" href="#" tabindex="-1">
                            <span class="default-icon">Settings</span>
                            <span class="mini-icon">-</span>
                        </a>
                    </li>

                    @if(Auth::user()->role == "Admin")

                    <li class="nav-item">
                        <a class="nav-link {{ Request::segment(1) == 'user' ? 'active' : '' }}" href="{{ url('/user') }}">
                            <i class="icon">
                                <img src="{{ asset('assets/images') }}/sidebar/{{ Request::segment(1) == 'user' ? 'user-white.svg' : 'user.svg' }}" alt="" style="width: 20px;" >
                            </i>
                            <span class="item-name">User</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::segment(1) == 'type-car' ? 'active' : '' }}" href="{{ url('/type-car') }}">
                            <i class="icon">
                                <img src="{{ asset('assets/images') }}/sidebar/{{ Request::segment(1) == 'type-car' ? 'car-white.svg' : 'car.svg' }}" alt="" style="width: 20px;" >
                            </i>
                            <span class="item-name">Type Car</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::segment(1) == 'type-wash' ? 'active' : '' }}" href="{{ url('/type-wash') }}">
                            <i class="icon">
                                <img src="{{ asset('assets/images') }}/sidebar/{{ Request::segment(1) == 'type-wash' ? 'carwash-white.svg' : 'carwash.svg' }}" alt="" style="width: 20px;" >
                            </i>
                            <span class="item-name">Type Wash</span>
                        </a>
                    </li>
                    
                    @endif
                    
                    <li class="nav-item">
                        <a class="nav-link {{ Request::segment(1) == 'reset-password' ? 'active' : '' }}" href="{{ url('/reset-password') }}">
                            <i class="icon">
                                <img src="{{ asset('assets/images') }}/sidebar/{{ Request::segment(1) == 'reset-password' ? 'reset-white.svg' : 'reset.svg' }}" alt="" style="width: 20px;" >
                            </i>
                            <span class="item-name">Reset Password</span>
                        </a>
                    </li>
                </ul>
                <!-- Sidebar Menu End -->        
            </div>
        </div>
    </aside>    
    <main class="main-content">
        <div class="position-relative iq-banner">
            <!--Nav Start-->
            <nav class="nav navbar navbar-expand-lg navbar-light iq-navbar">
            <div class="container-fluid navbar-inner">
                <a href="{{url("home")}}" class="navbar-brand">
                    <!--Logo start-->
                    <div class="logo-main">
                        <div class="logo-normal">
                            <img src="{{ asset('assets/images') }}/car.svg" alt="" style="width: 32px">
                        </div>
                        <div class="logo-mini">
                            <img src="{{ asset('assets/images') }}/car.svg" alt="" style="width: 32px">
                        </div>
                    </div>
                    <h4 class="logo-title">Haha CarWash</h4>
                    <!--logo End-->
                </a>
                <div class="sidebar-toggle" data-toggle="sidebar" data-active="true">
                    <i class="icon">
                    <svg  width="20px" class="icon-20" viewBox="0 0 24 24">
                        <path fill="currentColor" d="M4,11V13H16L10.5,18.5L11.92,19.92L19.84,12L11.92,4.08L10.5,5.5L16,11H4Z" />
                    </svg>
                    </i>
                </div>
                
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="mb-2 navbar-nav ms-auto align-items-center navbar-list mb-lg-0">
                    <li class="nav-item dropdown">
                    <a class="py-0 nav-link d-flex align-items-center" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="{{ asset('assets/images') }}/avatars/01.png" alt="User-Profile" class="theme-color-default-img img-fluid avatar avatar-50 avatar-rounded">
                        <img src="{{ asset('assets/images') }}/avatars/avtar_1.png" alt="User-Profile" class="theme-color-purple-img img-fluid avatar avatar-50 avatar-rounded">
                        <img src="{{ asset('assets/images') }}/avatars/avtar_2.png" alt="User-Profile" class="theme-color-blue-img img-fluid avatar avatar-50 avatar-rounded">
                        <img src="{{ asset('assets/images') }}/avatars/avtar_4.png" alt="User-Profile" class="theme-color-green-img img-fluid avatar avatar-50 avatar-rounded">
                        <img src="{{ asset('assets/images') }}/avatars/avtar_5.png" alt="User-Profile" class="theme-color-yellow-img img-fluid avatar avatar-50 avatar-rounded">
                        <img src="{{ asset('assets/images') }}/avatars/avtar_3.png" alt="User-Profile" class="theme-color-pink-img img-fluid avatar avatar-50 avatar-rounded">
                        <div class="caption ms-3 d-none d-md-block ">
                            <h6 class="mb-0 caption-title">{{ Auth::user()->name }}</h6>
                            <p class="mb-0 caption-sub-title">{{ Auth::user()->role }}</p>
                        </div>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="{{ url('/logout') }}">Logout</a></li>
                    </ul>
                    </li>
                </ul>
                </div>
            </div>
            </nav>          
            <!-- Nav Header Component Start -->
            <div class="iq-navbar-header" style="height: 215px;">
                <div class="container-fluid iq-container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="flex-wrap d-flex justify-content-between align-items-center">
                                <div>
                                    <h1>Hello {{ Auth::user()->name }}</h1>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="iq-header-img">
                    <img src="{{ asset('assets/images') }}/dashboard/top-header.png" alt="header" class="theme-color-default-img img-fluid w-100 h-100 animated-scaleX">
                    <img src="{{ asset('assets/images') }}/dashboard/top-header1.png" alt="header" class="theme-color-purple-img img-fluid w-100 h-100 animated-scaleX">
                    <img src="{{ asset('assets/images') }}/dashboard/top-header2.png" alt="header" class="theme-color-blue-img img-fluid w-100 h-100 animated-scaleX">
                    <img src="{{ asset('assets/images') }}/dashboard/top-header3.png" alt="header" class="theme-color-green-img img-fluid w-100 h-100 animated-scaleX">
                    <img src="{{ asset('assets/images') }}/dashboard/top-header4.png" alt="header" class="theme-color-yellow-img img-fluid w-100 h-100 animated-scaleX">
                    <img src="{{ asset('assets/images') }}/dashboard/top-header5.png" alt="header" class="theme-color-pink-img img-fluid w-100 h-100 animated-scaleX">
                </div>
            </div>          
            <!-- Nav Header Component End -->
        <!--Nav End-->
        </div>