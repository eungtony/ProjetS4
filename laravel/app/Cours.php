<?php

namespace App;

use App\Behaviour\coursSlug;
use App\Behaviour\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Intervention\Image\ImageManagerStatic;

class Cours extends Model
{
    public $fillable = ['titre', 'inscrit', 'objectif', 'domaine_id', 'user_id', 'cours_slug', 'url_video', 'online', 'difficulte_id', 'heures','image'];

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

    public function quizz(){
        return $this->hasMany('App\Quizz_users');
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

    public function getImageAttribute($image){
        if($image){
            return "{$this->id}.jpg";
        }else{
            false;
        }

    }

    public function scopeOnline($query){
        return $query->where('online',1);
    }

    public function getMiniatureAttribute($miniature){
        if($miniature){
            return "{$this->id}_minitature.jpg";
        }else{
            return "default.jpg";
        }
    }

    public function setImageAttribute($image){
        if(is_object($image) && $image->isValid()){
            //dd(File::exists(storage_path(public_path()."\img\avatars\".{$this->id}.jpg)));
            ImageManagerStatic::make($image)->save("/home/tony/public_html/img/cours/{$this->id}.jpg");
            ImageManagerStatic::make($image)->fit(160,160)->save("/home/tony/public_html/img/cours/{$this->id}_miniature.jpg");
            $this->attributes['image'] = true;
        }
    }

}
