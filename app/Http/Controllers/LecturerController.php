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

        $user = Auth::user(); 
        $lecturerData = $request->all();
        $lecturerData['user_id'] = $user->id; 

        Lecturer::create($lecturerData);

        return redirect()->route('lecturers.index')
                        ->with('success','Lecturer created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Lecturer  $lecturer
     * @return \Illuminate\Http\Response
     */
    public function show(Lecturer $lecturer)
    {
           
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
    {
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