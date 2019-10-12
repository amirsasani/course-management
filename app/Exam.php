<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    protected $guarded = [];
    public function course()
    {
        return $this->belongsTo('App\Course');
    }

    public function students()
    {
        return $this->belongsToMany('App\Student');
    }

    public function questions()
    {
        return $this->hasMany('App\Question');
    }
}
