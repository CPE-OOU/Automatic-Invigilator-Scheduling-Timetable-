<?php

namespace App\Http\Controllers;

use App\Models\ExaminationVenue;
use Illuminate\Http\Request;

class ExaminationVenueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $examinationVenues = ExaminationVenue::all();

        return view('examinationvenues.index', compact('examinationVenues'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('examinationvenues.create');
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
            'capacity' => 'required|numeric',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $imageName = time().'.'.$request->image->extension();

        $request->image->move(public_path('images/examinationvenues'), $imageName);

        ExaminationVenue::create([
            'name' => $request->name,
            'capacity' => $request->capacity,
            'image' => $imageName,
        ]);

        return redirect()->route('examinationvenues.index')
                        ->with('success','Examination Venue created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ExaminationVenue  $examinationVenue
     * @return \Illuminate\Http\Response
     */
    public function show(ExaminationVenue $examinationVenue)
    {
        return view('examinationvenues.show', compact('examinationVenue'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ExaminationVenue  $examinationVenue
     * @return \Illuminate\Http\Response
     */
    public function edit(ExaminationVenue $examinationVenue)
    {
        return view('examinationvenues.edit', compact('examinationVenue'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ExaminationVenue  $examinationVenue
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ExaminationVenue $examinationVenue)
    {
        $request->validate([
            'name' => 'required',
            'capacity' => 'required|numeric',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $imageName = time().'.'.$request->image->extension();

            $request->image->move(public_path('images/examinationvenues'), $imageName);

            $examinationVenue->image = $imageName;
        }

        $examinationVenue->update([
            'name' => $request->name,
            'capacity' => $request->capacity,
        ]);

        return redirect()->route('examinationvenues.index')
                        ->with('success','Examination Venue updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ExaminationVenue  $examinationVenue
     * @return \Illuminate\Http\Response
     */
    public function destroy(ExaminationVenue $examinationVenue)
    {
        $examinationVenue->delete();

        return redirect()->route('examinationvenues.index')
                        ->with('success','Examination Venue deleted successfully.');
    }
}
