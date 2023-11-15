<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\User;
use App\Models\Faculty;
use Illuminate\Http\Request;
use PDF;

class FacultyController extends Controller
{
    public function index()
    {
        return view('user.timetable');
    }

    public function generateTimetable(Request $request)
    {
        $request->validate([
            'start' => 'required|date',
            'end' => 'required|date|after:start',
            'venues' => 'required|array',
            'venues.*' => 'required|string',
            'timestart' => 'required|date_format:H:i',
            'timeend' => 'required|date_format:H:i|after:timestart',
        ]);

        // Get the selected deadline for exams
        $startDate = $request->input('start');
        $endDate = $request->input('end');
        $venues = $request->input('venues');
        $deadline = $endDate; // Use the end date as the deadline

        // Get the authenticated user
        $user = auth()->user();

        // Fetch all courses related to the authenticated user
        $courses = Course::where('user_id', $user->id)->get();

        // Initialize an empty timetable array
        $timetable = [];

        // Iterate through each course
        foreach ($courses as $course) {
            // Fetch the two attached lecturers for the course
            $lecturers = $course->lecturers()->take(2)->get();

            // Fetch a random third lecturer from other users
            $thirdLecturer = User::whereNotNull('invigilator_id')
                ->whereNotIn('id', $lecturers->pluck('id'))
                ->inRandomOrder()
                ->first();

            // Attach the third lecturer to the course
            $lecturers[] = $thirdLecturer;

            // Generate exam date within the selected deadline
            $examDate = $this->generateExamDate($startDate, $endDate);

            // Generate exam time between the selected start and end time
            $examTime = $this->generateExamTime($request->input('timestart'), $request->input('timeend'));

            // Generate a venue for the exam
            $venue = $request->input('venue');

            // Create a timetable entry for the course
            $timetable[] = [
                'time' => $examTime,
                'course_name' => $course->name,
                'course_code' => $course->code,
                'invigilators' => $lecturers->pluck('name')->implode(', '),
                'venue' => $venue,
                'date' => $examDate,
            ];
        }

        // Generate the PDF timetable
        $pdf = PDF::loadView('timetable', compact('timetable'));

        // Send the PDF as a download
        return $pdf->download('timetable.pdf');
    }

    private function generateExamDate($startDate, $endDate)
    {
        $startTimestamp = strtotime($startDate);
        $endTimestamp = strtotime($endDate);

        // Calculate the number of days between the start and end date
        $days = ($endTimestamp - $startTimestamp) / (60 * 60 * 24);

        // Generate a random date within the selected start and end date
        $date = date('Y-m-d', strtotime("+$days days", $startTimestamp));

        // Ensure the generated date falls on a weekday (Monday to Friday)
        while (date('N', strtotime($date)) >= 6) {
            $date = date('Y-m-d', strtotime("+1 day", strtotime($date)));
        }

        return $date;
    }

    private function generateExamTime($startTime, $endTime)
    {
        // Generate a random time between the given start and end time
        $startTimestamp = strtotime($startTime);
        $endTimestamp = strtotime($endTime);

        $timestamp = rand($startTimestamp, $endTimestamp);
        $time = date('H:i', $timestamp);

        return $time;
    }
}