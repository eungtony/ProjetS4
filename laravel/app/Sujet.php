<?php

namespace App;

use App\Behaviour\Sluggable;
use Illuminate\Database\Eloquent\Model;

class Sujet extends Model
{
    public $fillable = ['titre', 'contenu', 'domaine_id', 'user_id', 'slug', 'cours_id','resolu'];

    public function domaines(){
        return $this->belongsTo('App\Domaine');
    }

    public function user() {
        return $this->belongsTo('App\User');
    }

    use Sluggable;

}
