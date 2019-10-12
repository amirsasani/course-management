<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{

    protected $guarded = [];

    public function students()
    {
        return $this->belongsToMany('App\Student')->withTimestamps();
    }

    public function exams()
    {
        return $this->hasMany('App\Exam');
    }

    public function sessions()
    {
        return $this->hasMany('App\CourseSession');
    }
}
