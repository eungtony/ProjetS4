@extends('layouts.app')

@section('title') Editer le chapitre {{$chapitre->chapitre_titre}} @endsection

@section('content')

<div class="wi80" style="padding:40px;">

    <a href="{{route('admin.edit', $chapitre->cours_id)}}">Revenir vers l'édition du cours</a>

    <div>

        <h3>Modifier le chapitre: {!! $chapitre->chapitre_titre !!}</h3>
        <div class="form-group">

            <a href="{{route('admin.schapitre.create', $chapitre->id)}}" class="btn btn-primary">Ajouter un sous
                chapitre</a>
            <a href="{{route('admin.chapitre.destroy', $chapitre->id)}}" class="btn btn-danger" data-method="delete"
               data-confirm="Souhaitez-vous réellement supprimer ce chapitre ?">Supprimer</a>

        </div>


        @include('admin.chapitre.form', ['action' => 'update'])

        <div class="form-group text-right">
            <button class="btn btn-primary" type="submit">Editer ce chapitre</button>
        </div>

        {!! Form::close() !!}

    </div>

    <hr>

    <h3 class="text-center">Editer le QUIZZ</h3>

    <hr>

    <div>

        @include('quizz.form', ['action' => 'addQuestions'])

        <div class="form-group">
            <button type="submit" class="btn btn-primary">Ajouter cette question</button>
        </div>

        {!! Form::close() !!}

        <div class="panel-body">
            <h4>Editer les questions du QUIZZ</h4>
            @foreach($quizz_questions as $q)
                <p>
                    <i class="fa fa-pencil-square-o"></i> -
                    <a href="{{action('adminQuizzController@question', $q->id)}}">{{$q->question}}</a> -
                    <a href="{{action('adminQuizzController@destroy', $q->id)}}" data-method="delete"
                       data-confirm="Voulez-vous réellement supprimer cette question ?"><i class="fa fa-trash"></i></a>
                </p>
            @endforeach
        </div>
    </div>

    <div>

        <div class="panel-body">
            <a href="{{route('creer.exercice', $chapitre->id)}}" class="btn btn-primary">Créer un exercice</a>
            <h4>Liste des exercices de ce chapitre</h4>
            @foreach($exercices as $exercice)

                <i class="fa fa-pencil-square-o"></i> -
                <a href="{{route('admin.exercices.edit', $exercice->id)}}">{{$exercice->exercice_titre}}</a> -


            @endforeach
        </div>

    </div>

</div>

@endsection