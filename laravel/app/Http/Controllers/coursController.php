<?php

namespace App\Http\Controllers;

use App\Chapitre;
use App\Cours;
use App\Cours_users;
use App\Domaine;
use App\Quizz;
use App\Quizz_users;
use App\Souschapitre;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class coursController extends Controller
{

    public $auth;

    public function __construct(Guard $auth)
    {
        $this->middleware('auth');
        $this->auth = $auth;
    }

    public function show($slugdomaine, $slug)
    {
        $cours = Cours::all()->where('cours_slug', $slug);
        $cours->load('domaine', 'user', 'difficulte');
        $cours_id = Cours::where('cours_slug', $slug)->get()['0']->id;
        $chapitres = Chapitre::all()->where('cours_id', $cours_id);
        $chapitres->load('souschapitres');
        $inscrit = Cours_users::
        where('user_id', $this->auth->user()->id)
            ->where('cours_id', $cours_id)
            ->get();
            $quiz = Quizz_users::where('quizz_users.user_id', $this->auth->user()->id)
            ->get();
        if($quiz->isEmpty()){
            $quizz = new Quizz_users();
        }else{
            $quizz = Quizz_users::where('quizz_users.user_id', $this->auth->user()->id)
                ->get()[0];
        }
        return view('cours.show', compact('cours', 'chapitres', 'schapitres', 'inscrit', 'quizz'));
    }

    public function domaine($slugdomaine)
    {
        $domaine = Domaine::where('slug', $slugdomaine)->get()['0'];
        $cours = Cours::with('domaine')
            ->where('domaine_id', $domaine->id)
            ->orderBy('id', 'desc')
            ->paginate(10);

        return view('cours.domaine.index', compact('cours', 'domaine'));
    }

    public function index()
    {
        $domaines = Domaine::with('users', 'cours')->get();
        return view('cours.index', compact('domaines'));
    }

    public function inscription(Request $request)
    {
        $cours = $request->request->all();
        $domaine_slug = Domaine::where('id', $cours['domaine_id'])->get()[0]->slug;
        $cours_slug = Cours::where('id', $cours['cours_id'])->get()[0]->cours_slug;
        DB::table('cours')->where('cours_slug', $cours_slug)
            ->increment('inscrit',1);
        Cours_users::insert($request->request->all());
        return redirect(route('voir.cours', [$domaine_slug, $cours_slug]))
            ->with('success', 'Vous êtes désormais inscrit à ce cours !');
    }
}
