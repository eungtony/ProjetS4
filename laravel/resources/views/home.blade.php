@extends('layouts.app')

@section('title') Accueil @endsection

@section('content')

    <h1>Tableau de bord</h1>

    <!-- Partie Cours -->
    <div class="wi80">
        <h1><i class="fa fa-fire"></i> Nouveaux Cours</h1>

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
        <div class="text-right">
            <a href="{{route('nos.cours')}}">Voir tous les nouveaux cours</a>
        </div>

    </div>
    <div class="wi80">
        <h1><i class="fa fa-thumbs-up"></i>Ces cours devraient vous intéresser !</h1>

        <hr>

        <div class="group grid-4" style="margin:auto; padding-top:5px;">
            @foreach($liked as $l)
                <div class="cours">
                    <a href="{{route('voir.cours', [$l->domaine->slug, $l->cours_slug])}}">
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
        </div>
        <div class="text-right">
            <a href="{{route('preferences')}}">Voir tous les cours qui devraient m'intéresser</a>
        </div>

    </div>
    <div class="wi80">
        <h1><i class="fa fa-spinner"></i> Liste de mes cours en progression</h1>

        <hr>

        @if($inscrit->isEmpty())
            <p class="alert alert-warning">

                Vous ne vous êtes inscrit à aucun cours !

            </p>
        @else

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
        @endif
        <div class="text-right">
            <a href="{{route('profil.mes.cours')}}">Voir tous les cours auxquels je suis inscris</a>
        </div>

    </div>
    <!-- Fin-->

    <div class="wi80">


        <h1><i class="fa fa-question-circle"></i> QUIZZ effectué</h1>

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
                            <th>Résultat du Quiz</th>
                        </tr>
                    </tread>
                    <tbody>
                    @foreach($quizz as $q)

                        <tr>
                            <td><a href="{{route('voir.chapitre', [$q->slug, $q->cours_slug, $q->chapitre_slug])}}">{{$q->chapitre_titre}}</a></td>
                            <td><a href="{{route('voir.cours', [$q->slug, $q->cours_slug])}}">{{$q->titre}}</a></td>
                            <td><a href="{{route('voir.cours.domaine', $q->slug)}}">{{$q->nom}}</a></td>
                            <td>{{$q->note_user}}/{{$q->note_max}}</td>
                        </tr>

                    @endforeach
                    </tbody>
                </table>

                    <p class="text-right">
                        <a href="{{route('profil.quizz', $user->id)}}">Voir tous mes QUIZ</a>
                    </p>
            </div>

        @endif

    </div>

@endsection
