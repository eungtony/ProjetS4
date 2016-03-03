@extends('layouts.app')

@section('title') {{$sujets->titre}} - {{$domaine->nom}}@endsection

@section('content')

    <div class="col-md-8 col-md-offset-2">

        <p><a href="{{route('home')}}">Accueil</a> >
            <a href="{{route('voir.forum')}}">Nos forums</a> >
            <a href="{{route('voir.forum.domaine', $domaine->slug)}}">{{$domaine->nom}}</a> >
            <a href="{{route('voir.forum.cours', [$domaine->slug, $cours->cours_slug])}}">{{$cours->titre}}</a> >
            {{$sujets->titre}}</p>

        <hr>

        @if($sujets->resolu == 1)
            <p class="alert alert-success">
                Le sujet est résolu !
            </p>
            @endif

        <div class="col-md-4">

            <strong>{{$user->prenom}} {{$user->nom}}</strong>
            <p>{{$user->statut->statut}}</p>
            <p>{{$user->role->nom}}</p>

        </div>

        <div class="col-md-8">

                @if($sujets->user_id == Auth::user()->id)
                <p class="text-right"><a href="{{route('edit.sujet', [$domaine->slug, $cours->cours_slug,$sujets->slug])}}" class="btn btn-primary">Editer</a></p>
                @endif

                <h4>{{$sujets->titre}}</h4>
                {{$sujets->contenu}}
                <p class="text-right">{{$sujets->created_at}}</p>


        </div>

        <hr>

        <h4 class="text-center">Réponses à ce sujet</h4>

        <hr>

        <table class="table table-striped">

            <tbody>
                    @foreach($reponses as $r)
                        <tr>
                    <td>
                        <div class="col-md-4">
                            <strong>{{$r->user->prenom}} {{$r->user->nom}}</strong>
                            <p>{{$r->user->statut->statut}}</p>
                            <p>{{$r->user->role->nom}}</p>
                        </div>
                        <div class="col-md-8">
                            @if($r->user_id == Auth::user()->id || Auth::user()->role_id =='3')
                                <p class="text-right"><a href="{{route('forums.sujets.{slugsujet}.answer.edit', [$sujets->slug, $r->id])}}" class="btn btn-primary">Editer</a></p>
                            @endif
                            {{$r->contenu}}
                        </div>
                    </td>
                        </tr>

                    @endforeach

            </tbody>

        </table>

        {{$reponses->render()}}

        <hr>

        {!! Form::open([
'class' => 'form-horizontal',
'url' => action("answerController@store", $sujets->slug),
'method' => 'post']) !!}

        {!! Form::hidden('user_id', Auth::user()->id, ['class'=>'form-control']) !!}
        {!! Form::hidden('sujet_id', $sujets->id, ['class'=>'form-control']) !!}

        <div class="form-group">
            <label for="">Répondez à ce sujet</label>
            {!! Form::textarea('contenu', null, ['class'=>'form-control']) !!}
        </div>

        <div class="form-group">
            <p class="text-right"><button type="submit" class="btn btn-primary">Répondre</button></p>
        </div>

    </div>

    @endsection