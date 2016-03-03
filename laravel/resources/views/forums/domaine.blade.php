@extends('layouts.app')

@section('title') {{$domaine->nom}} - Forum @endsection

@section('content')

    <div class="col-md-6 col-md-offset-3">

        <p><a href="{{route('home')}}">Accueil</a> > <a href="{{route('voir.forum')}}">Nos forums</a>
            > {{$domaine->nom}} </p>

        <h4>Forum: {{$domaine->nom}}</h4>

        <hr>

        <h4>Nos cours</h4>

        <hr>

        @if(!empty($cours->items()))

            <table class="table table-striped">
                <tbody>
                @foreach($cours as $c)
                    @if($c->online == 1)

                        <tr>
                            <td>
                                <a href="{{route('voir.forum.cours', [$domaine->slug,$c->cours_slug])}}">{{$c->titre}}</a>
                            </td>
                        </tr>

                    @endif
                @endforeach
                </tbody>
            </table>

        @else

            <p class="alert alert-warning">Ce domaine ne possède pas encore de cours.</p>

        @endif


    </div>

@endsection