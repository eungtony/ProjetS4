@extends('layouts.app')

@section('content')

    <div class="col-md-6 col-md-offset-3">

        @section('title') {{$titre}} @endsection

        <h3>{{$titre}}</h3>

        <hr>

        @foreach($quizz as $q)

            <h4>{{$q->question}}</h4>
            <p class="alert alert-success">{{$q->reponse}}</p>

        @endforeach

    </div>

@endsection