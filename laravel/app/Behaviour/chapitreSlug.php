<?php
/**
 * Created by PhpStorm.
 * User: eungt
 * Date: 15/02/2016
 * Time: 16:55
 */

namespace App\Behaviour;
use Illuminate\Support\Str;


trait chapitreSlug
{
    public function setChapitreSlugAttribute($slug){
        $this->attributes['chapitre_slug'] = Str::slug($this->chapitre_titre);
    }

}