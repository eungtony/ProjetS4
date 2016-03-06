@extends('layouts.app')

@section('content')

    @if(count($resultat)>1)
        {{count($resultat)}} Cours associés à votre recherche: {{$rs}}
    @else
        {{count($resultat)}} Cours associé à votre recherche: {{$rs}}

    @endif

    <ul class="list-group">
        @foreach($resultat as $r)

            <li class="list-group-item">
                <a href="{{route('voir.cours', [$r->domaine->slug, $r->cours_slug])}}">
                    <h4 class="list-group-item-heading">{{$r->titre}}</h4>
                </a>
                <p class="list-group-item-text">{{substr(strip_tags($r->objectif),0, 300)}}...</p>
            </li>

        @endforeach
    </ul>

@endsection