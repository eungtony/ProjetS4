@extends('layouts.app')

@section('content')

@section('title') Tous mes Quizz @endsection

<h2>Tous les Quizz auxquels j'ai répondu</h2>

<hr>

<a href="{{back()->getTargetUrl()}}">Revenir vers le dashboard</a>

<hr>

@if($quizz->isEmpty())

    <p class="alert alert-warning">

        Désolé, nous n'avons trouvé aucun Quizz auxquel vous avez répondu !

    </p>

@else


    <ul class="list-group">

        @foreach($quizz->chunk(3) as $chunk)

            <div class="row">

                @foreach($chunk as $q)

                    <li class="list-group-item col-md-4">
                        <h4>
                            <a href="{{route('voir.chapitre', [$q->slug, $q->cours_slug, $q->chapitre_slug])}}">{{$q->chapitre_titre}}</a>
                        </h4>
                        <p>du cours <a
                                    href="{{route('voir.cours', [$q->slug, $q->cours_slug])}}">{{$q->titre}}</a>
                        </p>
                        <h3 class="alert alert-warning">
                            Résultat: {{$q->note_user}}/{{$q->note_max}}
                        </h3>
                        <p>
                            <a href="{{route('profil.quizz.correction', [$user->id, $q->quizz_id])}}">Voir le résultat de ce quizz</a>
                        </p>
                    </li>

                @endforeach


            </div>


        @endforeach
    </ul>

@endif

@endsection