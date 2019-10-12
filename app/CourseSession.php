<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CourseSession extends Model
{
    protected $table = 'course_sessions';
    protected $guarded = [];

    public function course()
    {
        return $this->belongsTo('App\Course');
    }

    public function students()
    {
        return $this->belongsToMany('App\Student', 'student_session', 'session_id', 'student_id')
            ->withPivot('presence')
            ->withTimestamps();
    }
}
