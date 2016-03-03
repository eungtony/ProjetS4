@extends('layouts.app')

@section('content')

    @include('admin.exercice.form', ['action' => 'store'])

    <div class="form-group text-right">
        <button class="btn btn-primary" type="submit">Ajouter cet exercice</button>
    </div>

    {!! Form::close() !!}

@endsection