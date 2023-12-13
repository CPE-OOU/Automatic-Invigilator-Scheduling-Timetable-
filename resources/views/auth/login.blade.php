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
                <h4>Login into account</h4>
                <p class="mb-10">Use your credentials to access your account.</p>
            </div>
            
            <form method="POST" action="{{ route('login.post') }}">
                @csrf
                <label for="faculty">Faculty</label>
                <div class="form-group">
                    
                    <input type="text" id="faculty" class="form-control" name="faculty" placeholder="Enter faculty" required>
                    @error('faculty')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <label for="email">Email</label>
                <div class="form-group">
                    
                    <input type="email" id="email" class="form-control" name="email" placeholder="Enter Email" required>
                    @error('email')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
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
                    <button class="btn btn-primary text-white btn-block">Login</button>
                </div>
            </form>
            
        
                    <div class="text-center mt-10">
                        Don't have an account? <a href="{{ route('register') }}">Register here</a>
                    </div>  
                
    
    
        </div>
    </div>
    
        </div>
    
       