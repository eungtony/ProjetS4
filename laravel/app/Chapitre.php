<?php

namespace App;

use App\Behaviour\chapitreSlug;
use App\Behaviour\Sluggable;
use Illuminate\Database\Eloquent\Model;

class Chapitre extends Model
{
    public $fillable = ['chapitre_titre', 'contenu', 'chapitre_slug', 'cours_id', 'numero', 'user_id', 'url_video', '_token'];

    use chapitreSlug;

    public function souschapitres() {
        return $this->hasMany('App\Souschapitre');
    }

    public function cours(){
        return $this->belongsTo('App\Cours');
    }

    public function quizz_users(){
        return $this->hasOne('App\Quizz_users');
    }
}
