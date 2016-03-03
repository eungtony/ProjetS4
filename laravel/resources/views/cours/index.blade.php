@extends('layouts.app')

@section('content')

@section('title') Découvrez tous nos cours !  @endsection

<div class="col-md-8 col-md-offset-2 text-center">

    <p class="text-left"><a href="{{route('home')}}">Accueil</a> > Nos cours</p>

        @foreach($domaines as $d)
            <h3><a href="{{route('voir.cours.domaine', $d->slug)}}">{{$d->nom}} ({{count($d->cours)}})</a></h3>
            @foreach($d->cours as $c)
                @if($c->online == 1)
                <a href="{{route('voir.cours', [$d->slug, $c->cours_slug])}}" class="btn btn-primary">{{$c->titre}}</a><br>
                @endif
                @endforeach
            <hr>
        @endforeach

    </div>

    @endsection