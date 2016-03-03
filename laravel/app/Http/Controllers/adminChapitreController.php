<?php

namespace App\Http\Controllers;

use App\Exercices;
use App\Quizz;
use App\Souschapitre;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Chapitre;
use App\Cours;
use App\Domaine;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class adminChapitreController extends Controller
{

    private $auth;

    /**
     * adminChapitreController constructor.
     * @param Guard $auth
     */

    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
        $this->middleware('Admin', ['except' =>['edit', 'store', 'update', 'destroy']]);
        $this->middleware('owner', ['except'=>['store', 'create']]);
    }

    /**
     * @param $id
     * @return mixed
     */

    public function getResource($id){
        return Chapitre::findOrFail($id);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */

    public function create($id){
        $chapitre = new Chapitre;
        $user = $this->auth->user();
        $cours = DB::table('cours')->where('id', $id)->get()[0];
        return view('admin.chapitre.create', compact('chapitre','user','cours'));
    }

    /**
     * @param $chapitres
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */

    public function edit($chapitres){
        $cours = Chapitre::findOrFail($chapitres->id);
        $chapitre = Chapitre::findOrFail($chapitres->id);
        $user = $this->auth->user();
        $chap_id = $chapitres->id;
        $quizz_id = $chapitres->quizz_id;
        $quizz_questions = DB::table('quizz_questions')
            ->orderBy('ordre')
            ->where('chapitre_id', $chapitres->id)
            ->get();
        $exercices = Exercices::where('chapitre_id', $chapitres->id)->get();
        $quizz = new Quizz();
        return view('admin.chapitre.edit', compact('user','chap_id','quizz_id','chapitre', 'cours', 'quizz', 'quizz_questions', 'exercices'));
    }

    /**
     * @param $chapitre
     * @param Requests\chapitreRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */

    public function update($chapitre, Requests\chapitreRequest $request){
        $user = $this->auth->user();
        $chapitre->update($request->only('chapitre_titre', 'contenu', 'numero', 'chapitre_slug', 'url_video'));
        return redirect(route('admin.chapitre.edit', compact('user', 'chapitre')))->with('success', 'Le chapitre a bien été modifié !');
    }

    /**
     * @param Requests\chapitreRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */

    public function store(Requests\chapitreRequest $request){
        //dd($request->cours_id);
        Chapitre::create($request->only('chapitre_titre', 'contenu', 'chapitre_slug', 'cours_id', 'numero', 'user_id', 'url_video', '_token'));
        $titre = $request->request->all()['titre'];
        $chap_id = Chapitre::where('titre', $titre)->get()[0]->id;
        DB::table('quizz')->insert(['chapitre_id'=>$chap_id, 'user_id' =>$this->auth->user()->id]);
        $quizz_id = DB::table('quizz')->where('chapitre_id', $chap_id)->where('user_id', $this->auth->user()->id)->get()[0]->id;
        Chapitre::where('id', $chap_id)->update(['quizz_id' => $quizz_id]);
        return back()->with('success', 'Le chapitre a bien été crée !');
    }

    /**
     * @param $chapitre
     * @return \Illuminate\Http\RedirectResponse
     */

    public function destroy($chapitre){
        Chapitre::where('id', $chapitre->id)->delete();
        Souschapitre::where('chapitre_id', $chapitre->id)->delete();
        DB::table('quizz')->where('chapitre_id', $chapitre->id)->delete();
        DB::table('quizz_questions')->where('quizz_id', $chapitre->quizz_id)->delete();
        DB::table('quizz_reponses')->where('quizz_id', $chapitre->quizz_id)->delete();
        DB::table('users_reponses')->where('quizz_id', $chapitre->quizz_id)->delete();
        return back()->with('success', 'Le chapitre a bien été supprimé !');
    }
}
