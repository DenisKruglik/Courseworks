<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
	protected $fillable = [
		'recordbook_id',
		'course'
	];

    public function user(){
    	return $this->belongsTo('App\User');
    }

    public function courseworks(){
    	return $this->belongsToMany('App\Coursework', 'students_courseworks')->withPivot('is_finished', 'mark', 'is_approved');
    }

    public function applications(){
        return $this->hasMany('App\Application');
    }
}
