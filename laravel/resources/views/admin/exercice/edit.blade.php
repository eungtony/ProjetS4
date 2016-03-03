@extends('layouts.app')

@section('content')

    @include('admin.exercice.form', ['action' => 'update'])

    <div class="form-group text-right">
        <button class="btn btn-primary" type="submit">Editer l'exercice</button>
    </div>

    {!! Form::close() !!}

@endsection