@extends('layouts.app')

@section('title') Editer votre sujet @endsection

@section('content')

    @include('forums.sujet.form', ['action' => 'update'])

    <div class="form-group text-right">
        <button class="btn btn-primary" type="submit">Editer le sujet</button>
    </div>

@endsection