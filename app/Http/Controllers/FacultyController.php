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

    // Generate exam date iteratively within the selected deadline
    $examDates = $this->generateExamDatesIteratively($startDate, $endDate, count($courses));

    // Iterate through the exam dates
    foreach ($examDates as $index => $examDate) {
        // Fetch one lecturer from another course related to another department
        $currentCourse = $courses[$index];

        $otherDepartmentCourse = Course::where('user_id', '!=', $user->id)
            ->where('department', '!=', $currentCourse->department)
            ->whereNotNull('lecturers')
            ->inRandomOrder()
            ->first();

        $otherDepartmentLecturers = [];

        if ($otherDepartmentCourse) {
            $otherDepartmentLecturers = json_decode($otherDepartmentCourse->lecturers, true);

            if ($otherDepartmentLecturers) {
                // Select a random lecturer from the fetched department
                $randomLecturerName = $otherDepartmentLecturers[array_rand($otherDepartmentLecturers)];
            } else {
                $randomLecturerName = '';
            }
        } else {
            $randomLecturerName = '';
        }

        // Fetch two lecturers from the current course's lecturers
        $currentCourseLecturers = json_decode($currentCourse->lecturers, true);
        $selectedLecturerNames = array_slice($currentCourseLecturers, 0, 2);

        // Decode the JSON array in the venues column
        $randomVenueArray = $validatedData['venues'][array_rand($validatedData['venues'])];
        $randomVenue = explode(',', $randomVenueArray)[array_rand(explode(',', $randomVenueArray))];

        // Create a timetable entry for the course
        $timetableItem = [
            'day' => date('l', strtotime($examDate)),
            'date' => $examDate,
            'dept' => $currentCourse->department,
            'course_name' => $currentCourse->name,
            'course_code' => $currentCourse->code,
            'venue' => $randomVenue,
        ];

        // Allocate time slots based on the day of the week
        if ($this->isWeekday($timetableItem['day'])) {
            $timetableItem['time'] = $this->allocateWeekdayTimeSlot($examDate);
        } elseif ($this->isFriday($timetableItem['day'])) {
            $timetableItem['time'] = $this->allocateFridayTimeSlot($examDate);
        }

        // Fetch invigilators and other details
        $timetableItem['invigilators'] = implode(', ', array_merge($selectedLecturerNames, [$randomLecturerName]));

        // Add the timetable item to the array
        $timetable[] = $timetableItem;
    
        }
    
        // Store timetable data in session
        Session::put('timetable', $timetable);
    
        // Generate a filename based on the current date and time
        $filename = 'timetable_' . date('Y-m-d_H:i:s') . '.pdf';
    
        return view('user.timetable-preview', compact('timetable', 'filename'));
    }
 

    private function generateExamTimesIteratively($numExams)
{
    $examTimes = [];
    $startTime = DateTime::createFromFormat('H:i', '09:00'); // Assuming a default start time of 9:00 AM

    if ($startTime === false) {
        // Handle the error when creating the DateTime object
        return $examTimes;
    }

    for ($i = 0; $i < $numExams; $i++) {
        $formattedStartTime = $startTime->format('H:i');
        $examTimes[] = "{$formattedStartTime} - " . $startTime->add(new DateInterval('PT3H'))->format('H:i');
    }

    return $examTimes;
}

private function allocateWeekdayTimeSlot($startTime)
{
    // Allocate time slots for Monday to Thursday
    $timeSlots = ['9:00 AM - 11:30 AM', '12:00 PM - 2:30 PM', '3:00 PM - 5:30 PM'];
    // Use modulo to cycle through the available time slots
    $slotIndex = rand(0, count($timeSlots) - 1);
    return $timeSlots[$slotIndex];
}

private function allocateFridayTimeSlot($startTime)
{
    // Allocate time slots for Friday
    return '9:00 AM - 11:30 AM';
}

    
private function generateExamDatesIteratively($startDate, $endDate, $numExams)
{
    $examDates = [];
    $currentDate = new DateTime($startDate);
    $end = new DateTime($endDate);

    for ($i = 0; $i < $numExams; $i++) {
        // Skip weekends (Saturday and Sunday)
        while (in_array($currentDate->format('N'), [6, 7])) {
            $currentDate->add(new DateInterval('P1D'));
        }

        // Break if the current date exceeds the end date
        if ($currentDate > $end) {
            break;
        }

        $examDates[] = $currentDate->format('d-m-Y');
        $currentDate->add(new DateInterval("P1D")); // Add 1 day to the current date
    }

    return $examDates;
}

    
    private function isWeekday($day)
    {
        return in_array($day, ['Monday', 'Tuesday', 'Wednesday', 'Thursday']);
    }
    
    private function isFriday($day)
    {
        return $day === 'Friday';
    }
    


    
    public function downloadTimetable()
    {
        $timetable = Session::get('timetable');
    
        // Generate the PDF and download it
        return PDF::loadView('user.timetable-preview', compact('timetable'))
            ->download('timetable_' . date('Y-m-d_H:i:s') . '.pdf');
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

    
}

