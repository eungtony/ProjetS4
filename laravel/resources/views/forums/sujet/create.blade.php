@extends('layouts.app')

@section('title') Créer un nouveau sujet @endsection

@section('content')

@include('forums.sujet.form', ['action' => 'store'])

<div class="form-group text-right">
    <button class="btn btn-primary" type="submit">Créer le sujet</button>
</div>

@endsection