@extends('layouts.app')

@section('title') @endsection

@section('content')

    <div class="wi80">
        <h1><i class="fa fa-spinner"></i> Liste de mes cours en progression</h1>

        <hr>

        <div class="group grid-4" style="margin:auto; padding-top:5px;">
            @foreach($inscrit as $i)
                <div class="cours">
                    <a href="{{route('voir.cours', [$i->slug, $i->cours_slug])}}">
                        <img src="/~tony/img/cours/{{$i->cours_id}}_miniature.jpg" class="miniature"
                             style="box-shadow: 0 0 6px black;">
                    </a>
                    <img src="/~tony/images/titrecours.png" class="imgcours">
                    <p class="titredomaine"><a href="{{route('voir.cours.domaine', $i->slug)}}"
                                               style="color:white;">{{$i->nom}}</a></p>
                    <p class="titrecours">
                        <a href="{{route('voir.cours', [$i->slug, $i->cours_slug])}}">{{$i->titre}}</a>
                    </p>
                </div>
            @endforeach
        </div>

    </div>

@endsection