@extends('layouts.app')

@section('content')

    <div class="wi80">
        <div class="group">

            @if($slugchapitre == $first->chapitre_slug OR !empty($prev_quizz))

                <a href="{{route('voir.cours', [$cours->domaine->slug, $cours->cours_slug])}}" class="text-left">
                    <i class="fa fa-long-arrow-left"></i> Revenir vers le cours</a><br>

                <p class="text-left">
                <p><a href="{{route('home')}}">Accueil</a> >
                    <a href="{{route('nos.cours')}}">Nos cours</a> >
                    <a href="{{route('voir.cours.domaine', $cours->domaine->slug)}}">{{$cours->domaine->nom}}</a> >
                    <a href="{{route('voir.cours', [$cours->domaine->slug, $cours->cours_slug])}}">{{$cours->titre}}</a>
                    >
                    {{$titre_chapitre}}</p>
                </p>

                <p class="text-center">

                    @foreach($cours->chapitres as $c)

                        @if($c->chapitre_slug == $slugchapitre)
                            <btn class="btn btn-primary">{{$c->titre}}</btn>
                        @else
                            <a href="{{route('voir.chapitre', [$cours->domaine->slug, $cours->cours_slug, $c->chapitre_slug])}}"
                               class="btn btn-primary" style="opacity:0.3"></a>
                        @endif

                    @endforeach
                </p>


                @foreach($chapitre as $chap)

            @section('title') {{$chap->chapitre_titre}} @endsection

            <h3>{!! $chap->chapitre_titre !!}</h3>

            @if($chap->url_video != null)
                <div class="panel-header">
                    <iframe width="100%" height="500px" style="margin:10px;" src="{{$chap->url_video}}" frameborder="0"
                            allowfullscreen></iframe>
                </div>

            @else
                <p class="alert alert-warning">
                    Ce chapitre ne dispose pas de vidéo.
                </p>
            @endif

            <p>{!! $chap->contenu !!}</p>

            @foreach($chap->souschapitres as $souschapitre)

                <h3>{!! $souschapitre->numero !!} - {!! $souschapitre->titre !!}</h3>
                <p>{!! $souschapitre->contenu !!}</p>
            @endforeach

            @if($quizz_user->isEmpty())

                <p class="text-center">
                    <a href="{{route('voir.quizz', [$cours->domaine->slug, $cours->cours_slug, $chap->chapitre_slug])}}"
                       class="btn btn-warning">QUIZZ DE CE CHAPITRE</a>
                </p>

            @else

                <p class="text-center alert alert-warning">
                    Vous avez déjà effectué le quizz !
                </p>
                <p class="text-center">
                    <a class="btn btn-success" href="{{route('correction', $quizz_id)}}">Correction de ce quizz</a>
                </p>
                <h4 class="text-center">Exercices disponibles pour ce chapitre</h4>
                @foreach($exercices as $exercice)
                    <p class="text-center">
                        <a href="">{{$exercice->exercice_titre}}</a>
                    </p>
                @endforeach

            @endif


            <p class="text-center">
                @foreach($prev as $p)
                    <a href="{{route('voir.chapitre', [$cours->domaine->slug, $cours->cours_slug, $p->chapitre_slug])}}"
                       class="btn btn-primary float-left">
                        <i class="fa fa-long-arrow-left"></i>
                        {!! $p->chapitre_titre !!}</a>
                @endforeach

                @foreach($next as $n)
                    <a href="{{route('voir.chapitre', [$cours->domaine->slug, $cours->cours_slug, $n->chapitre_slug])}}"
                       class="btn btn-primary float-right">
                        {!! $n->chapitre_titre !!}
                        <i class="fa fa-long-arrow-right"></i>
                    </a>
                @endforeach
            </p>

            @endforeach

            @elseif($quizz_user->isEmpty() OR $prev_quizz->isEmpty())

                <p class="text-center alert alert-danger wow fadeInUp">
                    Vous ne pouvez pas accéder à ce chapitre !<br>
                    Validez le quizz du chapitre précédent !<br>
                    @foreach($prev as $p)
                        <a href="{{route('voir.chapitre', [$cours->domaine->slug, $cours->cours_slug, $p->chapitre_slug])}}">
                            {!! $p->chapitre_titre !!}
                        </a>
                    @endforeach
                </p>

            @endif

        </div>
    </div>

@endsection