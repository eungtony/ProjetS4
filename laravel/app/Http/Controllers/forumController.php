<?php

namespace App\Http\Controllers;

use App\Cours;
use App\Domaine;
use App\Sujet;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class forumController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $domaines = Domaine::all();
        $domaines->load('sujets');
        return view('forums.index', compact('domaines'));
    }

    public function domaine($slugdomaine){
        $domaine = Domaine::where('slug', $slugdomaine)->get()[0];
        $domaine_id = Domaine::where('slug', $slugdomaine)->get()['0']->id;
        $cours = Cours::with('user')->where('domaine_id', $domaine_id)->paginate(10);
        //$sujets = Sujet::with('user')->where('domaine_id', $domaine_id)->paginate(10);
        return view('forums.domaine', compact('cours', 'domaine'));
    }

    public function cours($slugdomaine, $slugcours){
        $cours = Cours::where('cours_slug', $slugcours)->get()[0];
        $id = $cours->id;
        $sujets = Sujet::where('cours_id', $id)->paginate(10);
        $domaine = Domaine::where('slug', $slugdomaine)->get()[0];
        return view('forums.cours', compact('cours', 'sujets', 'domaine'));
    }
}
