@extends('layouts.app')

@section('content')

@section('title') Gérer mes cours @endsection

<div class="wi80" style="padding:20px;">

    <h3>Gérer mes cours</h3>
    <p class="text-right">
        <a href="{{ action('adminController@create') }}" class="btn btn-primary">Ajouter un cours</a>
    </p>
    <table class="table table-striped">
        <tread>
            <tr>
                <th>Nom du cours</th>
                <th>Domaine du cours</th>
                <th>Voir le cours</th>
                <th>Actions</th>
                <th>Cours en ligne ?</th>
            </tr>
        </tread>
        <tbody>
        @foreach($cours as $c)
            <tr>
                <td>{!! $c->titre !!}</td>
                <td>{!! $c->domaine->nom !!}</td>
                <td><a href="{{ route('voir.cours',[$c->domaine->slug,$c->cours_slug]) }}">Visualiser le cours</a></td>
                <td>
                    <a href="{{ action('adminController@edit', $c) }}" class="btn btn-primary">Editer</a>
                    <a href="{{action('adminController@destroy',$c)}}" class="btn btn-danger" data-method="delete" data-confirm="Souhaitez-vous réellement supprimer ce cours ?">Supprimer</a>
                    <a href="{{route('admin.chapitre.create', $c->id)}}" class="btn btn-primary">Ajouter un chapitre</a>
                </td>
                <td>
                    @if($c->online == 1)
                        <p>En ligne</p>
                        @else
                        <p>Hors ligne</p>
                        @endif
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <div class="row">
        {{$cours->links()}}
    </div>

</div>

@endsection