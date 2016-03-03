<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Domaine extends Model
{
    public function users(){
        return $this->hasMany('App\User');
    }

    public function cours(){
        return $this->hasMany('App\Cours');
    }

    public function sujets(){
        return $this->hasMany('App\Sujet');
    }
}
