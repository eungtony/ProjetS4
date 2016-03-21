@extends('layouts.app')

@section('content')

@section('title') Découvrez tous nos cours !  @endsection

<p class="text-left"><a href="{{route('home')}}">Accueil</a> > Nos cours</p>

<div class="wi80">

    @foreach($cours->chunk(4) as $chunk)

        <div class="group grid-4" style="margin:auto;">
            @foreach($chunk as $c)
                <div class="cours">
                    <a href="{{route('voir.cours', [$c->domaine->slug, $c->cours_slug])}}">
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

    @endforeach

    {{$cours->links()}}

</div>

@endsection