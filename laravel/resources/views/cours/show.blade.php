@extends('layouts.app')

@section('content')

    @foreach($cours as $c)

        <p><a href="{{route('home')}}">Accueil</a> >
            <a href="{{route('nos.cours')}}">Nos cours</a> >
            <a href="{{route('voir.cours.domaine', $c->domaine->slug)}}">{{$c->domaine->nom}}</a> >
            {{$c->titre}}</p>

        @if($inscrit->isEmpty())

@section('title') Inscrivez-vous à ce cours ! @endsection

<div class="wi80">

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


            <button type="submit" class="btn btn-link">Inscris à toi à ce cours !</button>
        </div>

    </div>

</div>

@else

@section('title'){{$c->titre}} @endsection

<div class="wi80" style="padding:20px;">

    <h3 class="text-center">{!! $c->titre !!} </h3>

    <hr>

    <span style="color:{{$c->color_difficulty()}}">{{$c->difficulte->nom}}</span> - {{$c->heures}} heures

    <hr>

    <h4 class="text-center">Votre progression dans ce cours</h4>

    <h3>{{count($total_quiz)}}/{{count($chapitres)}}</h3>
    <div class="progress">
        <div class="progress-bar progress-bar-striped" role="progressbar" aria-valuenow="{{count($total_quiz)}}"
             aria-valuemin="0" aria-valuemax="{{count($chapitres)}}" style="width:{{$pc}}%">
        </div>
    </div>

    <hr>

    <img src="/~tony/img/cours/{{$c->image}}" style="width:100%">

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

    <p>{!! $c->objectif !!}</p>

    <div>

</div>

    <div class="panel-header"><h3>Déroulement du cours</h3></div>

    @if($c->user_id == Auth::user()->id)
        <a href="{{route('admin.edit', $c->id)}}" class="text-right btn btn-primary">Editer le cours</a>
    @endif

    <div class="panel-body">
        @foreach($chapitres as $chapitre)
            <h3>
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

@endif

@endforeach

@endsection