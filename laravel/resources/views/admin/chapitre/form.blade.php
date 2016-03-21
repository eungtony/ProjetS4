{!! Form::model($chapitre, [
'class' => 'form-horizontal',
'url' => action("adminChapitreController@$action", $chapitre),
'method' => $action == "store" ? "post" : "put"]) !!}

{!! Form::hidden('cours_slug', null, ['class'=>'form-control']) !!}
{!! Form::hidden('cours_id', $cours->id, ['class'=>'form-control']) !!}
{!! Form::hidden('user_id', $user->id, ['class'=>'form-control']) !!}

<div class="group">
    <div class="form-group">
        <label for="">Numéro du chapitre</label>
        {!! Form::number('numero', $chapitre->numero, ['class'=>'form-control']) !!}
    </div>

    <div class="form-group">
        <label for="">Titre du chapitre</label>
        {!! Form::text('chapitre_titre', null, ['class'=>'form-control']) !!}
    </div>

    <div class="form-group">
        <label for="">Contenu du chapitre</label>
        {!! Form::textarea('contenu', null, ['class'=>'form-control', 'id'=>'summernote']) !!}
    </div>

    <div class="form-group">
        <label for="">Url de la vidéo</label>
        {!! Form::text('url_video', null, ['class'=>'form-control']) !!}
    </div>
</div>