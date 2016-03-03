@extends('layouts.app')

@section('content')

    <div class="col-md-8 col-md-offset-2 text-center">

        <p class="text-left"><a href="{{route('voir.cours', [$cours->domaine->slug, $cours->slug])}}">Revenir vers le cours</a> - <a href="{{route('voir.chapitre', [$cours->domaine->slug, $cours->slug, $chapitre->slug])}}">Revenir vers le chapitre</a></p>

        @foreach($schapitre as $schap)

            <h3>{!! $schap->titre !!}</h3>
            <p>{!! $schap->contenu !!}</p>

            @endforeach

            <hr>

        <h4>Naviguer entre les sous-chapitres</h4>
        <p>{!! $schapitre->links() !!}</p>

    </div>

    @endsection