<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chair extends Model
{
    public function professors(){
    	return $this->hasMany('App\Professor');
    }
}
