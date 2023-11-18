<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\User;
use App\Models\Faculty;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use PDF;
use DateTime;
use DateInterval;

class FacultyController extends Controller
{
    public function index()
    {
        return view('user.timetable');
    }

    public function generateTimetable(Request $request)
    {

        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'Please log in to access this feature.');
        }
        
        // Validate the form data
        $validator = Validator::make($request->all(), [
            'start' => 'required|date',
            'end' => 'required|date|after:start',
            'venues' => 'required|array',
            'venues.*' => 'nullable|string',
            'timestart' => 'required|date_format:H:i',
            'timeend' => 'required|date_format:H:i|after:timestart',
        ]);
    
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
            
        }
        

        // Store validated form data in the session
        Session::put('validated_data', $request->all());

        // Retrieve validated form data from the session
        $validatedData = Session::get('validated_data');
       
        // Get the selected deadline for exams
        $startDate = $validatedData['start'];
        $endDate = $validatedData['end'];
        $venues = $validatedData['venues'];
        $deadline = $endDate; // Use the end date as the deadline

    // Get the authenticated user
    $user = auth()->user();

    // Fetch all courses related to the authenticated user
    $courses = Course::where('user_id', $user->id)->get();

    // Generate timetable data
    $timetable = [];
   
 


    foreach ($courses as $course) {
        // Decode the JSON array in the lecturers column
        // $randomVenue = $validatedData['venues'][array_rand($validatedData['venues'])];
        $randomVenueArray = $validatedData['venues'][array_rand($validatedData['venues'])];
        $randomVenue = explode(',', $randomVenueArray)[array_rand(explode(',', $randomVenueArray))];
        $courseLecturers = json_decode($course->lecturers, true);

        // Fetch two lecturers from the course's lecturers
        $selectedLecturerNames = array_slice($courseLecturers, 0, 2);

    // Fetch a random lecturer from any other user's courses
    $otherUserCourses = Course::where('user_id', '!=', $user->id)->get();
    $allOtherUserLecturers = $otherUserCourses->pluck('lecturers')->flatten()->unique()->all();

    // Decode the JSON array in other user's courses
    $allOtherUserLecturers = array_map(function ($lecturer) {
        return json_decode($lecturer, true);
    }, $allOtherUserLecturers);

    // Flatten and make it unique
    $allOtherUserLecturers = array_unique(array_merge(...$allOtherUserLecturers));

    // Exclude lecturers already selected for this course
    $availableLecturers = array_diff($allOtherUserLecturers, $selectedLecturerNames);

    // Fetch a random lecturer from the available pool
    $randomLecturerName = $availableLecturers[array_rand($availableLecturers)];


        // Generate exam date within the selected deadline
        $examDate = $this->generateExamDate($startDate, $endDate);

        // Generate exam time between the selected start and end time
        $examTime = $this->generateExamTime($request->input('timestart'), $request->input('timeend'));
       
       
        
    // Create a timetable entry for the course
    $timetableItem = [
        'day' => date('l', strtotime($examDate)),
        'time' => $examTime,
        'course_name' => $course->name,
        'course_code' => $course->code,
        'invigilators' => implode(', ', array_merge($selectedLecturerNames, [$randomLecturerName])),
        'venue' => $randomVenue,
        'date' => $examDate,
    ];
    // dd($randomVenue);

// dd($timetableItem);
    // Add the timetable item to the array
    $timetable[] = $timetableItem;
}
// Store timetable data in session
Session::put('timetable', $timetable);

// Generate a filename based on the current date and time
$filename = 'timetable_' . date('Y-m-d_H:i:s') . '.pdf';

return view('user.timetable-preview', compact('timetable', 'filename'));

}


public function timetablePreview($filename)
{
    if (!auth()->check()) {
        return redirect()->route('login');
    }
    // Retrieve timetable data from the session
    $timetable = session('timetable');


    // Set the full path for the PDF file
    $filePath = public_path('storage/' . $filename);

    // Check if the file exists
    if (!file_exists($filePath)) {
        abort(404);
    }

    return view('user.timetable-preview', compact('timetable', 'filename'));

}

private function generateExamDate($startDate, $endDate)
{
    $startDateTime = new DateTime($startDate);
    $endDateTime = new DateTime($endDate);

    // Calculate the difference between start and end dates
    $dateDifference = $startDateTime->diff($endDateTime);

    // Calculate the total number of days in the date range
    $totalDays = $dateDifference->days;

    // Generate a random number of days within the date range
    $randomDays = mt_rand(0, $totalDays);

    // Add the random number of days to the start date
    $randomDate = $startDateTime->add(new DateInterval("P{$randomDays}D"));

    // Ensure the generated date falls on a weekday (Monday to Friday)
    while ($randomDate->format('N') >= 6) {
        $randomDate->add(new DateInterval("P1D"));
    }

    // Return the formatted date
    return $randomDate->format('Y-m-d');
}
private function generateExamTime($startTime, $endTime)
{
    $startTimestamp = strtotime($startTime);
    $endTimestamp = strtotime($endTime);

    // Generate a random timestamp between the start and end time
    $randomTimestamp = mt_rand($startTimestamp, $endTimestamp);

    // Format the random timestamp as desired
    $randomTime = date('g:i A', $randomTimestamp);

    // Generate the end time by adding 3 hours to the random timestamp
    $endTime = min(strtotime('+3 hours', $randomTimestamp), $endTimestamp);
    $endTime = date('g:i A', $endTime);

    // Format the time range
    $timeRange = $randomTime . ' - ' . $endTime;

    return $timeRange;
}

    
    public function downloadTimetable()
    {
        $timetable = Session::get('timetable');
    
        // Generate the PDF and download it
        return PDF::loadView('user.timetable-preview', compact('timetable'))
            ->download('timetable_' . date('Y-m-d_H:i:s') . '.pdf');
    }
    
}