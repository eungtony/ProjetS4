@extends('layouts.app')

@section('content')
    <div class="panel">
        <div class="container col-md-6 col-md-offset-3">
            <div class="panel-header">
                <h1>Editer mon profil</h1>
                <hr>
            </div>
            <div class="panel-body">
                <p class="text-right">
                    <a href="{{route('voir.profil', $user->id)}}" class="btn btn-primary">Voir mon profil</a>
                    <a href="{{url('/profil/modifiermonmotdepasse')}}" class="btn btn-primary">Modifier mon mot de passe</a></A>
                </p>
                @if($user->avatar)
                    <p class="text-right">
                        <img src="/~tony/img/avatars/{{$user->avatar}}" alt="{{$user->prenom}}"><br>
                        Mon avatar actuel
                    </p>
                    @endif
                {!! Form::model($user, ['class' => 'form-horizontal', 'files' => true]) !!}

                    <div class="form-group">
                        <label for="">Domaine préféré</label>
                        {!! Form::select('domaine_id', $domaines, $user->domaine_id, ['class' => 'form-control']) !!}
                    </div>

                <div class="form-group">
                    <label for="">Avatar</label>
                    {!! Form::file('avatar',['class'=>'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::submit('Modifier mon profil', ['class' => 'btn btn-primary']) !!}
                </div>

                {!! Form::close() !!}
            </div>
        </div>
    </div>

@endsection('content')