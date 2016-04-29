@extends('layouts.app')

@section('content')

@section('title') Tous mes Quizz @endsection

<div class="wi80 group">

    <h2>Tous les Quizz auxquels j'ai répondu</h2>

    <hr>

    <a href="{{back()->getTargetUrl()}}">Revenir vers le dashboard</a>

    <hr>

    @if($quizz->isEmpty())

        <p class="alert alert-warning">

            Vous n'avez répondu à aucun QUIZ !

        </p>

    @else

        <div class="group grid_4">

            <table class="table table-striped">
                <tread>
                    <tr>
                        <th>Titre du chapitre</th>
                        <th>Titre du cours</th>
                        <th>Module du cours</th>
                        <th>Voir mes réponses</th>
                        <th>Résultat du Quiz</th>
                    </tr>
                </tread>
                <tbody>

                @foreach($quizz as $q)

                    <tr>
                        <td>
                            <a href="{{route('voir.chapitre', [$q->slug, $q->cours_slug, $q->chapitre_slug])}}">{{$q->chapitre_titre}}</a>
                        </td>
                        <td><a href="{{route('voir.cours', [$q->slug, $q->cours_slug])}}">{{$q->titre}}</a></td>
                        <td><a href="{{route('voir.cours.domaine', $q->slug)}}">{{$q->nom}}</a></td>
                        <td><a href="{{route('profil.quizz.correction', [$user->id, $q->quizz_id])}}">Mes réponses</a></td>
                        <td>{{$q->note_user}}/{{$q->note_max}}</td>
                    </tr>

                @endforeach
                </tbody>
            </table>

        </div>

    @endif

</div>

@endsection