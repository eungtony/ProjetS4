<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Quizz_reponses extends Model
{
    public function quizz_questions(){
        return $this->belongsTo('App\Quizz_questions');
    }

    public function quizz_question(){
        return $this->hasOne('App\Quizz_questions');
    }
}
