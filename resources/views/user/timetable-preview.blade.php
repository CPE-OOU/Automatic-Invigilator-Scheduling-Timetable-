@extends('layouts.guest')
@include('user.sidebar')
<main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg">
    @include('user.topmenu')
    @if(Session::has('success'))
    <div class="alert alert-success">
        {{ Session::get('success') }}
    </div>
    @endif

     
@section('content')
    <div class="container">
        <h1>Generated Timetable</h1>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Time</th>
                    <th>Course Name</th>
                    <th>Course Code</th>
                    <th>Invigilators</th>
                    <th>Venue</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($timetable as $exam)
                    <tr>
                        <td>{{ $exam['time'] }}</td>
                        <td>{{ $exam['course_name'] }}</td>
                        <td>{{ $exam['course_code'] }}</td>
                        <td>{{ $exam['invigilators'] }}</td>
                        <td>{{ $exam['venue'] }}</td>
                        <td>{{ $exam['date'] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
