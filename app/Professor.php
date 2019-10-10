<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Professor extends Model
{
    protected $fillable = ['chair_id'];

    public function user(){
    	return $this->belongsTo('App\User');
    }

    public function chair(){
    	return $this->belongsTo('App\Chair');
    }

    public function courseworks(){
    	return $this->hasMany('App\Coursework');
    }

    public function subjects(){
    	return $this->belongsToMany('App\Subject', 'professors_subjects');
    }

    public function applications(){
        return $this->hasManyThrough('App\Application', 'App\Coursework');
    }
}
