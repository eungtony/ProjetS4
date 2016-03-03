<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Quizz_questions extends Model
{
    public function quizz_reponses(){
        return $this->hasMany('App\Quizz_reponses');
    }

    public function quizz_reponse(){
        return $this->hasOne('App\Quizz_reponses');
    }
}
