@extends('layouts.app')

@section('title') Editer votre sujet @endsection

@section('content')

    <div class="wi80">
        <div class="group">
            @include('forums.sujet.form', ['action' => 'update'])

            <div class="form-group text-right">
                <button class="btn btn-primary" type="submit">Editer le sujet</button>
            </div>

        </div>
    </div>

@endsection