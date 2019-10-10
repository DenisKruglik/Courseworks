<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    public function professors(){
    	return $this->belongsToMany('App\Professor', 'professors_subjects');
    }

    public function courseworks(){
    	return $this->belongsToMany('App\Coursework', 'courseworks_subjects', 'subject_id', 'course_work_id');
    }
}
