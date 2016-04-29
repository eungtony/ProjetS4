@extends('layouts.login')

        <!-- Main Content -->
@section('content')

    <form class="form" role="form" method="POST" action="{{ url('/password/email') }}" style="height:300px;">
        {!! csrf_field() !!}

        <p>
            Pour réinitialiser votre mot de passe, rentrez votre adresse mail URCA.
        </p>

        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif

        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
            <label class="field">Adresse mail</label>

            <input type="email" class="wi240px" name="email" value="{{ old('email') }}">

            @if ($errors->has('email'))
                <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
            @endif
        </div>

        <button type="submit">
            <i class="fa fa-btn fa-envelope"></i>Envoyez le mot de passe sur le mail
        </button>
    </form>
@endsection
