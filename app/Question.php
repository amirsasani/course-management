<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $guarded = [];

    public function choices()
    {
        return $this->hasMany('App\Choice');
    }

    public function exam()
    {
        return $this->belongsTo('App\Exam');
    }
}
