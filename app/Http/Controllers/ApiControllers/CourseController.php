<?php

namespace App\Http\Controllers\ApiControllers;

use App\Course;
use App\Http\Controllers\Controller;
use App\Student;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $courses = Course::with(['sessions', 'students', 'exams'])->get()->all();
        return response()->json($courses);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return response()->json([]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
        ]);

        $course = Course::create($validatedData);

        return response()->json($course);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Course $course
     * @return \Illuminate\Http\Response
     */
    public function show(Course $course)
    {
        return response()->json([]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Course $course
     * @return \Illuminate\Http\Response
     */
    public function edit(Course $course)
    {
        return response()->json([]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Course $course
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Course $course)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
        ]);

        $course->title = $validatedData['title'];
        $course->saveOrFail();

        return response()->json($course);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Course $course
     * @return \Illuminate\Http\Response
     */
    public function destroy(Course $course)
    {
        $title = $course->title;
        if($course->delete()){
            return response()->json(['success' => true, 'message' => "The '$title' course is successfully deleted!"]);
        }else{
            return response()->json(['success' => false, 'message' => "there is error on course delete!"]);
        }
    }
}
