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
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Generate Timetable</div>

                    <div class="card-body">
                        <form action="{{ route('generate.timetable') }}" method="POST">
                            @csrf

                            <div class="form-group">
                                <label for="deadline">Select Exam Deadline:</label>
                                <input type="date" name="deadline" class="form-control">
                            </div>

                            <button type="submit" class="btn btn-primary">Generate Timetable</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</main>