<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Input;
use App\User;
use App\Chapitre;
use App\Cours;
use App\Difficulte;
use App\Domaine;
use App\Quizz_questions;
use App\Souschapitre;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class adminController extends Controller
{
    protected $auth;

    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
        $this->middleware('auth');
        $this->middleware('Admin', ['except' =>['edit', 'store', 'update', 'destroy']]);
        $this->middleware('owner', ['except'=>['show', 'store', 'create']]);
    }

    public function getResource($id){
       return Cours::findOrFail($id);
    }

    public function show() {
        $user_id = $this->auth->user()->id;
        $cours = Cours::with('domaine')->where('user_id', $user_id)->orderBy('id', 'desc')->paginate(5);
        return view('admin.index', compact('cours'));
    }

    public function create(){
        $user = $this->auth->user();
        $cours = new Cours;
        $domaines = Domaine::lists('nom', 'id');
        $difficulte = Difficulte::lists('nom', 'id');
        return view('admin.cours.create', compact('cours', 'domaines', 'user', 'difficulte'));
    }

    public function edit($cours) {
        $cours_id = $cours->id;
        $domaines = Domaine::lists('nom', 'id');
        $difficulte = Difficulte::lists('nom', 'id');
        $user = $this->auth->user();
        $chapitres = Chapitre::with('souschapitres')->where('cours_id', $cours_id)->get();
        $chapitres->load('souschapitres');
        $quizz = DB::table('quizz')
            ->get();
        return view('admin.cours.edit', compact('cours', 'domaines', 'user', 'chapitres', 'quizz', 'difficulte'));
    }

    public function store(Requests\coursRequest $request) {
        $cours = Cours::create($request->only('titre', 'image', 'objectif', 'domaine_id', 'user_id', 'cours_slug', 'url_video', 'online', 'difficulte_id', 'heures'));
        return redirect(route('admin.dashboard'))->with('success', "Le cours a bien été créee ! Mais il n'est pas encore en ligne, modifiez-le avant de le publier !");

    }

    public function update($cours, Requests\coursRequest $request){
        $user = $this->auth->user();
        $domaines = Domaine::lists('nom', 'id');
        $chapitres = Chapitre::where('cours_id', $cours->id)->get();
        $cours->update($request->only('titre', 'objectif','domaine_id', 'cours_slug', 'url_video', 'online', 'difficulte_id', 'heures', 'image'));
        if(Input::hasFile('pdf') == true && Input::file('pdf')->getClientOriginalExtension() == 'pdf'){
            $file = Input::file('pdf');
            $destination = '/home/tony/public_html/pdf/';
            $name = "{$cours->cours_slug}.pdf";
            Cours::where('id', $cours->id)->update(['pdf' => 1]);
            $file->move($destination, $name);
        }elseif(Input::hasFile('pdf') == true){
            return back()->with('error', "Vous n'avez pas upload de fichier au format PDF !");
        }
        return redirect(action('adminController@edit', compact('cours', 'domaines', 'user', 'chapitres')))->with('success', 'Le cours a bien été modifié !');
    }

    public function destroy($cours){
        $chapitre = Chapitre::where('cours_id', $cours->id)->delete();
        $schapitre = Souschapitre::where('cours_id', $cours->id)->delete();
        DB::table('cours_users')->where('cours_id', $cours->id)->delete();
        $cours->delete();
        return back()->with('success', 'Le cours a bien été supprimé !');
    }

}
