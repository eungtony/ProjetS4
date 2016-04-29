<?php

namespace App\Http\Controllers;

use Hash;
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
            'avatar' => 'image'
        ]);
        $user->update($request->only('avatar', 'domaine_id'));
        return redirect()->back()->with('success', 'Votre profil a bien été modifié !');
    }

    public function view($id)
    {
        $user = User::where('id', $id)->get();
        $user->load('domaine', 'role', 'statut');
        $quizz = Quizz_users::where('quizz_users.user_id', $id)
            ->join('quizz', 'quizz.id', '=', 'quizz_users.quizz_id')
            ->join('chapitres', 'chapitres.id', '=', 'quizz.chapitre_id')
            ->join('cours', 'cours.id', '=','chapitres.cours_id')
            ->join('domaines', 'domaines.id', '=','cours.domaine_id')
            ->take(4)
            ->get();
        $inscrit = Cours_users::join('cours', 'cours_users.cours_id' , '=', 'cours.id')
            ->join('domaines', 'domaines.id','=','cours.domaine_id')
            ->where('cours_users.user_id', $id)
            ->orderBy('cours_users.id', 'desc')
            ->take(4)
            ->get();
        $cours = Cours::with('chapitres', 'domaine')
            ->where('user_id', $id)
            ->where('online', 1)
            ->orderBy('id', 'desc')
            ->take(4)
            ->get();
        $pc = DB::table('quizz_users')->where('user_id', $id)->get();
        $collection = collect($pc);
        if($collection->sum('note_max') == 0){
            $pourcentage = 0;
        }else{
            $pourcentage = 100*$collection->sum('note_user')/$collection->sum('note_max');
        }
        return view('users.view', compact('user', 'quizz', 'inscrit', 'cours', 'pourcentage'));
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

    public function preferences(){
            $cours = Cours::with('domaine', 'chapitres')->where('domaine_id', $this->auth->user()->domaine_id)
                ->paginate(10);
            return view('users.preferences', compact('cours'));
    }

    public function mescours(){
            $inscrit = Cours_users::join('cours', 'cours_users.cours_id' , '=', 'cours.id')
                ->join('domaines', 'domaines.id','=','cours.domaine_id')
                ->where('cours_users.user_id', $this->auth->user()->id)
                ->where('online',1)
                ->orderBy('cours_users.id', 'desc')
                ->paginate(10);
            return view('users.mescours', compact('inscrit'));
    }

    public function online(){
        $user = $this->auth->user();
        if($user->statut_id == 2){
            $cours = Cours::where('user_id', $user->id)->online()->paginate(12);
            return view('users.admin.online', compact('cours'));
        }else{
            return back()->with('error', "Vous n'avez pas accès à cette page !");
        }
    }

    public function offline(){
        $user = $this->auth->user();
        if($user->statut_id == 2){
            $cours = Cours::where('user_id', $user->id)->where('online', NULL)->paginate(12);
            return view('users.admin.offline', compact('cours'));
        }else{
            return back()->with('error', "Vous n'avez pas accès à cette page !");
        }
    }

    public function checkpassword(Requests\passwordRequest $request){
        $password = $request->all()['actual_password'];
        $newpassword = $request->all()['new_password'];
        $nw = bcrypt($newpassword);
        $user = User::findOrFail($this->auth->user()->id);
        if(Hash::check($password, $user->password)){
            User::where('id', $user->id)->update(['password' => $nw]);
            return back()->with('success', "Votre mot de passe a été modifié avec succès !");
        }else{
            return back()->with('error', "Vous n'avez pas entré le bon mot de passe !");
        }
    }

    public function modifiermotdepasse(){
        $user = $this->auth->user();
        return view('users.checkpassword', compact('user'));
    }
}
