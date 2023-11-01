<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\User;
use Illuminate\Http\Request;
use PDF;

class FacultyController extends Controller
{
    public function generateTimetable(Request $request)
    {
        // Get the selected deadline for exams
        $deadline = $request->input('deadline');

        // Fetch all courses
        $courses = Course::all();

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
            $examDate = $this->generateExamDate($deadline);

            // Generate exam time between 8am and 6pm, and ensure that the duration is within 3 hours
            list($examTime, $examDuration) = $this->generateExamTime();

            // Generate a venue for the exam
            $venue = $this->generateVenue();

            // Create a timetable entry for the course
            $timetable[] = [
                'time' => $examTime,
                'duration' => $examDuration,
                'course_name' => $course->name,
                'course_code' => $course->code,
                'invigilators' => $lecturers->pluck('name')->implode(', '),
                'venue' => $venue,
                'date' => $examDate,
            ];
        }

        // Generate the PDF timetable
        $pdf = PDF::loadView('timetable', compact('timetable'));

        // Save the PDF to a file
        $pdf->save('timetable.pdf');

        // Return a response indicating success
        return response()->json(['message' => 'Timetable generated successfully']);
    }

    private function generateExamDate($deadline)
    {
        $today = now();

        // Calculate the number of days between today and the deadline
        $days = $today->diffInDays($deadline);

        // Generate a random date within the selected deadline
        $date = $today->addDays(rand(1, $days));

        // Ensure the generated date falls on a weekday (Monday to Friday)
        while (!$date->isWeekday()) {
            $date->addDays(1);
        }

        return $date->format('Y-m-d');
    }

    private function generateExamTime()
    {
        $startHour = 8; // Exam start time: 8am
        $endHour = 18; // Exam end time: 6pm

        // Calculate the maximum duration for exams (3 hours)
        $maxDuration = 180; // 3 hours in minutes

        // Generate a random time between the given start and end hours
        $hour = rand($startHour, $endHour);

        // Ensure the exam duration does not exceed the maximum
        $maxMinute = min(60, $maxDuration);
        $minute = rand(0, $maxMinute);

        return [sprintf('%02d:%02d', $hour, $minute), $maxDuration];
    }

    private function generateVenue()
    {
        // Generate a random venue for the exam
        $venues = ['Room A', 'Room B', 'Room C', 'Room D'];
        $venue = $venues[array_rand($venues)];

        return $venue;
    }
}
