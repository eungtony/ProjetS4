<?php

namespace App\Http\Controllers;

use App\Chapitre;
use App\Cours;
use App\Exercices;
use App\Quizz_users;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class chapitreController extends Controller
{
    protected $auth;

    public function __construct(Guard $auth)
    {
        $this->middleware('Inscrit', ['except' => ['store']]);
        $this->middleware('auth');
        $this->auth = $auth;
    }

    public function show($slugdomaine, $slugcours, $slugchapitre)
    {
        $cours = Cours::where('cours_slug', $slugcours)->get()[0];
        $cours->load('domaine', 'chapitres');
        $get_id = DB::table('cours')->where('cours_slug', $slugcours)->get()['0'];
        $id_cours = $get_id->id;
        $user_id = $this->auth->user()->id;
        $chapitre = Chapitre::where('chapitre_slug', $slugchapitre)->get();
        $first = Chapitre::where('cours_id', $cours->id)->get()->first();
        $titre_chapitre = $chapitre[0]->chapitre_titre;
        $chapitre->load('souschapitres');
        $next_num_chapitre = $chapitre['0']->numero + 1;
        $prev_num_chapitre = $chapitre['0']->numero - 1;
        $chap = Chapitre::where('numero', $prev_num_chapitre)->where('cours_id', $id_cours)->get();
        $next = Chapitre::where('cours_id', $id_cours)->where('numero', $next_num_chapitre)->get();
        $prev = Chapitre::where('cours_id', $id_cours)->where('numero', $prev_num_chapitre)->get();
        if($prev->isEmpty()){
            $prev_id_quizz = null;
            $prev_quiz = [];
        }else{
            $prev_id_quizz = $prev[0]->quizz_id;
            $prev_quizz = Quizz_users::where('user_id', $user_id)->where('quizz_id', $prev_id_quizz)->get()->toArray();
        }
        $quizz = DB::table('quizz')->where('chapitre_id', $chapitre[0]->id)->get();
        $quizz_id = $quizz[0]->id;
        $quizz_user = Quizz_users::where('user_id', $this->auth->user()->id)->where('quizz_id', $quizz_id)->get();
        $exercices = Exercices::where('chapitre_id', $chapitre[0]->id)->get();
        return view('cours.chapitre.index',
            compact('chapitre','exercices', 'cours', 'next', 'prev', 'titre_chapitre', 'slugchapitre', 'quizz_user', 'first', 'prev_quizz', 'quizz_id'));

    }

    public function store(Request $request)
    {
        DB::table('chapitre_users')->insert($request->request->all());
        return redirect(action('HomeController@index'))->with('success', 'Vous avez enregistré un nouveau chapitre !');
    }
}
