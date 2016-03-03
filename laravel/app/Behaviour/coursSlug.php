<?php
/**
 * Created by PhpStorm.
 * User: eungt
 * Date: 15/02/2016
 * Time: 16:55
 */

namespace App\Behaviour;
use Illuminate\Support\Str;


trait coursSlug
{
    public function setCoursSlugAttribute($slug){
        $this->attributes['cours_slug'] = Str::slug($this->titre);
    }

}