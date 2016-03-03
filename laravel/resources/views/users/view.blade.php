@extends('layouts.app')

@section('content')

    @foreach($user as $u)

        <div class="col-md-6 col-md-offset-3 text-center">

            <p class="text-center"><img src="/public/{{$u->avatar}}" alt=""></p>
            <h3>{{$u->nom}} {{$u->prenom}}</h3>
            <p>{{$u->statut->statut}}</p>
            <p>{{$u->role->nom}}</p>
            @if($u->statut->id == 1)
            <p>{{$u->semestre->nom}}</p>
            @endif
                <p>Domaine préféré: {{$u->domaine->nom}}</p>

        </div>


    @endforeach

    @endsection