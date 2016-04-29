@extends('layouts.app')

@section('content')

    <div class="wi80">

        {!! Form::open([
    'class' => 'form-horizontal',
    'url' => action('quizzController@check', [\Illuminate\Support\Facades\Auth::user()->id,$quizz_id]),
    'method' => 'post']) !!}
        {{Form::hidden('nb_questions', $nb_questions)}}
        @foreach($questions as $q)
            <h4 class="text-center">{{$q->question}}</h4>
            {{Form::hidden('cours_id', $cours_id)}}
            @foreach($q->quizz_reponses as $qr)
                <p class="text-center" id="test">
                    {!! Form::radio($q->id, $qr->id) !!}
                    {{$qr->reponse}}
                </p>
            @endforeach
            <hr>
        @endforeach

        <p class="alert alert-warning">
            Êtes-vous sûr de vos réponses ? Vous ne pourrez plus refaire ce QUIZ après l'avoir valider !
        </p>

        <div class="form-group">
            <button type="submit" class="btn btn-primary">Valider le QUIZZ</button>
        </div>

        {!! Form::close() !!}

    </div>

@endsection
