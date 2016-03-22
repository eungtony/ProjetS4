@extends('layouts.app')

@section('content')

    <div class="wi80">
        {{Form::open(['method'=>'post', 'url'=>route('profil.check.password', $user->id)])}}

        <div class="form-group">
            <label for="">Entrez votre mot de passe actuel</label>
            {{Form::password('actual_password', null,['class'=>'form-control'])}}
        </div>

        <div class="form-group">
            <label for="">Entrez votre nouveau mot de passe</label>
            {{Form::password('new_password', null,['class'=>'form-control'])}}
        </div>

        <div class="form-group">
            <label for="">Retapez votre mot de passe</label>
            {{Form::password('password_confirm', null,['class'=>'form-control'])}}
        </div>

        <button class="btn btn-primary" type="submit">Modifier mon mot de passe</button>

        {{Form::close()}}
    </div>

@endsection