@extends('layouts.app')

@section('content')

    <div class="wi80">

        @if(count($resultat)>1)
            <h1>{{count($resultat)}} Cours associés à votre recherche: {{$rs}}</h1>
        @else
            <h1>{{count($resultat)}} Cours associé à votre recherche: {{$rs}}</h1>

        @endif

            <hr>

        <div class="group grid-4" style="margin:auto; padding-top:5px;">
            @foreach($resultat as $r)
                <div class="cours">
                    <a href="{{route('voir.cours', [$r->domaine->slug, $r->cours_slug])}}">
                        <img src="/~tony/img/cours/{{$r->id}}_miniature.jpg" class="miniature"
                             style="box-shadow: 0 0 6px black;">
                    </a>
                    <img src="/~tony/images/titrecours.png" class="imgcours">
                    <p class="titredomaine"><a href="{{route('voir.cours.domaine', $r->domaine->slug)}}"
                                               style="color:white;">{{$r->domaine->nom}}</a></p>
                    <p class="titrecours">
                        <a href="{{route('voir.cours', [$r->domaine->slug, $r->cours_slug])}}">{!! $r->titre !!}</a>
                    </p>
                </div>
            @endforeach
        </div>

        {{$resultat->links()}}

    </div>

@endsection