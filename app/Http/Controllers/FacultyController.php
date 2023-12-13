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
    
        foreach ($courses as $currentCourse) {
            // Decode the JSON array in the lecturers column
            $randomVenueArray = $validatedData['venues'][array_rand($validatedData['venues'])];
            $randomVenue = explode(',', $randomVenueArray)[array_rand(explode(',', $randomVenueArray))];
            $currentCourseLecturers = json_decode($currentCourse->lecturers, true);
        
            // Fetch two lecturers from the current course's lecturers
            $selectedLecturerNames = array_slice($currentCourseLecturers, 0, 2);
        
            $currentCourseDepartment = $course->department;
             // Fetch one lecturer from another course related to another department
        $otherDepartmentCourse = Course::where('user_id', '!=', $user->id)
        ->where('department', '!=', $course->department)
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
            $randomLecturerName = 'No available lecturers from other departments';
        }
    } else {
        $randomLecturerName = 'No available lecturers from other departments';
    }

    // Debugging statements
    dd([
        'current_course_department' => $course->department,
        'other_department_course' => $otherDepartmentCourse,
        'other_department_lecturers' => $otherDepartmentLecturers,
        'random_lecturer_name' => $randomLecturerName,
    ]);
        
    
            // Generate exam date iteratively within the selected deadline
            $examDates = $this->generateExamDatesIteratively($startDate, $endDate, count($courses));
    
            // Generate exam time iteratively within the selected start time
            $examTimes = $this->generateExamTimesIteratively(count($courses));
    
            // Check the day and allocate time slots accordingly
            foreach ($courses as $index => $course) {
                // Ensure the index is within the bounds of the date array
                if (isset($examDates[$index]) && isset($examTimes[$index])) {
                    // Create a timetable entry for the course
                    $timetableItem = [
                        'day' => date('l', strtotime($examDates[$index])),
                        'date' => $examDates[$index],
                        'dept' => $course->department,
                        'course_name' => $course->name,
                        'course_code' => $course->code,
                        'venue' => $randomVenue,
                    ];
    
                    // Allocate time slots based on the day of the week
                    if ($this->isWeekday($timetableItem['day'])) {
                        $timetableItem['time'] = $this->allocateWeekdayTimeSlot($examTimes[$index]);
                    } elseif ($this->isFriday($timetableItem['day'])) {
                        $timetableItem['time'] = $this->allocateFridayTimeSlot($examTimes[$index]);
                    }
    
                    // Fetch invigilators and other details
                    $timetableItem['invigilators'] = implode(', ', array_merge($selectedLecturerNames, [$randomLecturerName]));
    
                    // Add the timetable item to the array
                    $timetable[] = $timetableItem;
                }
            }
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
    
            $examDates[] = $currentDate->format('Y-m-d');
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

<<<<<<< Updated upstream
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
    return $randomDate->format('d-m-Y');
}
private function generateExamTime($startTime, $endTime)
{
    $startTimestamp = strtotime($startTime);
    $endTimestamp = strtotime($endTime);

    // Ensure the random timestamp is within the start and end time range
    $randomTimestamp = mt_rand($startTimestamp, $endTimestamp);

    // Calculate the end time exactly 3 hours after the random timestamp
    $endTime = min(strtotime('+3 hours', $randomTimestamp), $endTimestamp);

    // Format the random timestamp and end time
    $randomTime = date('g:i A', $randomTimestamp);
    $formattedEndTime = date('g:i A', $endTime);

    // Format the time range
    $timeRange = $randomTime . ' - ' . $formattedEndTime;

    return $timeRange;
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

=======
    
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

>>>>>>> Stashed changes
