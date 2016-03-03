@extends('layouts.app')

@section('title') Nos forums @endsection

@section('content')

    <p><a href="{{route('home')}}">Accueil</a> > Nos forums</p>

            <table class="table table-hover table-striped">
                    @foreach($domaines as $d)
                    <tr>
                    <td><h4><a href="{!! route('voir.forum.domaine', $d->slug) !!}">{{$d->nom}}</a></h4></td>
                    </tr>
                    @endforeach
            </table>

    @endsection