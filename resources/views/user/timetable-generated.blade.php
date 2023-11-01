@extends('layouts.guest')
@include('user.sidebar')
<main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg">
    @include('user.topmenu')
    @if(Session::has('success'))
    <div class="alert alert-success">
        {{ Session::get('success') }}
    </div>
    @endif
    @yield('content')
     

    <div class="container">
        <div class="alert alert-success">
            Timetable generated successfully! You can download it <a href="{{ asset('timetable.pdf') }}" download>here</a>.
        </div>
    </div>

</main>