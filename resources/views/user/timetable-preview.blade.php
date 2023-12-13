<!-- user.timetable-preview.blade.php -->

@extends('layouts.guest')
{{-- @include('user.sidebar') --}}
<main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg">
    {{-- @include('user.topmenu')
    @if(Session::has('success'))
    <div class="alert alert-success">
        {{ Session::get('success') }}
    </div>
    @endif --}}


    {{-- <div class="container">
        <h1>Generated Timetable</h1>
        
        
            <table border="1">
                <thead>
                    <tr>
                        <th>Day</th>
                        <th>Time</th>
                        <th>Course Name</th>
                        <th>Course Code</th>
                        <th>Invigilators</th>
                        <th>Venue</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($timetable as $item)
                        <tr>
                            <td>{{ $item['day'] }}</td>
                            <td>{{ $item['time'] }}</td>
                            <td>{{ $item['course_name'] }}</td>
                            <td>{{ $item['course_code'] }}</td>
                            <td>{{ $item['invigilators'] }}</td>
                            <td>{{ $item['venue'] }}</td>
                            <td>{{ $item['date'] }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        <br>
            <div class="nav-item d-flex align-self-end me-md-3">
<a href="{{ route('timetable.download') }}" class="btn btn-primary active mb-0 text-white" role="button" target="_blank">Download PDF</a>
</div>
</div> --}}

<!-- Enhanced Timetable Structure -->
<div class="container mt-4">
    <h1 class="text-center mb-4">Generated Timetable</h1>
    @if(empty($timetable))
        <p class="text-center">No timetable data available.</p>
    @else
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Day</th>
                        <th scope="col">Time</th>
                        <th scope="col">Dept</th>
                        {{-- <th scope="col">Course Title</th> --}}
                        <th scope="col">Course Code</th>
                        <th scope="col">Invigilators</th>
                        <th scope="col">Venue</th>
                        <th scope="col">Date</th>
                    </tr>
                </thead> 
                <tbody>
                    @foreach($timetable as $item)
                        <tr>
                            <td class="font-weight-bold">{{ $item['day'] }}</td>
                            <td>{{ $item['time'] }}</td>
                            <td>{{ $item['dept'] }}</td>
                            {{-- <td>{{ $item['course_name'] }}</td> --}}
                            <td>{{ $item['course_code'] }}</td>
                            <td>{{ $item['invigilators'] }}</td>
                            <td>
                                <span class="font-weight-bold">{{ $item['venue'] }}</span>
                            </td>
                            <td>{{ $item['date'] }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <br>
<div class="nav-item d-flex align-self-end me-md-3">
<a href="{{ route('timetable.download') }}" class="btn btn-primary active mb-0 text-white" role="button" target="_blank">Download</a>
</div>
    @endif

</div>


