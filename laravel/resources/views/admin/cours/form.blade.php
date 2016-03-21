{!! Form::model($cours, [
'class' => 'form-horizontal',
'url' => action("adminController@$action", $cours),
'method' => $action == "store" ? "post" : "put",
'files'=>true]) !!}

{!! Form::hidden('user_id', $user->id, ['class'=>'form-control']) !!}
{!! Form::hidden('slug', null, ['class'=>'form-control']) !!}


    <div class="group">
        <div class="form-group">
            <label for="">Titre du cours</label>
            {!! Form::text('titre', null, ['class'=>'form-control']) !!}
        </div>

        <div class="form-group">
            <label for="">Objectif du cours</label>
            {!! Form::textarea('objectif', null, ['class'=>'form-control', 'id'=>'summernote']) !!}
        </div>

        @if($action == 'update')

            <div class="form-group">
                <label for="">Image d'illustration</label>
                {!! Form::file('image',['class'=>'form-control']) !!}
            </div>

        @endif

        <div class="form-group">
            <label for="">Domaine du cours</label>
            {!! Form::select('domaine_id', $domaines, null, ['class' => 'form-control']) !!}
        </div>


        <div class="form-group">
            <label for="">Difficulte du cours</label>
            {!! Form::select('difficulte_id', $difficulte, null, ['class' => 'form-control']) !!}
        </div>

        <div class="form-group">
            <label for="">Nombres d'heures
                requis{{Form::number('heures', $cours->heures, ['class'=>'form-control'])}}</label>
        </div>

        @if($action == 'update')

            <div class="form-group">
                <label for="">Adresse de la vidéo</label>
                {!! Form::text('url_video',null, ['class'=>'form-control']) !!}
            </div>

            <div class="form-group">
                <label for="">
                    Publier le cours ?
                </label>
                {!! Form::checkbox('online',1,$cours->online,['class'=>'form-control']) !!}

            </div>

        @endif
    </div>