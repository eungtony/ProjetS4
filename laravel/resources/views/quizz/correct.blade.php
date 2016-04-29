@extends('layouts.app')

@section('content')

    <div class="wi80 group">

        <h3>
            Résultat du QUIZZ sur: {{$titre}}!
        </h3>

        @foreach($user_reponses as $u)

            <h4>{{$u->question}}</h4>
            @if($u->correct == 1)

                <p class="alert alert-success">
                    {{$u->reponse}}<br>
                    Votre réponse est correct !
                </p>

            @else

                <p class="alert alert-danger">
                    {{$u->reponse}}<br>
                    Votre réponse est fausse !
                </p>

            @endif

            <hr>
        @endforeach


        @if($note_user > $notemax/2)

            <h3 class="alert alert-success">
                Tu as obtenu {{$note_user}}/{{$notemax}} !
            </h3>

        @elseif($note_user < $notemax/2)

            <h3 class="alert alert-danger">
                Tu as obtenu {{$note_user}}/{{$notemax}} !
            </h3>

        @endif

    </div>

@endsection