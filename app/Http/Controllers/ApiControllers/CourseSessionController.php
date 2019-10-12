<?php

namespace App\Http\Controllers\ApiControllers;

use App\Course;
use App\CourseSession;
use App\Http\Controllers\Controller;
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
        return response()->json($sessions);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Course $course)
    {
        return response()->json([]);
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
        ]);

        $session = new CourseSession();
        $session->course_id = $course->id;
        $session->save();

        foreach ($course->students as $student){
            $session->students()->attach($student->id, ['presence' => (in_array($student->id, $validatedData['students'])?1:0)]);
        }

        $students = $session->students()->where('presence', 1)->get();
        return response()->json(['session' => $session, 'students' => $students]);
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
        return response()->json(['session' => $session, 'students' => $students]);
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
        return response()->json([]);
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

        $students = $session->students()->where('presence', 1)->get();
        return response()->json(['session' => $session, 'students' => $students]);
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
        if($session->delete()){
            return response()->json(['success' => true, 'message' => "The '$datetime' session is successfully deleted!"]);
        }else{
            return response()->json(['success' => false, 'message' => "there is error on session delete!"]);
        }
    }
}
