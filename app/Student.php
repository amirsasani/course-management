<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $guarded = [];

    public function courses()
    {
        return $this->belongsToMany('App\Course')->withTimestamps();
    }

    public function exams()
    {
        return $this->belongsToMany('App\Exam');
    }

    public function sessions()
    {
        return $this->belongsToMany('App\CourseSession', 'student_session', 'student_id', 'session_id')
            ->withPivot('presence')
            ->withTimestamps();
    }
}
