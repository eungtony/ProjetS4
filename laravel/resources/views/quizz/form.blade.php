{!! Form::model($quizz, [
'url' => action("adminQuizzController@$action", $chap_id),
'method' => $action == "addQuestions" ? "post" : "put"]) !!}

@if($action == 'update')
    {!! Form::hidden('question_id', $quizz->id) !!}
    @endif

{{Form::hidden('quizz_id', $quizz_id, ['class'=>'form-control'])}}
{{Form::hidden('chapitre_id', $chap_id, ['class'=>'form-control'])}}


<div class="form-group">
    <label for="">Intitulé de la question</label>
    {!! Form::text('question', $quizz->question, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    <label for="">Ordre de la question
        {!! Form::number('ordre', $quizz->ordre, ['class' => 'form-control']) !!}
    </label>
</div>

<div class="form-group">
    <label for="">Type de la question</label>
    {!! Form::select('type', ['0'=>'QCM', '1'=>'QCU'],$quizz->type, ['class' => 'form-control']) !!}
</div>

@if($action == 'addQuestions')

    {{Form::hidden('reponse_id', null)}}

    @else

    <div class="form-group">
        <label for="">Réponse de la question</label>
        {!! Form::select('reponse_id', $list,$quizz->reponse_id, ['class' => 'form-control']) !!}
    </div>

    @endif