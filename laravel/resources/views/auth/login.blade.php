@extends('layouts.login')

@section('title') Connectez-vous  @endsection

@section('content')

    <form class="form" role="form" method="POST" action="{{ url('/login') }}">
        {!! csrf_field() !!}

        <label class="field">E-mail URCA</label>

        <input type="email" class="wi240px" name="email" value="{{ old('email') }}">

        @if ($errors->has('email'))
            <span class="help-block wi240px field">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
        @endif

        <label class="field">Mot de passe</label>

        <input type="password" class="wi240px" name="password">

        @if ($errors->has('password'))
            <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
        @endif

        <div class="checkbox">
            <label class="field">
                <input type="checkbox" name="remember"> Se souvenir
            </label>
        </div>

        <button type="submit" class="btn btn-primary" style="margin-bottom:20px;">
            <i class="fa fa-btn fa-sign-in"></i>Connectez-vous
        </button>

        <a href="{{url('validermoncompte')}}">Première connexion ?</a><br>
        <a href="{{url('/password/reset')}}">Mot de passe oublié ?</a>

    </form>
@endsection
