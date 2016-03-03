@extends('layouts.app')

@section('content')


    <div class="col-md-8 col-md-offset-2">

        <div class="row">

            <h4>Tous les cours auxquels je suis inscris</h4>

            <ul class="list-group">

                @foreach($cours as $c)
                    <li class="list-group-item">

                        <a href="{{route('voir.cours', [$c->slug, $c->cours_slug])}}">{{$c->titre}}</a>

                    </li>

                @endforeach

            </ul>

        </div>


        <div class="row">
            {{$cours->links()}}
        </div>


    </div>

@endsection