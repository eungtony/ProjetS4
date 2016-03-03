<?php

namespace App\Http\Controllers;

use App\Chapitre;
use App\Souschapitre;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class adminSousChapitreController extends Controller
{
    private $auth;

    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
        $this->middleware('owner', ['except' => ['create', 'store']]);
        $this->middleware('Admin', ['except' =>['edit', 'store', 'update', 'destroy']]);
    }

    public function getResource($id){
        return Souschapitre::findOrFail($id);
    }

    public function create($souschapitre){
        $chapitre = DB::table('chapitres')->where('id', $souschapitre)->get();
        $chapitre_id = $chapitre['0']->id;
        $cours_id = $chapitre['0']->cours_id;
        $titre = $chapitre['0']->chapitre_titre;
        $schapitre = new Souschapitre;
        $user_id = $this->auth->user();
        return view('admin.souschapitre.create', compact('chapitre_id','cours_id','schapitre', 'titre', 'user_id'));

    }

    public function store(Requests\sousChapitreRequest $request){
        Souschapitre::create($request->only('titre', 'contenu', 'slug', 'cours_id', 'numero', 'chapitre_id', 'user_id'));
        return back()->with('success', 'Le Sous-chapitre a bien été crée !');
}

    public function edit($souschapitre){
        $schapitre = $souschapitre;
        $chapitre_id = $souschapitre->chapitre_id;
        $cours_id = $souschapitre->cours_id;
        $titre = $souschapitre->titre;
        $user_id = $this->auth->user();
        return view('admin.souschapitre.edit', compact('schapitre', 'chapitre_id', 'titre', 'cours_id', 'user_id'));
    }

    public function update($souschapitre, Requests\sousChapitreRequest $request){
        $souschapitre->update($request->only('titre','contenu', 'numero'));
        return back()->with('success', 'Le sous-chapitre a bien été modifié !');
    }

    public function destroy($souschapitre){
        $souschapitre->delete();
        return back()->with('success', 'Le sous-chapitre a bien été supprimé !');
    }

}
