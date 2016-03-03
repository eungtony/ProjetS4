<?php

namespace App\Http\Controllers;

use App\Difficulte;
use App\Exercices;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class adminExerciceController extends Controller
{
    protected $auth;

    public function __construct(Guard $auth){
        $this->auth = $auth;
        $this->middleware('auth');
        $this->middleware('Admin', ['except' =>['edit', 'store', 'update', 'destroy']]);
    }

    public function create($chapitreid){
        $exercice = new Exercices();
        $difficulte = Difficulte::lists('nom', 'id');
        return view('admin.exercice.create', compact('exercice', 'chapitreid', 'difficulte'));
    }

    public function edit($idexercice){
        return view('admin.exercice.edit');
    }

    public function store(Requests\createExerciceRequest $request){
        $chapitre_id = $request->request->all()['chapitre_id'];
        DB::table('exercices')->insert($request->except('_token'));
        return redirect(route('admin.chapitre.edit', $chapitre_id))->with('success', "L'exercice a bien été créee !");

    }
    public function update(){

    }
}
