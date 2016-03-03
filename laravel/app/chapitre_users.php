<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class chapitre_users extends Model
{
    public function chapitres(){
        return $this->hasManyThrough('App\Chapitre', 'App\User');
    }

    public function getCoursId(){
        return $this->cours_id;
    }

    public function getDomaineId(){
        return $this->domaine_id;
    }

    public function getChapitreId(){
        return $this->chapitre_id;
    }
}
