@extends('layouts.app')

@section('title') {{$cours->titre}} - Forum @endsection

@section('content')

    <div class="col-md-6 col-md-offset-3">

        <p><a href="{{route('home')}}">Accueil</a> >
            <a href="{{route('voir.forum')}}">Nos forums</a> >
            <a href="{{route('voir.forum.domaine', $domaine->slug)}}">{{$domaine->nom}}</a> >
            {{$cours->titre}}</p>

        <p class="text-right"><a href="{{route('creer.sujet', [$domaine->slug, $cours->cours_slug])}}" class="btn btn-primary">Créer un sujet dans ce forum</a></p>

        <h4>Forum: {{$cours->titre}}</h4>

        <hr>

        <p>Ce forum contient {{$sujets->count()}} sujets.</p>

        <table class="table table-striped">

            <tread>
                <tr>
                    <td>Sujet</td>
                    <td>Crée par</td>
                </tr>
            </tread>

            <tbody>

            @foreach($sujets as $sujet)

                <tr>

                    <td><a href="{{route('voir.sujet', [$domaine->slug,$cours->cours_slug,$sujet->slug])}}">{{$sujet->titre}}</a></td>
                    <td>Par <a href="{{route('voir.profil', $sujet->user->id)}}">{{$sujet->user->prenom}}</a></td>

                </tr>
            @endforeach

            </tbody>

        </table>

        {{$sujets->links()}}

    </div>

@endsection