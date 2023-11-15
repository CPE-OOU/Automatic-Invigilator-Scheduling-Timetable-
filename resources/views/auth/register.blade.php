@extends('layouts.auth')

@if(session('message'))
    <div class="alert alert-success">
        {{ session('message') }}
    </div>
@endif

{{-- @section('content')
<section class="fxt-template-animation fxt-template-layout34" data-bg-image="img/elements/bg1.png">
    <div class="fxt-shape  d-none d-md-block">
        <div class="fxt-transformX-L-50 fxt-transition-delay-1">
            <img src="img/elements/shape1.png" alt="Shape">
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
                        <a href="/" class="fxt-logo"><img src="images/logo.png" alt="Logo"></a>
                    </div>
                    <div class="fxt-transformX-L-50 fxt-transition-delay-5">
                        <div class="fxt-middle-content">
                            <h1 class="fxt-main-title">Sign Up</h1>
                            <div class="fxt-switcher-description1">If you have an account You can<a href="{{ route('login') }}" class="fxt-switcher-text ms-2">Sign In</a></div>
                        </div>
                    </div>
                    
                </div>
            </div>
            <div class="col-lg-4">
                <div class="fxt-column-wrap justify-content-center">
                    <div class="fxt-form">
                        <form method="POST" action="{{ route('register.post') }}">
                            @csrf
                            <div class="form-group">
                                <input type="text" id="department" class="form-control" name="department" placeholder="Department" required="required" value="">
                                @if ($errors->has('department'))
                                      <span class="text-danger">{{ $errors->first('department') }}</span>
                                  @endif
                            </div>
                            <div class="form-group">
                                <input type="text" id="faculty" class="form-control" name="faculty" placeholder="Faculty" required="required" value="">
                                 @if ($errors->has('faculty'))
                                      <span class="text-danger">{{ $errors->first('faculty') }}</span>
                                  @endif
                            </div>
                            <div class="form-group">
                                <input type="email" id="email" class="form-control" name="email" placeholder="E-mail Address" required="required" value="">
                               @if ($errors->has('email'))
                                      <span class="text-danger">{{ $errors->first('email') }}</span>
                                  @endif
                            </div>
                            <div class="form-group">
                                <input id="password" type="password" class="form-control" name="password" placeholder="********" required="required">
                                <i toggle="#password" class="fa fa-fw fa-eye toggle-password field-icon"></i>
                                 @if ($errors->has('password'))
                                      <span class="text-danger">{{ $errors->first('password') }}</span>
                                  @endif
                            </div>
                            <div class="form-group">
                                <div class="fxt-checkbox-box">
                                    <input id="checkbox1" type="checkbox" name="remember">
                                    <label for="checkbox1" class="ps-4">I agree with <a class="terms-link" href="{{ route('terms') }}">Terms</a> and <a class="terms-link" href="{{ route('privacy') }}">Privacy Policy</a></label>
                                </div>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="fxt-btn-fill">Sign Up</button>
                            </div>
                        </form>
                    </div>
                    <div class="fxt-style-line">
                        <span>Or Continus with</span>
                    </div>
                    <ul class="fxt-socials">
                        <li class="fxt-google">
                            <a href="#" title="google"><i class="fab fa-google-plus-g"></i></a>
                        </li>
                        <li class="fxt-apple">
                            <a href="#" title="apple"><i class="fab fa-apple"></i></a>
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
<div class="forny-container">
        
    <div class="forny-inner">
        <div class="forny-form">
            <div class="mb-8 text-center forny-logo">
                <img src="{{ asset('images/logo.png') }}">
            </div>
            <div class="text-center">
            <h4>Create an account</h4>
            <p class="mb-10">Setup a new account in a minute.</p>
        </div>
        <form method="POST" action="{{ route('register.post') }}">
            @csrf
            <div class="form-group">
                <input type="text" id="department" class="form-control" name="department" placeholder="Department" required="required" value="">
                @if ($errors->has('department'))
                      <span class="text-danger">{{ $errors->first('department') }}</span>
                  @endif
            </div>
            <div class="form-group">
                <input type="text" id="faculty" class="form-control" name="faculty" placeholder="Faculty" required="required" value="">
                 @if ($errors->has('faculty'))
                      <span class="text-danger">{{ $errors->first('faculty') }}</span>
                  @endif
            </div>
            <div class="form-group">
                <input type="email" id="email" class="form-control" name="email" placeholder="E-mail Address" required="required" value="">
               @if ($errors->has('email'))
                      <span class="text-danger">{{ $errors->first('email') }}</span>
                  @endif
            </div>
            <div class="form-group">
                <input id="password" type="password" class="form-control" name="password" placeholder="********" required="required">
                <i toggle="#password" class="fa fa-fw fa-eye toggle-password field-icon"></i>
                 @if ($errors->has('password'))
                      <span class="text-danger">{{ $errors->first('password') }}</span>
                  @endif
            </div>
            <div class="form-group">
                <div class="fxt-checkbox-box">
                    <input id="checkbox1" type="checkbox" name="remember">
                    <label for="checkbox1" class="ps-4">I agree with <a class="terms-link" href="{{ route('terms') }}">Terms</a> and <a class="terms-link" href="{{ route('privacy') }}">Privacy Policy</a></label>
                </div>
            </div>
            <div>
                <button class="btn btn-primary btn-block">Register</button>
            </div>
        </form>
            <div class="text-center mt-10">
                Already have an account? <a href="{{ route('login') }}">Login here</a>
            </div>
       
    </div>
</div>

    </div>
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
    <script src="js/demo.js"></script>
    