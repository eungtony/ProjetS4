@extends('layouts.app')

@section('content')

@section('title') Rédiger un sous chapitre du chapitre {{$titre}} @endsection

<a href="{{route('admin.edit', $cours_id)}}">Revenir vers l'édition du cours</a>

<h3>Rédiger un sous-chapitre du {{$titre}}</h3>
<hr>

@include('admin.souschapitre.form', ['action' => 'store'])

<div class="form-group text-right">
    <button class="btn btn-primary" type="submit">Ajouter ce sous-chapitre</button>
</div>

{!! Form::close() !!}

@endsection