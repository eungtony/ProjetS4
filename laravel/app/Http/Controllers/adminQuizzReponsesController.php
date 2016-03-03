<?php

namespace App\Http\Controllers;

use App\Quizz_questions;
use App\Quizz_reponses;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class adminQuizzReponsesController extends Controller
{
    public function __construct()
    {
        $this->middleware('Admin');
    }

    public function store($id, Request $request){
        $data = $request->request->all();
        DB::table('quizz_reponses')->insert($data);
        return back()->with('success', 'Votre réponse a bien été ajouté !');
    }

    public function update(Request $request){
        $data = $request->only('reponse', 'ordre','id');
        DB::table('quizz_reponses')->where('id', $request->request->all()['id'])->update($data);
        return back()->with('success', 'Votre réponse a bien été modifié !');
    }
}
