@extends('layouts.app')

@section('title') Cours qui devraient m'intéressés @endsection

@section('content')

    <div class="wi80">

        <h4>Nous avons trouvé {{count($cours)}} cours qui pourraient vous intéresser.</h4>

        <hr>

        <div class="group grid-4" style="margin:auto; padding-top:5px;">
            @foreach($cours as $c)
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

        {{$cours->links()}}

    </div>

@endsection