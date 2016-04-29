{!! Form::model($exercice, [
'class' => 'form-horizontal',
'url' => action("adminExerciceController@$action", $exercice),
'method' => $action == "store" ? "post" : "put"]) !!}

{!! Form::hidden('chapitre_id', $chapitreid, ['class'=>'form-control']) !!}

<div class="group">
    <div class="form-group">
        <label for="">Titre de l'exerice</label>
        {!! Form::text('exercice_titre', null, ['class'=>'form-control']) !!}
    </div>

    <div class="form-group">
        <label for="">Contenu de l'exercice</label>
        {!! Form::textarea('exercice_contenu', null, ['class'=>'form-control', 'id' => 'summernote']) !!}
    </div>

    <div class="form-group">
        <label for="">Difficulte de l'exercice</label>
        {!! Form::select('difficulte_id', $difficulte, null, ['class' => 'form-control']) !!}
    </div>

    <div class="form-group">
        <label for="">Nombres d'heures requis{{Form::number('heures', $exercice->heures, ['class'=>'form-control'])}}</label>
    </div>

    <div class="form-group">
        <label for="">Adresse de la vidéo</label>
        {!! Form::text('url_video',null, ['class'=>'form-control']) !!}
    </div>

    <div class="form-group">
        <label for="">
            Publier l'exercice en ligne ?
        </label>
        {!! Form::checkbox('online',1,$exercice->online,['class'=>'form-control']) !!}

    </div>
</div>