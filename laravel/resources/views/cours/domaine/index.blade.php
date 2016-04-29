@extends('layouts.app')

@section('content')


    <p><a href="{{route('home')}}">Accueil</a> >
        <a href="{{route('nos.cours')}}">Nos cours</a> >
    {{$domaine->nom}}

    <h3 class="text-center">{!! $domaine->nom !!}</h3>

@section('title') Voir tous les cours: {{$domaine->nom}} @endsection

@if($cours->isEmpty())

    <div class="wi80 alert alert-warning text-center">
                Ce module ne dispose pas encore de chapitre !
            </div>

@else

    <div class="wi80" style="padding-top:15px;">

        <div class="group grid-4" style="margin:auto; padding-top:5px;">
            @foreach($cours as $c)

                <div class="cours">
                    <a href="{{route('voir.cours', [$c->domaine->slug, $c->cours_slug])}}"><img src="/~tony/img/cours/{{$c->id}}_miniature.jpg" class="miniature"
                         style="box-shadow: 0 0 6px black;"></a>
                    <img src="/~tony/images/titrecours.png" class="imgcours">
                    <p class="titredomaine"><a href="{{route('voir.cours.domaine', $c->domaine->slug)}}"
                                               style="color:white;">{{$c->domaine->nom}}</a></p>
                    <p class="titrecours">
                        <a href="{{route('voir.cours', [$c->domaine->slug, $c->cours_slug])}}">{{$c->titre}}</a>
                    </p>
                </div>

            @endforeach
        </div>

    </div>

@endif

<div class="row">
    {{$cours->render()}}
</div>


@endsection