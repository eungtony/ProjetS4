@extends('layouts.app')

@section('content')

    {!! Form::model($answer, [
    'class' => 'form-horizontal',
    'url' => action("answerController@update", $answer->id),
    'method' => 'post']) !!}

    {!! Form::hidden('user_id', Auth::user()->id, ['class'=>'form-control']) !!}
    {!! Form::hidden('sujet_id', $sujets->id, ['class'=>'form-control']) !!}

    <div class="form-group">
        <label for="">Editer le contenu de ma réponse</label>
        {!! Form::textarea('contenu', null, ['class'=>'form-control']) !!}
    </div>

    <div class="form-group">
        <p class="text-right">
            <button type="submit" class="btn btn-primary">Editer ma réponses</button>
        </p>
    </div>

    @endsection