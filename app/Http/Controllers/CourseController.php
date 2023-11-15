<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\User;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
{
    $user = auth()->user(); // Get the authenticated user
    $courses = Course::where('user_id', $user->id)->get(); // Filter courses based on user ID

    return view('user.courses', compact('courses'));
}


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
   public function create()
{
    $courses = Course::all();
    return view('user.courses', compact('courses'));
}


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
public function show(Course $course)
{   $courses = Course::all();
    return view('user.courses', compact('course'));
}


public function save(Request $request)
{
    $request->validate([
        'name' => 'required',
        'code' => 'required|unique:courses',
        'credit_hours' => 'nullable|numeric',
        'lecturers' => 'required|string',
    ]);
    $user = auth()->user();
    $lecturers = explode(",", $request->input('lecturers')); // Split lecturer names into an array
    $lecturersJson = json_encode($lecturers); // Convert array to JSON string

    $course = new Course();
    $course->user_id = $user->id;
    $course->name = $request->input('name');
    $course->code = $request->input('code');
    $course->credit_hours = $request->input('credit_hours');
    $course->lecturers = $lecturersJson; // Save JSON string to 'lecturers' column

    try {
        $course->save();
        return redirect()->route('courses.index')->with('success', 'Course created successfully.');
    } catch (Exception $e) {
        // Handle validation errors
        $errors = $e->getMessage(); // Extract error message
        return redirect()->back()->withInput($request->all())->withErrors(['validation' => $errors]);
    }
}





    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
   
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function edit(Course $course)
    {
        return view('user.cedit', compact('course'));
    }
   
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Course $course)
    {
        $request->validate([
            'name' => 'nullable',
            'code' => 'nullable|unique:courses,code,'.$course->id,
            'credit_hours' => 'nullable|numeric',
            'lecturers' => 'nullable|array',
        ]);

        $course->update($request->all());

        return redirect()->route('courses.index')
                        ->with('success','Course updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function destroy(Course $course)
    {
        $course->delete();

        return redirect()->route('courses.index')
                        ->with('success','Course deleted successfully.');
    }
}