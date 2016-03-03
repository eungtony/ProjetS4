<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Quizz_users extends Model
{
    public function chapitre(){
        return $this->hasOne('App\Chapitre');
    }
}
