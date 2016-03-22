<?php

namespace App\Http\Controllers;

use App\chapitre_users;
use App\Cours;
use App\Cours_users;
use App\Http\Requests;
use App\Quizz_users;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

class HomeController extends Controller
{
    protected $auth;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Guard $auth)
    {
        $this->middleware('auth');
        $this->auth = $auth;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = $this->auth->user();
        if($user->statut_id == 2){
            $online = Cours::online()
                ->orderBy('id', 'desc')
                ->where('user_id', $user->id)
                ->take(4)
                ->get();
            $online->load('domaine', 'chapitres');
            $offline = Cours::with('domaine', 'chapitres')
                ->where('online', NULL)
                ->where('user_id', $user->id)
                ->orderBy('id', 'desc')
                ->take(4)
                ->get();

            $quizz = Quizz_users::where('cours.user_id', $user->id)
                ->join('quizz', 'quizz.id', '=', 'quizz_users.quizz_id')
                ->join('chapitres', 'chapitres.id', '=', 'quizz.chapitre_id')
                ->join('cours', 'cours.id', '=','chapitres.cours_id')
                ->join('users', 'users.id', '=', 'quizz_users.user_id')
                ->orderBy('quizz_users.id', 'desc')
                ->take(5)
                ->get();

            return view('admin', compact('user', 'online', 'offline', 'quizz'));

        }elseif($user->statut_id == 1){
            $cours = Cours::online()->orderBy('id', 'desc')->take(4)->get();
            $cours->load('domaine', 'chapitres');
            $liked = Cours::with('domaine')
                ->online()
                ->where('domaine_id', $this->auth->user()->domaine_id)
                ->take(4)
                ->get();
            $liked->load('domaine');

            $inscrit = Cours_users::join('cours', 'cours_users.cours_id' , '=', 'cours.id')
                ->join('domaines', 'domaines.id','=','cours.domaine_id')
                ->where('cours_users.user_id', $user->id)
                ->where('online',1)
                ->orderBy('cours_users.id', 'desc')
                ->take(4)
                ->get();
            $user_inscrit = Cours_Users::where('user_id', $user->id)->get();

            $quizz = Quizz_users::where('quizz_users.user_id', $user->id)
                ->join('quizz', 'quizz.id', '=', 'quizz_users.quizz_id')
                ->join('chapitres', 'chapitres.id', '=', 'quizz.chapitre_id')
                ->join('cours', 'cours.id', '=','chapitres.cours_id')
                ->join('domaines', 'domaines.id', '=','cours.domaine_id')
                ->orderBy('quizz_users.id', 'desc')
                ->take(5)
                ->get();
            $nb_quizz = Quizz_users::where('user_id', $user->id)->get();

            return view('home', compact('user', 'cours', 'liked', 'recents', 'inscrit', 'nb_quizz', 'quizz', 'user_inscrit'));
        }
    }

    public function admin(){
        $user_id = $this->auth->user()->id;
        $cours = Cours::where('user_id', $user_id)->orderBy('id', 'desc')->get();
        $cours->load('domaine');
        return view('admin.index', compact('cours'));
    }

    public function recherche(){
        $rs = Input::get('research');
        $recherche = explode(' ', $rs);
        $data = Cours::with('domaine');
        foreach($recherche as $r){
            $data->where('titre', 'LIKE', '%'.$r.'%');
        }
        $resultat = $data->paginate(10);
        return view('recherche', compact('resultat', 'rs'));

    }
}
