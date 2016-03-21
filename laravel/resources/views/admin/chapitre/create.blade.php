@extends('layouts.app')

@section('title') Rédiger un chapitre du cours {{$cours->titre}} @endsection

@section('content')

    <div class="wi80">
        <h3>Rédiger un chapitre du cours: {{ $cours->titre }}</h3>

        @include('admin.chapitre.form', ['action' => 'store'])

        <div class="form-group text-right">
            <button class="btn btn-primary" type="submit">Ajouter ce chapitre</button>
        </div>

        {!! Form::close() !!}
    </div>

@endsection