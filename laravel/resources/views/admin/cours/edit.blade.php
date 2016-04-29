@extends('layouts.app')

@section('content')

@section('title') Editer le cours {{$cours->titre}} @endsection

<div class="wi80">

    <h2 class="text-right">
        Modifier le cours: {!! $cours->titre !!}<br>
        <a href="{{route('voir.cours', [$cours->domaine->slug, $cours->cours_slug])}}">Voir le cours</a>
    </h2>

    @include('admin.cours.form', ['action' => 'update'])

    <div class="form-group text-right">
        <button class="btn btn-primary" type="submit">Editer ce cours</button>
    </div>

    {!! Form::close() !!}

    <hr>

    <div class="col-md-12 panel">
        <div class="form-group">
            <a href="{{route('admin.chapitre.create', $cours)}}" class="btn btn-primary">Ajouter un chapitre</a>
        </div>
        <div class="panel-header"><h2 class="text-center">Déroulement du cours</h2></div>
        <div class="panel-body text-center">
            @foreach($chapitres as $chapitre)
                <h4>
                    <i class="fa fa-pencil-square-o"></i> -
                    <a href="{{ route('admin.chapitre.edit', $chapitre->id) }}">{!! $chapitre->chapitre_titre !!}</a> -
                    <span>
                        <a href="{{route('admin.schapitre.create',$chapitre->id)}}"><i class="fa fa-plus"></i></a>
                    </span>
                    <a href="{{route('admin.chapitre.destroy', $chapitre->id)}}" data-method="delete"
                       data-confirm="Souhaitez-vous réellement supprimer ce chapitre ?">
                        <i class="fa fa-trash"></i>
                    </a>
                </h4>
                @foreach($chapitre->souschapitres as $souschapitre)
                    <p><i class="fa fa-pencil-square-o"></i>
                        - <a href="{{route('admin.schapitre.edit', $souschapitre->id)}}">{{$souschapitre->titre}}</a>
                    </p>
                @endforeach
                <hr>
            @endforeach
        </div>

    </div>
</div>

@endsection