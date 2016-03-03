{!! Form::model($schapitre, [
'class' => 'form-horizontal',
'url' => action("adminSousChapitreController@$action", $schapitre->id),
'method' => $action == "store" ? "post" : "put"]) !!}

{!! Form::hidden('chapitre_id', $chapitre_id, ['class'=>'form-control']) !!}
{!! Form::hidden('cours_id', $cours_id, ['class'=>'form-control']) !!}
{!! Form::hidden('slug', null, ['class'=>'form-control']) !!}
{!! Form::hidden('user_id', $user_id->id, ['class'=>'form-control']) !!}

    <div class="form-group">
        <label for="">Numéro du sous-chapitre</label>
        {!! Form::number('numero', $schapitre->numero, ['class' => 'form-control']) !!}
    </div>

    <div class="form-group">
        <label for="">Titre du sous-chapitre</label>
        {!! Form::text('titre', null, ['class'=>'form-control']) !!}
    </div>

<div class="form-group">
    <label for="">Contenu du sous-chapitre</label>
    {!! Form::textarea('contenu', null, ['class'=>'form-control']) !!}
</div>