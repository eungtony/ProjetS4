@extends('layouts.app')

@section('title') Accueil @endsection

@section('content')

    <h1>Tableau de bord</h1>

    <!-- Partie Cours -->
    <div class="wi80">
        <h1><i class="fa fa-fire"></i>Mes derniers cours publiés</h1>

        <hr>

        <div class="group grid-4" style="margin:auto; padding-top:5px;">
            @foreach($online as $c)
                <div class="cours">
                    <a href="{{route('admin.edit', $c->id)}}">
                        <img src="/~tony/img/cours/{{$c->id}}_miniature.jpg" class="miniature"
                             style="box-shadow: 0 0 6px black;">
                    </a>
                    <img src="/~tony/images/titrecours.png" class="imgcours">
                    <p class="titredomaine"><a href="{{route('voir.cours.domaine', $c->domaine->slug)}}"
                                               style="color:white;">{{$c->domaine->nom}}</a></p>
                    <p class="titrecours">
                        <a href="{{route('voir.cours', [$c->domaine->slug, $c->cours_slug])}}">{!! $c->titre !!}</a>
                    </p>
                </div>
            @endforeach
        </div>
        <div class="text-right">
            <a href="{{route('cours.online')}}">Voir tous mes cours en ligne</a>
        </div>

    </div>
    <div class="wi80">
        <h1><i class="fa fa-thumbs-up"></i>Mes derniers cours non publiés</h1>

        <hr>

        <div class="group grid-4" style="margin:auto; padding-top:5px;">
            @foreach($offline as $l)
                <div class="cours">
                    <a href="{{route('admin.edit', $l->id)}}">
                        <img src="/~tony/img/cours/{{$l->id}}_miniature.jpg" class="miniature"
                             style="box-shadow: 0 0 6px black;">
                    </a>
                    <img src="/~tony/images/titrecours.png" class="imgcours">
                    <p class="titredomaine"><a href="{{route('voir.cours.domaine', $l->domaine->slug)}}"
                                               style="color:white;">{{$l->domaine->nom}}</a></p>
                    <p class="titrecours">
                        <a href="{{route('voir.cours', [$l->domaine->slug, $l->cours_slug])}}">{!! $l->titre !!}</a>
                    </p>
                </div>
            @endforeach
        </div>
        <div class="text-right">
            <a href="{{route('cours.offline')}}">Voir tous mes cours non publiés</a>
        </div>

    </div>

@endsection
