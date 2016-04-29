@extends('layouts.login')

@section('title') Validez votre compte !  @endsection

@section('content')

    {!! Form::open(['class' => 'form', 'url'=> action('Auth\AuthController@validation')]) !!}

    @include('flash')

    <p>
        Remplissez ces champs pour valider votre compte.
    </p>

    <label class="field">E-Mail URCA</label>

    <input type="email" class="wi240px" name="email" value="{{ old('email') }}">

    @if ($errors->has('email'))
        <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
    @endif

    <label class="field">Votre numéro étudiant</label>

    <input type="text" class="wi240px" name="numero" value="{{ old('numero') }}">

    @if ($errors->has('numero'))
        <span class="help-block">
                                        <strong>{{ $errors->first('numero') }}</strong>
                                    </span>
    @endif

    <button type="submit">
        <i class="fa fa-btn fa-user"></i>Envoyez un mail de confirmation !
    </button>
@endsection
