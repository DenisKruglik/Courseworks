<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Coursework extends Model
{
    protected $fillable = [
        'title',
        'topic_id',
        'description'
    ];

    public function professor(){
    	return $this->belongsTo('App\Professor');
    }

    public function topic(){
    	return $this->belongsTo('App\Topic');
    }

    public function subjects(){
    	return $this->belongsToMany('App\Subject', 'courseworks_subjects', 'course_work_id');
    }

    public function students(){
    	return $this->belongsToMany('App\Student', 'students_courseworks')->withPivot('is_finished', 'mark', 'is_approved');
    }

    public function applications(){
        return $this->hasMany('App\Application');
    }
}
