<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Difficulte extends Model
{
    public function cours(){
        return $this->hasMany('App\Cours');
    }
}
