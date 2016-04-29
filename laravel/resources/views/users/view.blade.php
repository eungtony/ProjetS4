@extends('layouts.app')

@section('title') Mon profil @endsection

@section('content')

    @foreach($user as $u)

        <div class="wi80 text-center">

            <div class="grid-1-3">
                <div>
                    <p class="text-center"><img src="/~tony/img/avatars/{{$u->avatar}}" alt="" style="height:200px;">
                    </p>
                </div>

                <div>
                    <h1>{{$u->nom}} {{$u->prenom}}</h1>
                    <p>{{$u->email}}</p>
                    <p>{{$u->statut->statut}}</p>
                    <p>{{$u->role->nom}}</p>
                    @if($u->statut_id == 2)
                        <h1>{{$u->domaine->nom}}</h1>
                    @endif
                    <p>Pourcentage de réussite aux Quizz: {{round($pourcentage)}}%</p>
                </div>
            </div>

        </div>

        <div class="wi80">

            @if($u->statut_id == 1)

                <h1>Cours auxquels je suis inscris !</h1>
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

                <h4>Dernières notes de mes Quizz</h4>
                @if($quizz->isEmpty())

                    <p class="alert alert-warning">

                        Vous n'avez répondu à aucun QUIZ !

                    </p>

                @else
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
                                <td>
                                    <a href="{{route('voir.chapitre', [$q->slug, $q->cours_slug, $q->chapitre_slug])}}">{{$q->chapitre_titre}}</a>
                                </td>
                                <td><a href="{{route('voir.cours', [$q->slug, $q->cours_slug])}}">{{$q->titre}}</a></td>
                                <td><a href="{{route('voir.cours.domaine', $q->slug)}}">{{$q->nom}}</a></td>
                                <td>{{$q->note_user}}/{{$q->note_max}}</td>
                            </tr>

                        @endforeach
                        </tbody>
                    </table>
                @endif

            @elseif($u->statut_id == 2)

                <h4>Derniers cours rédigés</h4>
                <hr>

                @if($cours->isEmpty())

                    <p class="alert alert-warning">
                        Cet enseignant n'a pas encore rédigé de cours.
                    </p>

                @else

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

                @endif

            @endif

        </div>


    @endforeach

@endsection