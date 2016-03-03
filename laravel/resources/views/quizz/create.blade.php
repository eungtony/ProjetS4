@extends('layouts.app')

@section('content')

    @include('quizz.form', ['action' => 'addQuestions'])

    <div class="form-group">
        <button type="submit" class="btn btn-primary">Ajouter cette question</button>
    </div>

    {!! Form::close() !!}

    @endsection