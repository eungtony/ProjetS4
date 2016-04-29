@extends('layouts.app')

@section('title') Accueil @endsection

@section('content')

    <h1>Tableau de bord</h1>

    <!-- Partie Cours -->
    <div class="wi80 wow fadeInUp">
        <h1><i class="fa fa-check-square"></i>Mes derniers cours publiés</h1>

        <hr>

        <div class="group grid-4" style="margin:auto; padding-top:5px;">
            @if($online->isEmpty())
                <p class="alert alert-warning wi80">
                    Vous n'avez pas encore publié de cours !
                </p>
            @else
                @foreach($online as $c)
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
            @endif
        </div>
        <div class="text-right">
            <a href="{{route('cours.online')}}">Voir tous mes cours en ligne</a>
        </div>

    </div>
    <div class="wi80 wow fadeInUp">
        <h1><i class="fa fa-exclamation-triangle"></i>Mes derniers cours non publiés</h1>

        <hr>

        <div class="group grid-4" style="margin:auto; padding-top:5px;">
            @if($offline->isEmpty())
                <span class="alert alert-warning wi80">
                    Tous vos cours sont en ligne !
                </span>
            @else
                @foreach($offline as $l)
                    <div class="cours">
                        <a href="{{route('admin.edit', $l->id)}}">
                            <img src="/~tony/img/cours/{{$l->id}}_miniature.jpg" class="miniature"
                                 style="box-shadow: 0 0 6px black;">
                        </a>
                        <img src="/~tony/images/titrecours.png" class="imgcours">
                        <p class="titredomaine"><a href="{{route('voir.cours.domaine', $l->domaine->slug)}}"
                                                   style="color:white;">{{$l->domaine->nom}}</a></p>
                        <p class="titrecours">
                            <a href="{{route('voir.cours', [$l->domaine->slug, $l->cours_slug])}}">{!! $l->titre !!}</a>
                        </p>
                    </div>
                @endforeach
            @endif

        </div>
        <div class="text-right">
            <a href="{{route('cours.offline')}}">Voir tous mes cours non publiés</a>
        </div>

    </div>

    @if($quizz->isEmpty())

        <div class="wi80 wow fadeInUp">

            <p class="alert alert-warning">Aucun élève n'a répondu à vos quizz !</p>

        </div>

    @else

        <div class="wi80 wow fadeInUp">

            <h1>Note des QUIZ de mes cours</h1>
            <hr>
            <h4>
                Le pourcentage de réussite à vos quizz est de: {{round($pourcentage)}} %
            </h4>
            <hr>
            <table class="table table-striped">
                <tread>
                    <tr>
                        <th>Titre du chapitre</th>
                        <th>Titre du cours</th>
                        <th>Nom de l'étudiant</th>
                        <th>Résultat du Quiz</th>
                    </tr>
                </tread>
                <tbody>

                @foreach($quizz as $q)

                    <tr>
                        <td>{{$q->chapitre_titre}}</td>
                        <td>{{$q->titre}}</td>
                        <td>{{$q->nom}}</td>
                        <td>{{$q->note_user}}/{{$q->note_max}}</td>
                    </tr>

                @endforeach
                </tbody>
            </table>
        </div>


    @endif

@endsection
