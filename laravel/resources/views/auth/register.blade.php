@extends('layouts.app')

@section('title') Inscrivez-vous  @endsection

@section('content')
<div class="container">
    <div class="row">
            <div class="panel panel">
                <div class="panel-heading">Inscrivez-vous</div>
                <div class="panel-body">
                    {!! Form::open(['class' => 'form-horizontal', 'url'=> url('/register')]) !!}

                        <div class="form-group{{ $errors->has('nom') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Nom</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" name="nom" value="{{ old('name') }}">

                                @if ($errors->has('nom'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('nom') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                    <div class="form-group{{ $errors->has('prenom') ? ' has-error' : '' }}">
                        <label class="col-md-4 control-label">Prénom</label>

                        <div class="col-md-6">
                            <input type="text" class="form-control" name="prenom" value="{{ old('prenom') }}">

                            @if ($errors->has('prenom'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('prenom') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">E-Mail</label>

                            <div class="col-md-6">
                                <input type="email" class="form-control" name="email" value="{{ old('email') }}">

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                    <div class="form-group">
                        <label for="" class="col-md-4 control-label">Domaine préféré</label>
                        <div class="col-md-6">
                            {!! Form::select('domaine_id', $domaine, null, ['class' => 'form-control']) !!}
                        </div>

                    </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Mot de passe</label>

                            <div class="col-md-6">
                                <input type="password" class="form-control" name="password">

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Confirmez votre mot de passe</label>

                            <div class="col-md-6">
                                <input type="password" class="form-control" name="password_confirmation">

                                @if ($errors->has('password_confirmation'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-btn fa-user"></i>Inscription
                                </button>
                            </div>
                        </div>
                </div>
            </div>
    </div>
</div>
@endsection
