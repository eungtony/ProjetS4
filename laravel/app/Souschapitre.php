<?php

namespace App;

use App\Behaviour\Sluggable;
use Illuminate\Database\Eloquent\Model;

class Souschapitre extends Model
{
    public $fillable = ['titre', 'contenu', 'slug', 'chapitre_id', 'numero', 'cours_id', 'user_id'];

    use Sluggable;

    public function chapitres() {
    return $this->belongsTo('App\Chapitre');
}
}
