@extends('layouts.auth')

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
            <h4>Create an account</h4>
            <p class="mb-10">Setup a new account in a minute.</p>
        </div>
        <form method="POST" action="{{ route('register.post') }}">
            @csrf
            <label for="email">Department</label>
            <div class="form-group">
                <input type="text" id="department" class="form-control" name="department" placeholder="Department" required="required" value="">
                @if ($errors->has('department'))
                      <span class="text-danger">{{ $errors->first('department') }}</span>
                  @endif
            </div>
            <label for="email">Faculty</label>
            <div class="form-group">
                <input type="text" id="faculty" class="form-control" name="faculty" placeholder="Faculty" required="required" value="">
                 @if ($errors->has('faculty'))
                      <span class="text-danger">{{ $errors->first('faculty') }}</span>
                  @endif
            </div>

            <label for="email">Email</label>
            <div class="form-group">
                <input type="email" id="email" class="form-control" name="email" placeholder="E-mail Address" required="required" value="">
               @if ($errors->has('email'))
                      <span class="text-danger">{{ $errors->first('email') }}</span>
                  @endif
            </div>
            <label for="password">Password</label>
            <div class="form-group">
               
                <div class="input-group">
                    <input id="password" type="password" class="form-control" name="password" placeholder="********" required>
                    <div class="input-group-append">
                        <span class="input-group-text">
                            <i toggle="#password" class="fa fa-fw fa-eye toggle-password field-icon"></i>
                        </span>
                    </div>
                </div>
                @error('password')
                <span class="text-danger">{{ $message }}</span>
                @enderror
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
    