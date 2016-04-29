<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use Intervention\Image\ImageManagerStatic;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nom', 'prenom', 'email', 'password', 'confirmation_token', 'avatar', 'domaine_id', 'statut_id', 'role_id'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function getAvatarAttribute($avatar){
        if($avatar){
            return "{$this->id}.jpg";
        }else{
            return "default.png";
        }
    }

    public function setAvatarAttribute($avatar){
        if(is_object($avatar) && $avatar->isValid()){
            //dd(File::exists(storage_path(public_path()."\img\avatars\".{$this->id}.jpg)));
            ImageManagerStatic::make($avatar)->fit(150,150)->save("/home/tony/public_html/img/avatars/{$this->id}.jpg");
            $this->attributes['avatar'] = true;
        }
    }



    public function statut() {
        return $this->belongsTo('App\Statut');
    }

    public function domaine() {
        return $this->belongsTo('App\Domaine');
    }

    public function role() {
        return $this->belongsTo('App\Role');
    }

    public function cours() {
        return $this->hasMany('App\Cours');
    }

    public function answer(){
        return $this->hasMany('App\Answer');
    }

    public function isAdmin(){
        return $this->statut_id == '2';
    }

}
