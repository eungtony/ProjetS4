{!! Form::model($sujet, [
'class' => 'form-horizontal',
'url' => action("sujetController@$action", [$domaine->slug, $cours->cours_slug]),
'method' => $action == "store" ? "post" : "put"]) !!}

{!! Form::hidden('user_id', $user->id, ['class'=>'form-control']) !!}
{!! Form::hidden('domaine_id', $domaine->id, ['class'=>'form-control']) !!}
{!! Form::hidden('cours_id', $cours->id, ['class'=>'form-control']) !!}
{!! Form::hidden('slug', $sujet->slug, ['class' => 'form-control']) !!}

<div class="form-group">
    <label for="">Titre du sujet</label>
    {!! Form::text('titre', $action == 'store' ? '' : $sujet->titre, ['class'=>'form-control']) !!}
</div>

@if($action == 'update')
    <div class="form-group">
        <label for="">
           Sujet résolu ?
            {!! Form::checkbox('resolu', 1, $sujet->resolu, ['class'=>'form-control']) !!}
        </label>
    </div>
    @endif

<div class="form-group">
    <label for="">Contenu du cours</label>
    {!! Form::textarea('contenu', $action == 'store' ? '' : $sujet->contenu, ['class'=>'form-control', 'id' => 'summernote']) !!}
</div>