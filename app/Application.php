<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    protected $table = 'students_courseworks';

    public function student(){
    	return $this->belongsTo('App\Student');
    }

    public function coursework(){
    	return $this->belongsTo('App\Coursework');
    }
}
