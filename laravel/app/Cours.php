<?php

namespace App;

use App\Behaviour\coursSlug;
use App\Behaviour\Sluggable;
use Illuminate\Database\Eloquent\Model;

class Cours extends Model
{
    public $fillable = ['titre', 'inscrit', 'objectif', 'domaine_id', 'user_id', 'cours_slug', 'url_video', 'online', 'difficulte_id', 'heures'];

    public function chapitres(){
        return $this->hasMany('App\Chapitre');
    }

    public function domaine(){
        return $this->belongsTo('App\Domaine');
    }

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function difficulte(){
        return $this->belongsTo('App\Difficulte');
    }

    public function getSlug(){
        return $this->slug;
    }

    public function color_difficulty(){
        if($this->difficulte_id == '1'){
            echo "green";
        }elseif($this->difficulty_id == '2'){
            echo "orange";
        }elseif($this->difficulty_id == '3'){
            echo "red";
        }
    }


    use coursSlug;

}
