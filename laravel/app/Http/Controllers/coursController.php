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
        $user = $this->auth->user();
        $cours = Cours::where('cours_slug', $slug)->get();
        $cours->load('domaine', 'user', 'difficulte');
        $cours_id = Cours::where('cours_slug', $slug)->get()['0']->id;
        $chapitres = Chapitre::where('cours_id', $cours_id)->get();
        $chapitres->load('souschapitres');
        $inscrit = Cours_users::
        where('user_id', $this->auth->user()->id)
            ->where('cours_id', $cours_id)
            ->get();
        $total_quiz = Quizz_users::where('quizz_users.user_id', $this->auth->user()->id)
            ->where('quizz_users.cours_id', $cours_id)
            ->join('chapitres', 'chapitres.quizz_id', '=', 'quizz_users.quizz_id')
            ->get();

        if ($total_quiz->isEmpty()) {
            $quizz = new Quizz_users();
        } else {
            $quizz = Quizz_users::where('quizz_users.user_id', $this->auth->user()->id)
                ->get()[0];
        }
        $last_quizz = $total_quiz->last();
        if (count($chapitres) == 0) {
            $pc = 1;
        } else {
            $pc = 100 * count($total_quiz) / count($chapitres);
        }

        if ($cours[0]->online == NULL) {
            return back()->with('error', 'Ce cours n\'est plus en ligne !');
        } else {
            return view('cours.show', compact('cours', 'user', 'chapitres', 'schapitres', 'inscrit', 'quizz', 'last_quizz', 'total_quiz', 'pc'));

        }
    }

    public function domaine($slugdomaine)
    {
        $domaine = Domaine::where('slug', $slugdomaine)->get()['0'];
        $cours = Cours::with('domaine')
            ->where('domaine_id', $domaine->id)
            ->where('online', 1)
            ->orderBy('id', 'desc')
            ->paginate(10);
        return view('cours.domaine.index', compact('cours', 'domaine'));
    }

    public function index()
    {
        $cours = Cours::with('domaine')
            ->orderBy('id', 'desc')
            ->where('online', 1)
            ->paginate(12);
        return view('cours.index', compact('cours'));
    }

    public function inscription(Request $request)
    {
        $cours = $request->request->all();
        $domaine_slug = Domaine::where('id', $cours['domaine_id'])->get()[0]->slug;
        $cours_slug = Cours::where('id', $cours['cours_id'])->get()[0]->cours_slug;
        DB::table('cours')->where('cours_slug', $cours_slug)
            ->increment('inscrit', 1);
        Cours_users::insert($request->request->all());
        return redirect(route('voir.cours', [$domaine_slug, $cours_slug]))
            ->with('success', 'Vous êtes désormais inscrit à ce cours !');
    }
}
