@extends('layouts.guest')
@include('user.sidebar')
<main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg">
    @include('user.topmenu')
    @if(Session::has('success'))
    <div class="alert alert-success">
        {{ Session::get('success') }}
    </div>
    @endif

    <div class="card-body px-0 pt-0 pb-2">
        <div class="table-responsive p-0">
        {{-- <h1>Edit Restaurant</h1> --}}
        <p class="text-left fw">Edit Course</p>
    
        <form action="{{ route('courses.update', $course->id) }}" method="PATCH">
            @csrf
            @method('PATCH')
                <input type="hidden" name="_method" value="POST"> 
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="name" class="form-label">Courae Title</label>
                        <input type="textarea" class="form-control" id="name" name="name" value="{{ $course->name}}" >
                    </div>
    
                    <div class="mb-3"> 
                        <label for="code" class="form-label">Course Code</label>
                        <input type="text" class="form-control" id="code" name="code" value="{{ $course->code}}" >
                    </div>
    
                    {{-- <div class="mb-3">
                        <label for="credit_hours" class="form-label">Credit Hours</label>
                        <input type="number" class="form-control" id="credit_hours" name="credit_hours" value="{{ $course->credit_hours}}">
                    </div> --}}
                    <div class="mb-3">
                        <label for="department" class="form-label">Department</label>
                        <input type="text" class="form-control" id="department" name="department" value="{{ $course->department}}">
                    </div>
    
                    <div class="mb-3">
                        <label for="course_lecturer" class="form-label">Course Lecturers (seperated by comma)</label>
                        <input type="text" class="form-control" id="lecturers" name="lecturers" value="{{ $course->lecturers}}" data-role="tagsinput">
                    </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</main>