@extends('layouts.app')

@section('content')

    @foreach($cours as $c)

        <p><a href="{{route('home')}}">Accueil</a> >
            <a href="{{route('nos.cours')}}">Nos cours</a> >
            <a href="{{route('voir.cours.domaine', $c->domaine->slug)}}">{{$c->domaine->nom}}</a> >
            {{$c->titre}}</p>

        @if($inscrit->isEmpty())

@section('title') Inscrivez-vous à ce cours ! @endsection

<div class="panel panel-warning text-center">

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


        <button type="submit" class="btn btn-primary">Inscris à toi à ce cours !</button>
    </div>

</div>

@else

@section('title'){{$c->titre}} @endsection

<div class="col-md-8 col-md-offset-2 text-justify">

    <h3 class="text-center">{!! $c->titre !!} </h3>

    <hr>

    <span style="color:{{$c->color_difficulty()}}">{{$c->difficulte->nom}}</span> - {{$c->heures}} heures

    <hr>

    @if($c->url_video != null)
        <div class="panel-header">
            <iframe width="715" height="415" style="margin:10px;" src="{{$c->url_video}}" frameborder="0"
                    allowfullscreen></iframe>
        </div>
    @else
        <p class="alert alert-warning">
            Ce cours ne dispose pas de vidéo d'introduction.
        </p>
    @endif

    <p>{!! $c->objectif !!}</p>

    <a href="{!! route('voir.cours.domaine', $c->domaine->slug)!!}" class="btn btn-primary">{!! $c->domaine->nom !!}</a>

    <p>Rédigé par <a href="{{ route('voir.profil', $c->user->id)}}">{!! $c->user->prenom !!}</a></p>

    <div>

        <div class="panel-header"><h3>Déroulement du cours</h3></div>

        @if($c->user_id == Auth::user()->id)
            <a href="{{route('admin.edit', $c->id)}}" class="text-right btn btn-primary">Editer le cours</a>
        @endif

        <div class="panel-body">
            @foreach($chapitres as $chapitre)
                <h3>
                    @if($quizz->quizz_id == $chapitre->quizz_id)
                        <i class="fa fa-check-circle"></i>
                    @else
                        <i class="fa fa-check-circle-o"></i>
                    @endif
                    {!! $chapitre->numero !!} -
                    <a href="
                                {!! route('voir.chapitre', [$c->domaine->slug,$c->cours_slug, $chapitre->chapitre_slug]) !!}">{!! $chapitre->chapitre_titre !!}
                    </a>
                </h3>
                @foreach($chapitre->souschapitres as $souschapitre)
                    <p>{!! $souschapitre->numero !!} - {!! $souschapitre->titre !!}</p>
                @endforeach
            @endforeach
        </div>
    </div>

</div>

@endif

@endforeach

@endsection