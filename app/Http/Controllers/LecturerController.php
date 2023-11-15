<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Lecturer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LecturerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $user = auth()->user(); // Get the authenticated user
        $lecturers = Lecturer::where('user_id', $user->id)->get(); // Filter Lecturers based on user ID
        $lecturers = Lecturer::all();

        return view('user.lecturers', compact('lecturers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = auth()->user(); // Get the authenticated user
        $lecturers = Lecturer::where('user_id', $user->id)->get(); // Filter Lecturers based on user ID
        $lecturers = Lecturer::all();

        return view('user.lecturers');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
{
    $request->validate([
        'name' => 'required',
        'email' => 'nullable|email',
    ]);

    $user = Auth::user(); // Get the authenticated user
    $lecturerData = $request->all(); // Get all lecturer data
    $lecturerData['user_id'] = $user->id; // Add user ID to lecturer data

    Lecturer::create($lecturerData); // Create new lecturer record in the database

    return redirect()->route('lecturers.index')
        ->with('success', 'Lecturer created successfully.');
}

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Lecturer  $lecturer
     * @return \Illuminate\Http\Response
     */
    public function show(Lecturer $lecturer)
    {
        $user = auth()->user(); // Get the authenticated user
        $lecturers = Lecturer::where('user_id', $user->id)->get(); // Filter Lecturers based on user ID
           
        // Check if the lecturer belongs to the currently authenticated user
        if ($lecturer->user_id !== $user->id) {
            abort(403, 'Unauthorized action.'); // Return a 403 Forbidden response if the lecturer does not belong to the user
        }
    
        $lecturers = Lecturer::where('user_id', $user->id)->get(); // Fetch all lecturers created by the user
    
        return view('user.lecturers', compact('lecturers'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Lecturer  $lecturer
     * @return \Illuminate\Http\Response
     */
    public function edit(Lecturer $lecturer)
    {$user = auth()->user(); // Get the authenticated user
        $lecturers = Lecturer::where('user_id', $user->id)->get();
        return view('lecturers.edit', compact('lecturer'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Lecturer  $lecturer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Lecturer $lecturer)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required|digits:11',
        ]);

        $lecturer->update($request->all());

        return redirect()->route('lecturers.index')
                        ->with('success','Lecturer updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Lecturer  $lecturer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Lecturer $lecturer)
{
    $user = Auth::user(); // Get the currently authenticated user

    // Check if the lecturer belongs to the currently authenticated user
    if ($lecturer->user_id !== $user->id) {
        abort(403, 'Unauthorized action.'); // Return a 403 Forbidden response if the lecturer does not belong to the user
    }

    $lecturer->delete();

    return redirect()->route('lecturers.index')
                    ->with('success','Lecturer deleted successfully.');
}
}