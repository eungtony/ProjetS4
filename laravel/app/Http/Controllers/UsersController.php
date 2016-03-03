<?php

namespace App\Http\Controllers;

use App\Cours;
use App\Cours_users;
use App\Domaine;
use App\Quizz_users;
use App\User;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UsersController extends Controller
{

    protected $auth;

    public function __construct(Guard $auth)
    {
        $this->middleware('auth');
        $this->auth = $auth;
    }

    public function edit()
    {

        $user = $this->auth->user();
        $domaines = Domaine::lists('nom', 'id');
        return view('users.edit', compact('user', 'domaines'));

    }

    public function update(Request $request)
    {
        $user = $this->auth->user();
        $this->validate($request, [
            'email' => 'required',
            'avatar' => 'image'
        ]);
        $user->update($request->only('email', 'prenom', 'nom', 'avatar', 'domaine_id'));
        return redirect()->back()->with('success', 'Votre profil a bien été modifié !');
    }

    public function view($id)
    {
        $user = User::where('id', $id)->get();
        $user->load('domaine', 'role', 'statut', 'semestre');
        return view('users.view', compact('user'));
    }

    public function cours()
    {
        $cours = Cours_users::where('cours_users.user_id', $this->auth->user()->id)
            ->join('cours', 'cours.id', '=', 'cours_users.cours_id')
            ->join('domaines', 'domaines.id', '=', 'cours.domaine_id')
            ->paginate(10);
        return view('users.cours', compact('cours'));
    }

    public function quizz($id)
    {
        $quizzid = $id;
        $user = $this->auth->user();
        $quizz = Quizz_users::where('quizz_users.user_id', $user->id)
            ->join('quizz', 'quizz.id', '=', 'quizz_users.quizz_id')
            ->join('chapitres', 'chapitres.id', '=', 'quizz.chapitre_id')
            ->join('cours', 'cours.id', '=', 'chapitres.cours_id')
            ->join('domaines', 'domaines.id', '=', 'cours.domaine_id')
            ->paginate(10);
        return view('users.quizz', compact('quizz', 'user', 'quizzid'));
    }

    public function correction($id, $quizzid)
    {

        $quizz = Quizz_users::where('user_id', $this->auth->user()->id)->where('quizz_id', $quizzid)->get();

        if ($quizz->isEmpty()) {

            $user = $this->auth->user();
            $domaines = Domaine::lists('nom', 'id');
            return redirect(action('UsersController@edit', compact('user','domaines')))->with('error',"Vous n'avez pas accès à cette page !");

        }else{

            $user = $this->auth->user();
            $user_reponses = DB::table('users_reponses')
                ->join('quizz_reponses', 'quizz_reponses.id', '=', 'users_reponses.reponse_id')
                ->join('quizz_questions', 'quizz_questions.id', '=', 'users_reponses.question_id')
                ->join('chapitres', 'chapitres.id', '=', 'quizz_questions.chapitre_id')
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
                ->join('chapitres', 'chapitres.id', '=', 'quizz.chapitre_id')
                ->get()[0]->chapitre_titre;

            return view('users.correct', compact('user_reponses', 'user', 'notemax', 'note_user', 'titre', 'quizzid'));

        }

    }
}
