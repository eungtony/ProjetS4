<?php
/**
 * Created by PhpStorm.
 * User: eungt
 * Date: 15/02/2016
 * Time: 16:55
 */

namespace App\Behaviour;
use Illuminate\Support\Str;


trait Sluggable
{
    public function setSlugAttribute($slug){
            $this->attributes['slug'] = Str::slug($this->titre);
    }

}