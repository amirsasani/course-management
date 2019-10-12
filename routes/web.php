<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */

Auth::routes();

Route::group(['middleware' => ['auth']], function () {
    Route::get('/', 'CourseController@index')->name('home');
    Route::get('/home', 'CourseController@index');

    Route::get('course/{course}/student/add', array('as' => 'course.student.add_list', 'uses' => 'StudentController@listStudentsToAdd'));
    Route::post('course/{course}/student/add', array('as' => 'course.student.add', 'uses' => 'StudentController@addStudentToCourse'));
    Route::delete('course/{course}/student/{student}/destroy', array('as' => 'course.student.destroy', 'uses' => 'StudentController@destroyStudentFromCourse'));
    Route::resource('course', 'CourseController');


    Route::resource('student', 'StudentController');

//  Course session routes
    Route::post('course/{course}/session', array('as' => 'course.session.store', 'uses' => 'CourseSessionController@store'));
    Route::get('course/{course}/session', array('as' => 'course.session.index', 'uses' => 'CourseSessionController@index'));
    Route::get('course/{course}/session/create', array('as' => 'course.session.create', 'uses' => 'CourseSessionController@create'));
    Route::delete('course/{course}/session/{session}/destroy', array('as' => 'course.session.destroy', 'uses' => 'CourseSessionController@destroy'));
    Route::put('course/{course}/session/{session}/update', array('as' => 'course.session.update', 'uses' => 'CourseSessionController@update'));
    Route::get('course/{course}/session/{session}/show', array('as' => 'course.session.show', 'uses' => 'CourseSessionController@show'));
    Route::get('course/{course}/session/{session}/edit', array('as' => 'course.session.edit', 'uses' => 'CourseSessionController@edit'));

//   Course student routes
//    Route::post('course/{course}/student', array('as' => 'course.student.store', 'uses' => 'StudentController@store'));
//    Route::get('course/{course}/student', array('as' => 'course.student.index', 'uses' => 'StudentController@index'));
//    Route::get('course/{course}/student/create', array('as' => 'course.student.create', 'uses' => 'StudentController@create'));
//    Route::delete('course/{course}/student/{student}/destroy', array('as' => 'course.student.destroy', 'uses' => 'StudentController@destroy'));
//    Route::put('course/{course}/student/{student}/update', array('as' => 'course.student.update', 'uses' => 'StudentController@update'));
//    Route::get('course/{course}/student/{student}/show', array('as' => 'course.student.show', 'uses' => 'StudentController@show'));
//    Route::get('course/{course}/student/{student}/edit', array('as' => 'course.student.edit', 'uses' => 'StudentController@edit'));


    //  Course "exam" routes
    Route::post('course/{course}/exam', array('as' => 'course.exam.store', 'uses' => 'ExamController@store'));
    Route::get('course/{course}/exam', array('as' => 'course.exam.index', 'uses' => 'ExamController@index'));
    Route::get('course/{course}/exam/create', array('as' => 'course.exam.create', 'uses' => 'ExamController@create'));
    Route::delete('course/{course}/exam/{exam}/destroy', array('as' => 'course.exam.destroy', 'uses' => 'ExamController@destroy'));
    Route::put('course/{course}/exam/{exam}/update', array('as' => 'course.exam.update', 'uses' => 'ExamController@update'));
    Route::get('course/{course}/exam/{exam}/show', array('as' => 'course.exam.show', 'uses' => 'ExamController@show'));
    Route::get('course/{course}/exam/{exam}/edit', array('as' => 'course.exam.edit', 'uses' => 'ExamController@edit'));
    Route::get('course/{course}/exam/{exam}/generate', array('as' => 'course.exam.generate', 'uses' => 'ExamController@generate'));

    //  exam "question" routes
    Route::post('exam/{exam}/question', array('as' => 'exam.question.store', 'uses' => 'QuestionController@store'));
    Route::get('exam/{exam}/question', array('as' => 'exam.question.index', 'uses' => 'QuestionController@index'));
    Route::get('exam/{exam}/question/create', array('as' => 'exam.question.create', 'uses' => 'QuestionController@create'));
    Route::delete('exam/{exam}/question/{question}/destroy', array('as' => 'exam.question.destroy', 'uses' => 'QuestionController@destroy'));
    Route::put('exam/{exam}/question/{question}/update', array('as' => 'exam.question.update', 'uses' => 'QuestionController@update'));
    Route::get('exam/{exam}/question/{question}/show', array('as' => 'exam.question.show', 'uses' => 'QuestionController@show'));
    Route::get('exam/{exam}/question/{question}/edit', array('as' => 'exam.question.edit', 'uses' => 'QuestionController@edit'));

    //  question "choice" routes
    Route::post('question/{question}/choice', array('as' => 'question.choice.store', 'uses' => 'ChoiceController@store'));
    Route::get('question/{question}/choice', array('as' => 'question.choice.index', 'uses' => 'ChoiceController@index'));
    Route::get('question/{question}/choice/create', array('as' => 'question.choice.create', 'uses' => 'ChoiceController@create'));
    Route::delete('question/{question}/choice/{choice}/destroy', array('as' => 'question.choice.destroy', 'uses' => 'ChoiceController@destroy'));
    Route::put('question/{question}/choice/{choice}/update', array('as' => 'question.choice.update', 'uses' => 'ChoiceController@update'));
    Route::get('question/{question}/choice/{choice}/show', array('as' => 'question.choice.show', 'uses' => 'ChoiceController@show'));
    Route::get('question/{question}/choice/{choice}/edit', array('as' => 'question.choice.edit', 'uses' => 'ChoiceController@edit'));
});
