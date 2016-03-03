@extends('layouts.app')

@section('title') Accueil @endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">

                Accueil

                <hr>

                <h1 class="text-right">
                    Bonjour {!! $user->prenom !!} !
                </h1>

                <div class="panel panel-default">

                    <div class="panel-heading">Dashboard</div>

                    <div class="panel-body">

                        <h4>Nouveaux cours</h4>

                        <ul class="list-group">

                            @foreach($cours as $c)

                                <li class="list-group-item">
                                    <h4 class="list-group-item-heading">
                                        <a href="{{route('voir.cours', [$c->domaine->slug, $c->cours_slug])}}">{!! $c->titre !!}</a>
                                    </h4>
                                    <p class="list-group-item-text">
                                        {{substr(strip_tags($c->objectif),0, 300)}}...
                                    <p class="text-right">
                                        <a href="{{route('voir.cours.domaine', $c->domaine->slug)}}">{{$c->domaine->nom}}</a>

                                    </p>
                                    </p>
                                </li>

                            @endforeach

                        </ul>

                        <p class="text-right">
                            <a href="{{route('nos.cours')}}">Voir tous nos cours</a>
                        </p>

                        <h4>Ces cours devraient vous intéresser ...</h4>

                        @if($liked->isEmpty())

                            <p class="alert alert-warning">Désolé nous n'avons pas trouvé de cours qui pourrait vous
                                intéresser...</p>

                        @else

                            <ul class="list-group">
                                @foreach($liked as $like)

                                    <li class="list-group-item">
                                        <h4 class="list-group-item-heading">
                                            <a href="{{route('voir.cours', [$like->domaine->slug, $like->cours_slug])}}">{!! $like->titre !!}</a>
                                        </h4>
                                        <p class="list-group-item-text">
                                            {{substr(strip_tags($like->objectif),0, 300)}}...
                                        <p class="text-right">
                                            <a href="{{route('voir.cours.domaine', $like->domaine->slug)}}">{{$like->domaine->nom}}</a>

                                        </p>
                                        </p>
                                    </li>

                                @endforeach
                            </ul>

                        @endif

                        <h4>Derniers cours auxquels vous vous êtes inscrit</h4>

                        @if($inscrit->isEmpty())
                            <p class="alert alert-warning">Vous ne vous êtes inscrit à aucun cours !</p>
                        @else
                            <ul class="list-group">
                                @foreach($inscrit as $i)
                                    @if($i->online == 1)

                                        <li class="list-group-item">
                                            <h4 class="list-group-item-heading">
                                                <a href="{{route('voir.cours', [$i->slug, $i->cours_slug])}}">{{$i->titre}}</a>
                                            </h4>
                                            <p class="list-group-item-text">
                                                {{substr(strip_tags($i->objectif),0, 300)}}...
                                            <p class="text-right">
                                                <a href="{{route('voir.cours.domaine', $i->slug)}}">{{$i->nom}}</a>
                                            </p>
                                            </p>
                                        </li>

                                    @endif
                                @endforeach
                            </ul>

                            <p class="text-right"><a href="{{route('profil.cours', $user->id)}}">Voir tous mes cours</a>
                            </p>

                        @endif


                        <h4>QUIZZ effectué</h4>

                        @if($quizz->isEmpty())

                            <p class="alert alert-warning">

                                Vous n'avez répondu à aucun QUIZ !

                            </p>

                        @else

                            <ul class="list-group">

                                @foreach($quizz as $q)

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
                                    </li>

                                @endforeach
                                <p class="text-right">
                                    <a href="{{route('profil.quizz', $user->id)}}">Voir tous mes QUIZ</a>
                                </p>
                            </ul>

                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
