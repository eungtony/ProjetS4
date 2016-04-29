@extends('layouts.app')

@section('content')

    <div class="wi80">

        {{-- EDITER LA QUESTION --}}

        <div class="col-md-6">

            <a href="{{route('admin.chapitre.edit', $quizz->chapitre_id)}}">Revenir vers l'édition du chapitre</a>

            <h4>Editer la question</h4>

            @include('quizz.form', ['action' => 'update'])

            @if($quizz->reponse_id == 0)

                <p class="alert alert-warning">
                    Attention vous n'avez pas mis à jour la réponse exacte de cette question !
                </p>

            @endif

            <div class="form-group">
                <button type="submit" class="btn btn-primary">Editer cette question</button>
            </div>

            {!! Form::close() !!}
        </div>

        {{-- AJOUTER UNE REPONSE A LA QUESTION --}}

        <div class="col-md-6">
            <h4>Ajouter une réponse à cette question</h4>

            {!! Form::model($quizz_reponse, [
        'class' => 'form-horizontal',
        'url' => route('creer.reponse', $quizz->id),
        'method' => 'post']) !!}

            {{Form::hidden('quizz_questions_id', $quizz->id, ['class'=>'form-control'])}}
            {{Form::hidden('quizz_id', $quizz->quizz_id, ['class'=>'form-control'])}}

            <div class="form-group">
                <label for="">Intitulé de la réponse</label>
                {!! Form::text('reponse', $quizz_reponse->reponse, ['class' => 'form-control']) !!}
            </div>

            <div class="form-group">
                <label for="">Ordre de la réponse
                    {!! Form::number('ordre', $quizz_reponse->ordre, ['class' => 'form-control']) !!}
                </label>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary">Ajouter cette réponse</button>
            </div>

            {!! Form::close() !!}
        </div>

        <hr>
        {{-- LISTES DES REPONSES --}}

        <div class="col-md-12">

            <h4>Liste des réponses</h4>

            @foreach($reponses as $r)

                {!! Form::model($r, ['class'=>'form-horizontal', 'url' => action('adminQuizzReponsesController@update', $r->quizz_questions_id), 'method' => 'put'])!!}

                {!! Form::hidden('id',$r->id ) !!}

                <div class="form-group">
                    {!! Form::text('reponse', $r->reponse, ['class'=>'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::number('ordre', $r->ordre, ['class'=>'form-control']) !!}
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Editer cette réponse</button>
                </div>

                {!! Form::close() !!}

                <span>
                <a href="{{route('admin.quizz.reponses.destroy',$r->id)}}" data-method="delete" data-confirm="Voulez-vous réellement supprimer cette réponse ?"><i class="fa fa-trash"></i></a>
            </span>

            @endforeach

        </div>

    </div>

@endsection