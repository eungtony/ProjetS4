<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web']], function () {
    //
});

Route::group(['middleware' => 'web'], function () {
    Route::auth();

    Route::get('/home', 'HomeController@index');
    Route::get('/', [ 'uses' => 'HomeController@index', 'as' => 'home']);
    Route::get('/validermoncompte', ['uses'=>'Auth\AuthController@valider', 'as'=>'valider']);
    Route::post('/validate', ['uses'=>'Auth\AuthController@validation', 'as'=>'validation']);
    Route::get('/confirm/{id}/{confirmation_token}', ['uses' => 'Auth\AuthController@getConfirm']);
    Route::get('/profil', ['uses' => 'UsersController@edit', 'as' => 'profil']);
    Route::post('/profil', ['uses' => 'UsersController@update', 'as' => 'update']);
    Route::get('/profil/preferences', ['uses'=>'UsersController@preferences', 'as' => 'preferences']);
    Route::get('/profil/mescours', ['uses'=>'UsersController@mescours', 'as' => 'profil.mes.cours']);
    Route::get('/profil/modifiermonmotdepasse', ['uses'=>'UsersController@modifiermotdepasse', 'as'=>'profil.password']);
    Route::get('profil/cours/online', ['uses' => 'UsersController@online', 'as'=>'cours.online']);
    Route::get('profil/cours/offline', ['uses' => 'UsersController@offline', 'as'=>'cours.offline']);
    Route::get('/profil/{id}', ['uses' => 'UsersController@view', 'as' => 'voir.profil']);
    Route::get('/profil/{id}/cours', ['uses' => 'UsersController@cours', 'as' => 'profil.cours']);
    Route::get('/profil/{id}/quizz', ['uses'=>'UsersController@quizz', 'as'=>'profil.quizz']);
    Route::get('/profil/{id}/{idquizz}/mesreponses', ['uses'=>'UsersController@correction', 'as'=>'profil.quizz.correction']);
    Route::post('/profil/modifiermonmotdepasse/{id}', ['uses'=>'UsersController@checkpassword', 'as'=>'profil.check.password']);

    Route::post('/recherche', ['uses'=>'HomeController@recherche', 'as'=>'recherche']);
    Route::get('/cours', ['uses' => 'coursController@index', 'as' => 'nos.cours']);
    Route::get('cours/{nomdomaine}', ['uses' => 'coursController@domaine', 'as' => 'voir.cours.domaine']);
    Route::get('cours/{slugdomaine}/{slug}', ['uses' => 'coursController@show', 'as' => 'voir.cours']);
    Route::get('cours/{slugdomaine}/{slugcours}/{slugchapitre}', ['uses' => 'chapitreController@show', 'as' => 'voir.chapitre']);
    Route::post('/add', ['uses' => 'chapitreController@store', 'as' => 'enregistrer']);
    Route::post('inscription/cours', 'coursController@inscription');
    Route::get('cours/{slugdomaine}/{slugcours}/{slugchapitre}/quizz', ['uses' => 'quizzController@show', 'as'=>'voir.quizz']);
    Route::post('quizz/{iduser}/{idquizz}', ['uses'=>'quizzController@check', 'as'=>'check']);
    Route::get('quizz/{idquizz}/correction', ['uses'=>'quizzController@correction', 'as'=>'correction']);
    //Route::get('cours/{slugdomaine}/{slugcours}/{slugchapitre}/{slugschapitre}', ['uses' => 'sousChapitreController@show', 'as' => 'voir.schapitre']);

    Route::resource('admin/modules', 'adminModuleController');
    Route::resource('/admin/quizz', 'adminQuizzController');
    Route::get('admin/quizz/{id}/question', 'adminQuizzController@question');
    Route::resource('/admin/quizz/reponses', 'adminQuizzReponsesController');
    Route::get('admin/quizz/{id}/reponses', 'adminQuizzReponsesController@create');
    Route::post('admin/quizz/{id}/reponses', ['uses'=>'adminQuizzReponsesController@store', 'as' => 'creer.reponse']);

    Route::post('admin/quizz/{id}', 'adminQuizzController@addQuestions');
    Route::get('admin/quizz/{id}/create', 'adminQuizzController@create');

    Route::resource('admin', 'adminController');
    Route::get('mescours', ['uses' => 'adminController@show', 'as' => 'admin.dashboard']);

    Route::resource('admin/schapitre', 'adminSousChapitreController');
    Route::get('admin/schapitre/select/{id}', ['uses' => 'adminSousChapitreController@select', 'as' => 'admin.schapitre.select']);
    Route::get('admin/schapitre/create/{id}', ['uses' => 'adminSousChapitreController@create', 'as' => 'admin.schapitre.create']);


    Route::resource('admin/chapitre', 'adminChapitreController');
    Route::get('admin/chapitre/create/{id}', ['uses' => 'adminChapitreController@create', 'as' => 'admin.chapitre.create']);

    Route::get('forums', ['uses' => 'forumController@index', 'as' => 'voir.forum']);
    Route::get('forums/{slugdomaine}', ['uses' => 'forumController@domaine', 'as' => 'voir.forum.domaine']);
    Route::get('forums/{slugdomaine}/{slugcours}', ['uses'=>'forumController@cours', 'as' => 'voir.forum.cours']);

    Route::get('forums/{slugdomaine}/{slugcours}/{slugsujet}', ['uses' => 'sujetController@show', 'as' => 'voir.sujet']);
    Route::resource('forums/sujet', 'sujetController');
    Route::get('forums/{slugdomaine}/{slugcours}/{slugsujet}/edit', ['uses' => 'sujetController@edit', 'as' => 'edit.sujet']);
    Route::get('forums/{slugdomaine}/{slugcours}/sujet/create', ['uses' => 'sujetController@create', 'as' => 'creer.sujet']);
    Route::post('forums/{slugdomaine}/{slugcours}/sujet/create', ['uses' => 'sujetController@store']);

    Route::resource('forums/sujets/answer', 'answerController');

    Route::resource('admin/exercices', 'adminExerciceController');
    Route::get('admin/{idchapitre}/exercices/create', ['uses'=>'adminExerciceController@create', 'as'=>'creer.exercice']);
});
