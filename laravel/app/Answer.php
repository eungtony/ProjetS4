<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    public $fillable = ['contenu', 'user_id', 'sujet_id'];

    public function user(){
        return $this->belongsTo('App\User');
    }
}
