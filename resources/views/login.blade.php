@include('layouts.html.top', ['title' => 'Login'])

<body class=" " data-bs-spy="scroll" data-bs-target="#elements-section" data-bs-offset="0" tabindex="0">
    <!-- loader Start -->
    <div id="loading">
        <div class="loader simple-loader">
            <div class="loader-body"></div>
        </div>
    </div>
    <!-- loader END -->

    <div class="wrapper">
        <section class="login-content">
            <div class="row m-0 align-items-center bg-white vh-100">
                <div class="col-md-6">
                    <div class="row justify-content-center">
                        <div class="col-md-10">
                            <div class="card card-transparent shadow-none d-flex justify-content-center mb-0 auth-card">
                                <div class="card-body">
                                    <div class="navbar-brand d-flex align-items-center mb-3">

                                        <!--Logo start-->
                                        <div class="logo-main">
                                            <div class="logo-normal">
                                                <img src="{{ asset('assets/images') }}/car.svg" alt="">
                                            </div>
                                            <div class="logo-mini">
                                                <img src="{{ asset('assets/images') }}/car.svg" alt="">
                                            </div>
                                        </div>
                                        <h4 class="logo-title ms-3">HaHa CarWash</h4>
                                    </div>
                                    <h2 class="mb-2 text-center">Sign In</h2>
                                    <p class="text-center">Log in to make transactions.</p>
                                    <form action="{{url('authentication')}}" method="POST">
                                        {{ csrf_field() }}
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    @error('login_error')
                                                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                                            <strong>Warning!</strong> {{ $message }}.
                                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                                        </div>
                                                    @enderror
                                                    <label for="username" class="form-label">Username</label>
                                                    <input type="text" name="username" value="{{ @old('username') }}" class="form-control {{$errors->has('username') ? "is-invalid" : ""}}">
                                                     @if($errors->has('username'))
                                                        <div class="invalid-feedback">
                                                            {{ $errors->first('username') }}
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <label for="password" class="form-label">Password</label>
                                                    <input type="password" name="password" value="{{ @old('password') }}" class="form-control {{$errors->has('password') ? "is-invalid" : ""}}">
                                                    @if($errors->has('password'))
                                                        <div class="invalid-feedback">
                                                            {{ $errors->first('password') }}
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-center">
                                            <button type="submit" class="btn btn-primary">Sign In</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="sign-bg">
                        <svg width="280" height="230" viewBox="0 0 431 398" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <g opacity="0.05">
                                <rect x="-157.085" y="193.773" width="543" height="77.5714" rx="38.7857"
                                    transform="rotate(-45 -157.085 193.773)" fill="#3B8AFF" />
                                <rect x="7.46875" y="358.327" width="543" height="77.5714" rx="38.7857"
                                    transform="rotate(-45 7.46875 358.327)" fill="#3B8AFF" />
                                <rect x="61.9355" y="138.545" width="310.286" height="77.5714" rx="38.7857"
                                    transform="rotate(45 61.9355 138.545)" fill="#3B8AFF" />
                                <rect x="62.3154" y="-190.173" width="543" height="77.5714" rx="38.7857"
                                    transform="rotate(45 62.3154 -190.173)" fill="#3B8AFF" />
                            </g>
                        </svg>
                    </div>
                </div>
                <div class="col-md-6 d-md-block d-none bg-primary p-0 mt-n1 vh-100 overflow-hidden">
                    <img src="{{ asset('assets/images') }}/auth/carwash.jpg" class="img-fluid gradient-main animated-scaleX" alt="images">
                </div>
            </div>
        </section>
    </div>

@include('layouts.html.bottom')