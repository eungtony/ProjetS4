@extends('layouts.app')

@section('content')

@section('title') Rédiger un nouveau cours @endsection

<h3>Rédiger un cours</h3>

    @include('admin.cours.form', ['action' => 'store'])

    <div class="form-group text-right">
        <button class="btn btn-primary" type="submit">Ajouter ce cours</button>
    </div>

    {!! Form::close() !!}


@endsection