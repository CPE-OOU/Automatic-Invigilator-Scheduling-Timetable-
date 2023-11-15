@extends('layouts.auth')

{{-- @section('content')
<section class="fxt-template-animation fxt-template-layout34" data-bg-image="{{ asset('img/elements/bg1.png') }}">
    <div class="fxt-shape  d-none d-md-block">
        <div class="fxt-transformX-L-50 fxt-transition-delay-1">
            <img src="{{ asset('img/elements/shape1.png') }}" alt="Shape">
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="fxt-column-wrap justify-content-between">
                    <div class="fxt-animated-img d-none d-md-block">
                <div class="fxt-transformX-L-50 fxt-transition-delay-10">
                    <img src="img/figure/bg34-1.png" alt="Animated Image">
                </div>
            </div>

                    <div class="fxt-transformX-L-50 fxt-transition-delay-3">
                        <a href="/" class="fxt-logo"><img src="{{ asset('images/logo.png') }}" alt="Logo"></a>
                    </div>
                    <div class="fxt-transformX-L-50 fxt-transition-delay-5">
                        <div class="fxt-middle-content">
                            <h1 class="fxt-main-title">Sign In </h1>
                            <div class="fxt-switcher-description1">If you don’t have an account, you can <a href="{{ route('register') }}" class="fxt-switcher-text ms-2">Sign Up</a></div>
                        </div>
                    </div>
                    
                </div>
            </div>
           <div class="col-lg-4">
                <div class="fxt-column-wrap justify-content-center">
                    <div class="fxt-form">
    <form method="POST" action="{{ route('login.post') }}">
    @csrf
        <div class="form-group">
        <input type="department" id="email" class="form-control" name="department" placeholder="Enter Department" required>
        @error('department')
        <span class="text-danger">{{ $message }}</span>
        @enderror
        </div>
        <div class="form-group">
        <input type="email" id="email" class="form-control" name="email" placeholder="Enter Email" required>
        @error('email')
        <span class="text-danger">{{ $message }}</span>
        @enderror
        </div>
        <div class="form-group">
        <input id="password" type="password" class="form-control" name="password" placeholder="********" required>
        <i toggle="#password" class="fa fa-fw fa-eye toggle-password field-icon"></i>
        @error('password')
        <span class="text-danger">{{ $message }}</span>
        @enderror
        </div>
        <div class="form-group">
        <div class="fxt-switcher-description2 text-right">
        <a href="{{ route('password.request') }}" class="fxt-switcher-text">Recover Password</a>
        </div>
        </div>
        <div class="form-group">
        <button type="submit" class="fxt-btn-fill">Sign In</button>
        </div>
        </form>

                    </div>
                    <div class="fxt-style-line">
                        <span>Or Continue with</span>
                    </div>
                    <ul class="fxt-socials">
                        <li class="fxt-google">
                            <a href="#" title="Google"><i class="fab fa-google-plus-g"></i></a>
                        </li>
                        <li class="fxt-apple">
                            <a href="#" title="Apple"><i class="fab fa-apple"></i></a>
                        </li>
                        <li class="fxt-facebook">
                            <a href="#" title="Facebook"><i class="fab fa-facebook-f"></i></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection --}}
@if(session('message'))
    <div class="alert alert-success">
        {{ session('message') }}
    </div>
@endif


<div class="forny-container">
        
    <div class="forny-inner">
        <div class="forny-form">
            <div class="mb-8 text-center forny-logo">
                <img src="{{ asset('images/logo.png') }}">
            </div>
            <div class="text-center">
                <h4>Login into account</h4>
                <p class="mb-10">Use your credentials to access your account.</p>
            </div>
            
            <form method="POST" action="{{ route('login.post') }}">
                @csrf
                    <div class="form-group">
                    <input type="department" id="email" class="form-control" name="department" placeholder="Enter Department" required>
                    @error('department')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                    </div>
                    <div class="form-group">
                    <input type="email" id="email" class="form-control" name="email" placeholder="Enter Email" required>
                    @error('email')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                    </div>
                    <div class="form-group">
                    <input id="password" type="password" class="form-control" name="password" placeholder="********" required>
                    <i toggle="#password" class="fa fa-fw fa-eye toggle-password field-icon"></i>
                    @error('password')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="cb1">
                        <label class="custom-control-label" for="cb1">Remember me
                        </label>
                    </div>
                
                    <div class="form-group">
                    <div class="fxt-switcher-description2 text-right">
                    <a href="{{ route('password.request') }}" class="fxt-switcher-text">Recover Password</a>
                    </div>
                    </div>
                    <div class="form-group">
                        <div>
                            <button class="btn btn-primary btn-block">Login</button>
                        </div>
                    </div>
                    </form>
            
                        
        
                    <div class="text-center mt-10">
                        Don't have an account? <a href="{{ route('register') }}">Register here</a>
                    </div>  
                
    
    
        </div>
    </div>
    
        </div>
    
       