<?php

namespace App\Http\Controllers\ApiControllers;

use App\Course;
use App\Exam;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use PDF;

class ExamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Course $course)
    {
        $exams = $course->exams;
        return response()->json($exams);
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
            'title' => 'required|string|max:255',
        ]);

        $exam = $course->exams()->save(new Exam($validatedData));

        return response()->json($exam);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Exam $exam
     * @return \Illuminate\Http\Response
     */
    public function show(Course $course, Exam $exam)
    {
        return response()->json([]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Exam $exam
     * @return \Illuminate\Http\Response
     */
    public function edit(Course $course, Exam $exam)
    {
        return response()->json([]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Exam $exam
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Course $course, Exam $exam)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
        ]);

        $exam->title = $validatedData['title'];
        $exam->saveOrFail();

        return response()->json($exam);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Exam $exam
     * @return \Illuminate\Http\Response
     */
    public function destroy(Course $course, Exam $exam)
    {
        $title = $course->title;
        if($exam->delete()){
            return response()->json(['success' => true, 'message' => "The '$title' exam is successfully deleted!"]);
        }else{
            return response()->json(['success' => false, 'message' => "there is error on exam delete!"]);
        }
    }
}
