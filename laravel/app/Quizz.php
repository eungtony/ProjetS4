<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Quizz extends Model
{
    public function questions(){
        return $this->belongsTo('App\Quizz_questions');
    }
}
