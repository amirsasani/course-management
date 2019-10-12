<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['middleware' => ['api'], 'prefix' => 'auth' ], function () {
    Route::post('login', 'ApiControllers\AuthController@login')->name('api.login');
    Route::post('logout', 'ApiControllers\AuthController@logout');
    Route::post('refresh', 'ApiControllers\AuthController@refresh');
    Route::post('me', 'ApiControllers\AuthController@me');
});


Route::group(['middleware' => ['auth:api']], function () {
    Route::get('/', 'ApiControllers\CourseController@index');
    Route::get('/home', 'ApiControllers\CourseController@index');

    Route::get('course/{course}/student/add', array('as' => 'course.student.add_list', 'uses' => 'ApiControllers\StudentController@listStudentsToAdd'));
    Route::post('course/{course}/student/add', array('as' => 'course.student.add', 'uses' => 'ApiControllers\StudentController@addStudentToCourse'));
    Route::delete('course/{course}/student/{student}/destroy', array('as' => 'course.student.destroy', 'uses' => 'ApiControllers\StudentController@destroyStudentFromCourse'));
    Route::resource('course', 'ApiControllers\CourseController');


    Route::resource('student', 'ApiControllers\StudentController');

//  Course session routes
    Route::post('course/{course}/session', array('as' => 'course.session.store', 'uses' => 'ApiControllers\CourseSessionController@store'));
    Route::get('course/{course}/session', array('as' => 'course.session.index', 'uses' => 'ApiControllers\CourseSessionController@index'));
    Route::get('course/{course}/session/create', array('as' => 'course.session.create', 'uses' => 'ApiControllers\CourseSessionController@create'));
    Route::delete('course/{course}/session/{session}/destroy', array('as' => 'course.session.destroy', 'uses' => 'ApiControllers\CourseSessionController@destroy'));
    Route::put('course/{course}/session/{session}/update', array('as' => 'course.session.update', 'uses' => 'ApiControllers\CourseSessionController@update'));
    Route::get('course/{course}/session/{session}/show', array('as' => 'course.session.show', 'uses' => 'ApiControllers\CourseSessionController@show'));
    Route::get('course/{course}/session/{session}/edit', array('as' => 'course.session.edit', 'uses' => 'ApiControllers\CourseSessionController@edit'));

    //  Course "exam" routes
    Route::post('course/{course}/exam', array('as' => 'course.exam.store', 'uses' => 'ApiControllers\ExamController@store'));
    Route::get('course/{course}/exam', array('as' => 'course.exam.index', 'uses' => 'ApiControllers\ExamController@index'));
    Route::get('course/{course}/exam/create', array('as' => 'course.exam.create', 'uses' => 'ApiControllers\ExamController@create'));
    Route::delete('course/{course}/exam/{exam}/destroy', array('as' => 'course.exam.destroy', 'uses' => 'ApiControllers\ExamController@destroy'));
    Route::put('course/{course}/exam/{exam}/update', array('as' => 'course.exam.update', 'uses' => 'ApiControllers\ExamController@update'));
    Route::get('course/{course}/exam/{exam}/show', array('as' => 'course.exam.show', 'uses' => 'ApiControllers\ExamController@show'));
    Route::get('course/{course}/exam/{exam}/edit', array('as' => 'course.exam.edit', 'uses' => 'ApiControllers\ExamController@edit'));

    //  exam "question" routes
    Route::post('exam/{exam}/question', array('as' => 'exam.question.store', 'uses' => 'ApiControllers\QuestionController@store'));
    Route::get('exam/{exam}/question', array('as' => 'exam.question.index', 'uses' => 'ApiControllers\QuestionController@index'));
    Route::get('exam/{exam}/question/create', array('as' => 'exam.question.create', 'uses' => 'ApiControllers\QuestionController@create'));
    Route::delete('exam/{exam}/question/{question}/destroy', array('as' => 'exam.question.destroy', 'uses' => 'ApiControllers\QuestionController@destroy'));
    Route::put('exam/{exam}/question/{question}/update', array('as' => 'exam.question.update', 'uses' => 'ApiControllers\QuestionController@update'));
    Route::get('exam/{exam}/question/{question}/show', array('as' => 'exam.question.show', 'uses' => 'ApiControllers\QuestionController@show'));
    Route::get('exam/{exam}/question/{question}/edit', array('as' => 'exam.question.edit', 'uses' => 'ApiControllers\QuestionController@edit'));

    //  question "choice" routes
    Route::post('question/{question}/choice', array('as' => 'question.choice.store', 'uses' => 'ApiControllers\ChoiceController@store'));
    Route::get('question/{question}/choice', array('as' => 'question.choice.index', 'uses' => 'ApiControllers\ChoiceController@index'));
    Route::get('question/{question}/choice/create', array('as' => 'question.choice.create', 'uses' => 'ApiControllers\ChoiceController@create'));
    Route::delete('question/{question}/choice/{choice}/destroy', array('as' => 'question.choice.destroy', 'uses' => 'ApiControllers\ChoiceController@destroy'));
    Route::put('question/{question}/choice/{choice}/update', array('as' => 'question.choice.update', 'uses' => 'ApiControllers\ChoiceController@update'));
    Route::get('question/{question}/choice/{choice}/show', array('as' => 'question.choice.show', 'uses' => 'ApiControllers\ChoiceController@show'));
    Route::get('question/{question}/choice/{choice}/edit', array('as' => 'question.choice.edit', 'uses' => 'ApiControllers\ChoiceController@edit'));
});
