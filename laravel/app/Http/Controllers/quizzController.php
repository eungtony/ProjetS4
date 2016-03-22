<?php

namespace App\Http\Controllers;

use App\Chapitre;
use App\Quizz;
use App\Cours;
use App\Quizz_questions;
use App\Quizz_users;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

class quizzController extends Controller
{
    protected $auth;

    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
        $this->middleware('auth');
        $this->middleware('Inscrit', ['except' => ['check', 'correction']]);
    }

    public function show($slugdomaine, $slugcours, $slugchapitre)
    {
        $id = $this->auth->user()->id;
        $chapitre_id = Chapitre::where('chapitre_slug', $slugchapitre)->get()[0]->id;
        $cours_id = Cours::where('cours_slug', $slugcours)->get()[0]->id;
        $quizz_id = DB::table('quizz')->where('chapitre_id', $chapitre_id)->get()[0]->id;
        $quizz_user = DB::table('quizz_users')->where('user_id', $id)->where('quizz_id', $quizz_id)->get();
        $questions = Quizz_questions::with('quizz_reponses')->where('chapitre_id', $chapitre_id)
            ->get();
        $nb_questions = $questions->count();
        if(empty($quizz_user)){
            return view('quizz.show', compact('chapitre_id', 'questions', 'quizz_id', 'cours_id', 'nb_questions'));
        }else{
            return redirect(action('chapitreController@show', [$slugdomaine, $slugcours,$slugchapitre]))->with('error', 'Vous avez déjà répondu à ce QUIZ !');
        }
    }

    public function check($id, $quizzid, Request $request)

    {

        $nb_questions = $request->all()['nb_questions'];
        $rep = $request->except('_token', 'cours_id','nb_questions');

        if(count($rep) < $nb_questions){
            return back()->with('error',"Vous n'avez pas entièrement rempli le QUIZ !");
        }

        $reponses = Quizz_questions::where('quizz_questions.quizz_id',$quizzid)
            ->join('quizz_reponses', 'quizz_reponses.id', '=','quizz_questions.reponse_id')
            ->get();

        $quizz = Quizz_users::where('user_id', $id)->where('quizz_id', $quizzid)->get();

        if($quizz->isEmpty()){

            $data = $request->except('_token', 'cours_id','nb_questions');
            foreach ($data as $k => $v) {
                DB::table('users_reponses')->insert(['question_id' => $k, 'reponse_id' => $v, 'user_id' => $id, 'quizz_id' => $quizzid]);
            }
            foreach ($data as $k => $v) {
                $correct = DB::table('quizz_questions')->where('id', $k)->get()[0]->reponse_id;
                if ($v == $correct) {
                    DB::table('users_reponses')
                        ->where('question_id', $k)
                        ->where('reponse_id', $v)
                        ->where('user_id', Auth::user()->id)
                        ->update(['correct' => true]);
                }
            }

            $user_reponses = DB::table('users_reponses')
                ->join('quizz_reponses', 'quizz_reponses.id', '=', 'users_reponses.reponse_id')
                ->join('quizz_questions', 'quizz_questions.id', '=', 'users_reponses.question_id')
                ->join('chapitres','chapitres.id', '=','quizz_questions.chapitre_id')
                ->where('users_reponses.quizz_id', $quizzid)
                ->where('users_reponses.user_id', $this->auth->user()->id)
                ->get();

            $note = DB::table('users_reponses')
                ->where('users_reponses.quizz_id', $quizzid)
                ->where('users_reponses.user_id', $this->auth->user()->id)
                ->get();
            $note_u = DB::table('users_reponses')
                ->where('users_reponses.quizz_id', $quizzid)
                ->where('users_reponses.user_id', $this->auth->user()->id)
                ->where('correct', 1)
                ->get();
            $notemax = count($note);
            $note_user = count($note_u);

            $titre = DB::table('quizz')
                ->where('quizz.id', $quizzid)
                ->join('chapitres','chapitres.id','=','quizz.chapitre_id')
                ->get()[0]->chapitre_titre;

            $cours_id = $request->all()['cours_id'];

            DB::table('quizz_users')
                ->insert(['user_id' => $id, 'quizz_id' => $quizzid, 'note_user' => $note_user, 'note_max' => $notemax, 'cours_id' => $cours_id]);

            return view('quizz.correct', compact('user_reponses', 'notemax', 'note_user', 'chapitre', 'titre','data','reponses'));

        }else{
            return back()->with('error', 'Vous avez déjà répondu à ce QUIZ !');
        }

    }

    public function correction($idquizz)
    {
        $q = Quizz_users::where('user_id', $this->auth->user()->id)->where('quizz_id', $idquizz)->get();
        if($q->isEmpty()){
            return back()->with('error', "Vous n'avez pas accès à cette page !");
        }else{
            $quizz = Quizz_questions::where('quizz_questions.quizz_id', $idquizz)
                ->join('quizz_reponses', 'quizz_reponses.id','=','quizz_questions.reponse_id')
                ->get();
            $titre = Chapitre::where('quizz_id', $idquizz)->get()[0]->chapitre_titre;
            return view('quizz.reponses.correction', compact('quizz', 'titre'));
        }
    }
}
