@extends('layouts.app')

@section('content')

    <div class="col-md-8 col-md-offset-2">

        <p><a href="{{route('home')}}">Accueil</a> >
            <a href="{{route('nos.cours')}}">Nos cours</a> >
            {{$domaine->nom}}

        <h3 class="text-center">{!! $domaine->nom !!}</h3>

        @section('title') Voir tous les cours: {{$domaine->nom}} @endsection

    @foreach($cours as $c)

            <a href="{{route('voir.cours',[$c->domaine->slug,$c->cours_slug] )}}" class="btn btn-primary">{!! $c->titre !!}</a>

           @endforeach

        <div class="row">
            {{$cours->render()}}
        </div>

    </div>

@endsection