@extends('layouts.app')

@section('title') Mes cours en ligne @endsection

@section('content')

    <div class="wi80">

        <h1>Tous mes cours publiés</h1>

        <div class="group grid-4" style="margin:auto; padding-top:5px;">
            @foreach($cours as $c)
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

        {{$cours->links()}}

    </div>

@endsection