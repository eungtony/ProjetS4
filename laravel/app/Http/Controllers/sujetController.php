<?php

namespace App\Http\Controllers;

use App\Answer;
use App\Cours;
use App\Domaine;
use App\Sujet;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class sujetController extends Controller
{
    private $auth;

    public function __construct(Guard $auth)
    {
        $this->middleware('auth');
        $this->auth = $auth;

    }

    public function show($slugdomaine, $slugcours, $slugsujet)
    {
        $cours = Cours::where('cours_slug', $slugcours)->get()[0];
        $domaine = Domaine::where('slug', $slugdomaine)->get()[0];
        $sujets = Sujet::with('user')->where('slug', $slugsujet)->get()[0];
        $user = $sujets->user;
        $user->load('statut', 'role');
        $reponses = Answer::with('user')->orderBy('id', 'asc')->where('sujet_id', $sujets->id)->paginate(10);
        return view('forums.sujet.index', compact('sujets', 'user', 'domaine', 'reponses', 'cours'));
    }

    public function create($slugdomaine, $slugcours)
    {
        $domaine = Domaine::where('slug', $slugdomaine)->get()[0];
        $user = $this->auth->user();
        $cours = Cours::where('cours_slug', $slugcours)->get()[0];
        $sujet = new Sujet();
        return view('forums.sujet.create', compact('domaine', 'user', 'sujet', 'cours'));
    }

    public function edit($slugdomaine, $slugcours, $slugsujet)
    {
        $domaine = Domaine::all()[0];
        $sujet = Sujet::where('slug', $slugsujet)->get()[0];
        $user = $this->auth->user();
        $cours = Cours::where('cours_slug', $slugcours)->get()[0];
        return view('forums.sujet.edit', compact('sujet', 'domaine', 'user', 'cours'));
    }

    public function store(Requests\sujetRequest $request)
    {
        $id = $request->domaine_id;
        $domaine_slug = Domaine::where('id', $id)->get()[0]->slug;
        Sujet::create($request->only('titre', 'contenu', 'domaine_id', 'slug', 'user_id', 'cours_id'));
        return redirect(action('forumController@domaine', $domaine_slug))->with('success', 'Votre sujet a bien été crée !');
    }

    public function update(Requests\sujetRequest $request)
    {
        Sujet::where('slug', $request->slug)->update($request->only('titre', 'contenu', 'slug','resolu'));
        $domaine_slug = Domaine::where('id', $request->domaine_id)->get()[0]->slug;
        $cours_slug = Cours::where('id', $request->cours_id)->get()[0]->cours_slug;
        return redirect(route('voir.sujet', [$domaine_slug,$cours_slug, $request->slug]))->with('success', 'Votre post a bien été modifié !');
    }

    public function destroy($id){
        Sujet::where('id', $id)->delete();
        Answer::where('sujet_id', $id)->delete();
        return redirect(view('forums.index'))->with('error','Vous avez supprimé le sujet avec succès !');
    }

}