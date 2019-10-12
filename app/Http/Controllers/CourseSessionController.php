<?php

namespace App\Http\Controllers;

use App\Course;
use App\CourseSession;
use App\Student;
use Illuminate\Http\Request;

class CourseSessionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Course $course)
    {
        $sessions = $course->sessions;
        return view('session.index', compact('sessions', 'course'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Course $course)
    {
        return view('session.insert', compact('course'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Course $course)
    {
        $validatedData = $request->validate([
            'students' => 'required',
            'description' => 'string',
        ]);

        $session = new CourseSession();
        $session->course_id = $course->id;
        $session->description = $validatedData['description'];
        $session->save();

        foreach ($course->students as $student){
            $session->students()->attach($student->id, ['presence' => (in_array($student->id, $validatedData['students'])?1:0)]);
        }

        return redirect(route('course.show', $course))->with('success', "session successfully added to '$course->title'");
    }

    /**
     * Display the specified resource.
     *
     * @param \App\CourseSession $session
     * @return \Illuminate\Http\Response
     */
    public function show(Course $course, CourseSession $session)
    {
        $students = $session->students()->where('presence', 1)->get();
        return view('session.show', compact('session', 'course', 'students'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\CourseSession $session
     * @return \Illuminate\Http\Response
     */
    public function edit(Course $course, CourseSession $session)
    {
        $students = $session->students;
        return view('session.update', compact('session', 'course', 'students'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\CourseSession $session
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Course $course, CourseSession $session)
    {
        $validatedData = $request->validate([
            'students' => 'required',
        ]);

        foreach ($course->students as $student){
            $session->students()->syncWithoutDetaching([$student->id => ['presence' => (in_array($student->id, $validatedData['students'])?1:0)]]);
        }

        return redirect(route('course.show', $course))->with('success', "'$course->title' course session successfully updated!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\CourseSession $session
     * @return \Illuminate\Http\Response
     */
    public function destroy(Course $course, CourseSession $session)
    {
        $datetime = $session->created_at->format('d/m/Y H:i:s');
        if($session->delete())
            return redirect(route('course.show', $course))->with('success', "'$course->title' course session '$datetime' successfully deleted!");
    }
}
