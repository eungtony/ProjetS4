@extends('layouts.app')

@section('content')

    @foreach($cours as $c)


        @if(!empty($inscrit->toArray()))

@section('title'){{$c->titre}} @endsection

<p><a href="{{route('home')}}">Accueil</a> >
    <a href="{{route('nos.cours')}}">Nos cours</a> >
    <a href="{{route('voir.cours.domaine', $c->domaine->slug)}}">{{$c->domaine->nom}}</a> >
    {{$c->titre}}</p>


<div class="wi80" style="padding:20px;">

    <div class="grid-2">
        <div>
            <h3 class="text-center">{!! $c->titre !!} </h3>
            <img src="/~tony/img/cours/{{$c->image}}" style="width:100%">
            @if($c->inscrit == 1)
                <h2>{{$c->inscrit}} étudiant est inscrit à ce cours !</h2>
                @elseif($c->inscrit == 0)
                <h2>Personne n'est inscrit à ce cours !</h2>
            @else
                <h2>{{$c->inscrit}} étudiants sont inscrit à ce cours !</h2>
            @endif
        </div>
        <div>
            <h4 class="text-center">Votre progression dans ce cours</h4>

            <h3>{{count($total_quiz)}}/{{count($chapitres)}}</h3>
            <div class="progress">
                <div class="progress-bar progress-bar-striped" role="progressbar" aria-valuenow="{{count($total_quiz)}}"
                     aria-valuemin="0" aria-valuemax="{{count($chapitres)}}" style="width:{{$pc}}%">
                </div>
            </div>

            <p>
                {{$c->difficulte->nom}} - {{$c->heures}} heures
                @if($c->pdf != false)
                    - <a href="{{$c->pdf}}" download="{{$c->cours_slug}}">
                        <i class="fa fa-download"></i> Télécharger le PDF fourni pour le cours !
                    </a>
                @endif
            </p>

            <h4>Objectif de ce cours</h4>

            <p>
                {!! $c->objectif !!}
            </p>

        </div>
    </div>

    <p class="alert alert-warning text-center">

        Vous avez un peu de mal avec ce cours ? Posez vos questions sur le forum:<br>
        <a href="{{route('voir.forum.cours', [$c->domaine->slug, $c->cours_slug])}}">{{$c->titre}}</a>

    </p>

    @if($c->url_video != null)
        <div class="panel-header">
            <iframe width="100%" height="500px" style="margin:10px;" src="{{$c->url_video}}" frameborder="0"
                    allowfullscreen></iframe>
        </div>
    @else
        <p class="alert alert-warning">
            Ce cours ne dispose pas de vidéo d'introduction.
        </p>
    @endif


    <div>

    </div>

    <div class="panel-header text-center">
        <h3>Déroulement du cours</h3>
        @if($c->user_id == Auth::user()->id)
            <a href="{{route('admin.edit', $c->id)}}" class="text-right btn btn-primary">Editer le cours</a>
        @endif
    </div>

    <hr>

    <div class="list-group" style="width:50%; margin:auto;">
        @foreach($chapitres as $chapitre)
            <div class="list-group-item">
                <div class="list-group-item-heading">
                    <h4>
                        {!! $chapitre->numero !!} -
                        <a href="
                    {!! route('voir.chapitre', [$c->domaine->slug,$c->cours_slug, $chapitre->chapitre_slug]) !!}">{!! $chapitre->chapitre_titre !!}
                        </a>
                    </h4>
                </div>
                <div class="list-group-item-text">
                    @foreach($chapitre->souschapitres as $souschapitre)
                        <p>{!! $souschapitre->numero !!} - {!! $souschapitre->titre !!}</p>
                    @endforeach
                </div>
            </div>
        @endforeach
    </div>
</div>

@elseif($inscrit->isEmpty())

@section('title') Inscrivez-vous à ce cours ! @endsection

<div class="wi80 group">
    <div class="panel panel-warning text-center wow fadeInDown">

        <div class="panel-heading">
            <h3 style="color:white;">Inscris-toi à ce cours: {{$c->titre}} !</h3>
        </div>

        <div class="panel-body">
            <p>Il semble que tu ne sois pas inscrit à ce cours !
                Tu peux t'inscrire à ce cours en cliquant sur le bouton ci-dessous !</p>

            {!! Form::open([
        'url' => action("coursController@inscription"),
        'method' => 'post']) !!}

            {!! Form::hidden('domaine_id', $c->domaine->id, ['class'=>'form-control']) !!}
            {!! Form::hidden('cours_id', $c->id, ['class'=>'form-control']) !!}
            {!! Form::hidden('user_id', Auth::user()->id, ['class'=>'form-control']) !!}


            <button type="submit" class="btn btn-link">Inscris à toi à ce cours !</button>
        </div>

    </div>
</div>

@endif

@endforeach

@endsection