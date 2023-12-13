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
                            @method('POST')
                            <div class="form-group">
                                <label for="start">Select Exams Start Date:</label>
                                <input type="date" name="start" class="form-control @error('start') is-invalid @enderror">
                                @error('start')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="form-group">
                                <label for="end">Select Exams End Date:</label>
                                <input type="date" name="end"
                             
                            class="form-control @error('end') is-invalid @enderror">
                                @error('end')
                                    <div
                             
                            class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div
 
class="form-group">
    <label for="venues">Exam Venues (separated by comma):</label>
    <input type="text"  name="venues[]" class="form-control @error('venues.*') is-invalid @enderror" data-role="tagsinput">
    @error('venues.*')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

{{-- <div class="form-group">
    <label for="timestart">Select Exams Start Time:</label>
    <input type="time" name="timestart"  class="form-control @error('timestart') is-invalid @enderror" >
    @error('timestart')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror 
</div>

<div class="form-group">
    <label for="timeend">Select Exams End Time:</label>
    <input type="time" name="timeend" class="form-control @error('timeend') is-invalid @enderror">
    @error('timeend')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div> --}}
                        
                            <button type="submit" class="btn btn-primary">Generate Timetable</button>
                        </form>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-tagsinput@0.8.0/dist/bootstrap-tagsinput.min.js"></script>
@endpush

@push('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-tagsinput@0.8.0/dist/bootstrap-tagsinput.css" />
@endpush

<script>
    function previewTimetable(filename) {
        var url = '{{ url("storage") }}/' + filename;
        window.open(url, '_blank');
    }
</script>
