@extends('layouts.app')

@section('content')

    <div class="wi80">

        {{Form::open(['method'=>'post', 'url'=>url('/profil/password/modify')])}}

        <div class="form-group">
            <label for="">Tapez votre nouveau mot de passe</label>
            {{Form::password('password', ['class'=>'form-control'])}}
        </div>

        <div class="form-group">
            <label for="">Retapez votre nouveau mot de passe</label>
            {{Form::password('password_verify', ['class'=>'form-control'])}}
        </div>

        <button class="btn btn-primary" type="submit">Modifiez votre mot de passe !</button>

        {{Form::close()}}

    </div>

@endsection