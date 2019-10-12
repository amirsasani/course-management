<?php

namespace App\Http\Controllers;

use App\Course;
use App\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $students = Student::all();
        return view('student.index', compact('students'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('student.insert');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'student_no' => 'required|digits_between:2,50|unique:students',
            'fname' => 'required|string|max:255',
            'lname' => 'required|string|max:255',
        ]);

        $student = Student::create($validatedData);

        return redirect(route('student.index'))->with('success', "Student '$student->fname $student->lname' is successfully created");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function show(Student $student)
    {
        return view('student.show', compact('student'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function edit(Student $student)
    {
        return view('student.update', compact('student'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Student $student)
    {
        $validatedData = $request->validate([
            'student_no' => 'required|digits_between:2,50|unique:students',
            'fname' => 'required|string|max:255',
            'lname' => 'required|string|max:255',
        ]);

        $student->student_no = $validatedData['student_no'];
        $student->fname = $validatedData['fname'];
        $student->lname = $validatedData['lname'];
        $student->saveOrFail();

        return redirect(route('student.index'))->with('success', "Student '$student->fname $student->lname' is successfully updated!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy(Student $student)
    {
        $name = $student->fname . ' ' . $student->lname;
        if($student->delete())
            return redirect(route('student.index'))->with('success', "Student '$name' is successfully deleted!");
    }

    public function listStudentsToAdd(Course $course)
    {
        $students = Student::whereNotIn('id', $course->students()->pluck('student_id'))->get();
        return view('course.add_students', compact('students', 'course'));
    }

    public function addStudentToCourse(Request $request, Course $course)
    {
        $validatedData = $request->validate([
            'students' => 'required',
        ]);

        $course->students()->saveMany(Student::find($validatedData['students']));

        return redirect(route('course.show', $course))->with('success', count($validatedData['students']) . " student(s) successfully added to '$course->title'");
    }

    public function destroyStudentFromCourse(Course $course, Student $student)
    {
        $course->students()->detach([$student->id]);
        return redirect(route('course.show', $course))->with('success', "Student successfully removed from '$course->title'");
    }
}
