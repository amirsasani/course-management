<?php

namespace App\Http\Controllers\ApiControllers;

use App\Exam;
use App\Http\Controllers\Controller;
use App\Question;
use Illuminate\Http\Request;

class QuestionController extends Controller
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
    public function create(Exam $exam)
    {
        return view('question.insert', compact('exam'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Exam $exam)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'choice' => 'required|array|min:2|max:4',
            'choice.*' => 'required|string',
            'correct' => 'required|digits:1'
        ]);

        $question = $exam->questions()->create(['title' => $validatedData['title']]);
        $correct = intval($validatedData['correct']);

        foreach ($validatedData['choice'] as $index => $choice) {
            $question->choices()->create(['title' => $choice, 'correct' => ($correct - 1 == $index) ? 1 : 0]);
        }

        return redirect(route('course.exam.show', ['course' => $exam, 'exam' => $exam]))->with('success', "The '$exam->title' Exam question successfully added");
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Question $question
     * @return \Illuminate\Http\Response
     */
    public function show(Exam $exam, Question $question)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Question $question
     * @return \Illuminate\Http\Response
     */
    public function edit(Exam $exam, Question $question)
    {
        $choices = $question->choices()->get();
        return view('question.update', compact('exam', 'question', 'choices'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Question $question
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Exam $exam, Question $question)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'choice' => 'required|array|min:2|max:4',
            'choice.*' => 'required|string',
            'correct' => 'required|digits:1'
        ]);

        $question->title = $validatedData['title'];

        $correct = intval($validatedData['correct']);


        $choices = $question->choices()->get()->all();

        foreach ($validatedData['choice'] as $index => $choice) {
            $choices[$index]->title = $choice;
            $choices[$index]->correct = ($correct - 1 == $index) ? 1 : 0;
            $choices[$index]->save();
        }

        $question->saveOrFail();

        return redirect(route('course.exam.show', ['course' => $exam, 'exam' => $exam]))->with('success', "The '$exam->title' Exam question successfully updated!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Exam $exam
     * @param \App\Question $question
     * @return \Illuminate\Http\Response
     */
    public function destroy(Exam $exam, Question $question)
    {
        $title = $question->title;
        if($question->delete())
            return redirect(route('course.exam.show', ['course' => $exam, 'exam' => $exam]))->with('success', "'$title' question successfully deleted!");
    }
}
