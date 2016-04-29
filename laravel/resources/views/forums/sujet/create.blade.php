@extends('layouts.app')

@section('title') Créer un nouveau sujet @endsection

@section('content')

    <div class="wi80">
        <div class="group">
            @include('forums.sujet.form', ['action' => 'store'])

            <div class="form-group text-right">
                <button class="btn btn-primary" type="submit">Créer le sujet</button>
            </div>

        </div>
    </div>

@endsection