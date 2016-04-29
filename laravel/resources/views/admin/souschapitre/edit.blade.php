@extends('layouts.app')

@section('content')

@section('title') Editer le sous chapitre: {{$titre}} @endsection

<div class="wi80">
    <a href="{{route('admin.edit', $cours_id)}}">Revenir vers l'édition du cours</a>

    <h3>Modifier le sous-chapitre: {!! $titre !!}</h3>
    <hr>

    @include('admin.souschapitre.form', ['action' => 'update'])

    <div class="form-group text-right">
        <button class="btn btn-primary" type="submit">Modifier ce sous-chapitre</button>
    </div>

    {!! Form::close() !!}
</div>

@endsection