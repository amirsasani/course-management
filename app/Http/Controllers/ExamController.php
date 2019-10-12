<?php

namespace App\Http\Controllers;

use App\Course;
use App\Exam;
use Illuminate\Http\Request;
use PDF;

class ExamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Course $course)
    {
        return view('exam.insert', compact('course'));
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

        return redirect(route('course.show', $course))->with('success', "The '$course->title' courses '$exam->title' exam successfully added");
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Exam $exam
     * @return \Illuminate\Http\Response
     */
    public function show(Course $course, Exam $exam)
    {
        return view('exam.show', compact('course', 'exam'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Exam $exam
     * @return \Illuminate\Http\Response
     */
    public function edit(Course $course, Exam $exam)
    {
        return view('exam.update', compact('course', 'exam'));
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

        return redirect(route('course.show', $course))->with('success', "The '$course->title' courses '$exam->title' exam successfully added");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Exam $exam
     * @return \Illuminate\Http\Response
     */
    public function destroy(Course $course, Exam $exam)
    {
        //
    }

    public function generate(Request $request, Course $course, Exam $exam)
    {
        set_time_limit(300);



            $questions = array();
            $correct_choices = array();
            foreach ($exam->questions()->get()->shuffle()->all() as $index => $question) {
                $questions[$question->title] = $question->choices()->get()->shuffle()->all();
            }

            $in = 0;
            foreach ($questions as $q) {
                foreach ($q as $i => $c) {
                    if ($c->correct == 1) {
                        $correct_choices[$in + 1] = $i + 1;
                    }
                }
                $in++;
            }


        return view('exam.generate', compact('course', 'exam', 'questions', 'correct_choices'));

//        return view('exam.answer_sheet', compact('course', 'exam', 'serie', 'correct_choices'));
    }
}
