@extends('layouts.app')

@section('content')

    {!! Form::open([
    'class' => 'form-horizontal',
    'url' => action('quizzController@check', [\Illuminate\Support\Facades\Auth::user()->id,$quizz_id]),
    'method' => 'post']) !!}
    @foreach($questions as $q)
        <h4 class="text-center">{{$q->question}}</h4>
        @foreach($q->quizz_reponses as $qr)
            <p class="text-center" id="test">
                {!! Form::radio($q->id, $qr->id) !!}
                {{$qr->reponse}}
            </p>
        @endforeach
        <hr>
    @endforeach

    <div class="form-group">
        <button type="submit" class="btn btn-primary">Valider le QUIZZ</button>
    </div>

    {!! Form::close() !!}

@endsection
