<?php

namespace App\Http\Controllers;

use App\Course;
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
        $courses = Course::all();
        return view('course.index', compact('courses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('course.insert');
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

        return redirect(route('course.index'))->with('success', "The '$course->title' course is successfully added");
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Course $course
     * @return \Illuminate\Http\Response
     */
    public function show(Course $course)
    {
        return view('course.show', compact('course'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Course $course
     * @return \Illuminate\Http\Response
     */
    public function edit(Course $course)
    {
        return view('course.update', compact('course'));
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

        return redirect(route('course.index'))->with('success', "The '$course->title' course is successfully updated!");
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
            return redirect(route('course.index'))->with('success', "The '$title' course is successfully deleted!");
        }
    }
}
