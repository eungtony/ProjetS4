<?php

namespace App\Http\Controllers;

use App\Quizz;
use App\Quizz_questions;
use App\Quizz_reponses;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class adminQuizzController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('Admin', ['except' =>['edit', 'store', 'update', 'destroy']]);
    }

    public function create($id){
        $quizz = new Quizz();
        $list = [];
        $quizz_id = DB::table('quizz')->where('chapitre_id', $id)->get()[0]->id;
        $chap_id = DB::table('quizz')->where('chapitre_id', $id)->get()[0]->chapitre_id;
        return view('quizz.create', compact('quizz', 'id', 'quizz_id', 'chap_id', 'list'));
    }

    public function edit($id){
        $quizz = DB::table('quizz_questions')->where('quizz_id', $id)->get()[0];
        $quizz_id = $quizz->quizz_id;
        $chap_id = $quizz->chapitre_id;
        $question_id = $quizz->id;
        $reponses = DB::table('quizz_reponses')
            ->orderBy('ordre','asc')
            ->where('quizz_questions_id', $question_id)
            ->get();
        $list = DB::table('quizz_reponses')->lists('reponse', 'id');
        $quizz_reponse = new Quizz_reponses();
        return view('quizz.edit', compact('quizz', 'list', 'quizz_id', 'id', 'chap_id', 'reponses', 'quizz_reponse'));
    }

    public function question($id){
        $quizz = DB::table('quizz_questions')->where('id', $id)->get()[0];
        $quizz_id = $quizz->quizz_id;
        $chap_id = $quizz->chapitre_id;
        $question_id = $quizz->id;
        $reponses = DB::table('quizz_reponses')->where('quizz_questions_id', $question_id)->get();
        $list = DB::table('quizz_reponses')->where('quizz_questions_id', $question_id)->lists('reponse', 'id');
        $quizz_reponse = new Quizz_reponses();
        return view('quizz.edit', compact('quizz', 'list', 'quizz_id', 'id', 'chap_id', 'reponses', 'quizz_reponse'));
    }

    public function update($id, Request $request){
        $data = $request->except('question_id');
        $q_id = $request->request->all()['question_id'];
        $quizz = DB::table('quizz_questions')->where('id', $q_id)->update($data);
        return back()->with('success', 'Votre question a bien été modifié !');
    }

    public function addQuestions(Requests\questionRequest $request){
        $id_chap = $request->request->all()['chapitre_id'];
        $create = DB::table('quizz_questions')->insert($request->request->all());
        return redirect(route('admin.chapitre.edit', $id_chap))->with('success', 'Votre question a bien été ajouté !');
    }

    public function destroy($id){
        Quizz_questions::where('id', $id)->delete();
        Quizz_reponses::where('quizz_questions_id', $id)->delete();
        return back()->with('success', 'La question a bien été supprimée !');
    }
}
