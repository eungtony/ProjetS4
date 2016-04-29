<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cours_users extends Model
{
    public function chapitres(){
        return $this->hasMany('App\Chapitre');
    }
}
