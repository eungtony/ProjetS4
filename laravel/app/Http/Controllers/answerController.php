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

class answerController extends Controller
{
    public function __construct(Guard $auth){
        $this->middleware('auth');
    }

    public function store(Requests\answerRequest $request){
        $sujet_id = $request->request->all()['sujet_id'];
        $sujet = Sujet::where('id', $sujet_id)->get()[0];
        $sujet_slug = $sujet->slug;
        $cours_slug = Cours::where('id', $sujet->cours_id)->get()[0]->slug;
        $domaine_id = $sujet->domaine_id;
        $domaine_slug = Domaine::where('id', $domaine_id)->get()[0]->slug;
        Answer::create($request->only('contenu', 'user_id', 'sujet_id'));
        return redirect(route('voir.sujet', [$domaine_slug, $cours_slug, $sujet_slug]))->with('success', 'votre post a bien été publié !');
    }

    public function edit(){
        return view('forums.reponses.edit');
    }

    public function update(){

    }
}
