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
   
<link rel="stylesheet" href="https://cdn.jsdelivr.net/bootstrap.tagsinput/0.8.0/bootstrap-tagsinput.css"> 

    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4 mx-4">
                    <div class="card-header pb-0">
                        <div class="d-flex flex-row justify-content-between">
                            <div>
                                <h5 class="mb-0">All courses</h5>
                            </div>
                            <a href="#" class="btn bg-gradient-primary btn-sm mb-0" data-bs-toggle="modal" data-bs-target="#addUserModal">
                                +&nbsp; New Course
                            </a>
                        </div>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            ID
                                        </th>
                                        
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Name
                                        </th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Course Code
                                        </th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Lecturers
                                        </th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Creation Date
                                        </th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Action
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($courses as $course)
                                    <tr>
                                        <td class="ps-4">
                                            <p class="text-xs font-weight-bold mb-0">{{ $course->id }}</p>
                                        </td>
                                       
                                        <td class="text-center">
                                            <p class="text-xs font-weight-bold mb-0">{{ $course->name }}</p>
                                        </td>
                                        <td class="text-center">
                                            <p class="text-xs font-weight-bold mb-0">{{ $course->code }}</p>
                                        </td>
                                        <td class="text-center">
                                            <p class="text-xs font-weight-bold mb-0">{{ $course->lecturers }}</p>
                                        </td>
                                        
                                        <td class="text-center">
                                            <span class="text-secondary text-xs font-weight-bold">{{ $course->created_at->format('d/m/y') }}</span>
                                        </td>
                                        <td class="text-center">
                                            <a href="{{ route('courses.edit', $course->id) }}" class="mx-3" data-bs-toggle="tooltip" data-bs-original-title="Edit user">
                                                <i class="fas fa-user-edit text-secondary"></i>
                                            </a>
                                            {{-- <a href="#" class="mx-3" data-bs-toggle="modal" data-bs-target="#deleteUserModal" data-user-id="{{ $user->id }}" data-bs-original-title="Delete user">
                                                <i class="cursor-pointer fas fa-trash text-secondary"></i>
                                            </a> --}}
                                            <form action="{{ route('courses.destroy', $course->id) }}" method="POST" style="display: inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                            </form>
                                           
                                                                                 
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
  
<!-- Add User Modal -->
<div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            @if(Session::has('success'))
    <div class="alert alert-success">
        {{ Session::get('success') }}
    </div>
    @endif
            <div class="modal-header">
                <h5 class="modal-title" id="addUserModalLabel">Add New Course</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="addUserForm" method="POST" action="{{ route('courses.save') }}">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
            
                    <div class="mb-3">
                        <label for="code" class="form-label">Course Code</label>
                        <input type="text" class="form-control @error('code') is-invalid @enderror" id="code" name="code" required>
                        @error('code')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
            
                    <div class="mb-3">
                        <label for="credit_hours" class="form-label">Credit Hours</label>
                        <input type="number" class="form-control" id="credit_hours" name="credit_hours">
                    </div>
            
                    
                <div class="mb-3">
                    <label for="lecturers" class="form-label">Course Lecturers</label>
                    <textarea class="form-control" id="lecturers" name="lecturers" rows="3" placeholder="Enter the lecturer names separated by comma"  required></textarea>
                    @error('lecturers')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
                
                </div>
            
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add Course</button>
                </div>
            </form>
            
    </div>
    </div>
</div>
 

</main>

<script>
    // Initialize Bootstrap Tags Input
    $(document).ready(function () {
        $('#lecturers').tagsinput({
            trimValue: true,
            confirmKeys: [13, 44], // Enter and comma keys
        });
    });
</script>

<script src="https://cdn.jsdelivr.net/bootstrap.tagsinput/0.8.0/bootstrap-tagsinput.min.js"></script>

