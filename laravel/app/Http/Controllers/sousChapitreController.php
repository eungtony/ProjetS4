<?php

namespace App\Http\Controllers;

use App\Chapitre;
use App\Cours;
use App\Souschapitre;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class sousChapitreController extends Controller
{

    public function __construct(Guard $auth)
    {
        $this->middleware('auth');
        $this->auth = $auth;
    }

    public function show($slugdomaine, $slugcours, $slugchapitre, $slugschapitre){
        $chapitre_id = DB::table('chapitres')->where('slug', $slugchapitre)->get()['0']->id;
        $schapitre = Souschapitre::where('chapitre_id', $chapitre_id)->simplePaginate(1);
        $cours = Cours::all()->where('slug', $slugcours)['0'];
        $cours->load('domaine');
        //$cours_id = DB::table('cours')->where('slug', $slugcours)->get()['0']->id;
        $chapitre = DB::table('chapitres')->where('slug', $slugchapitre)->get()['0'];
        return view('cours.schapitre.index', compact('schapitre', 'cours', 'chapitre'));
    }
}
