<!-- Article Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('article_id', 'Article Id:') !!}
    {!! Form::text('article_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Rank Field -->
<div class="form-group col-sm-6">
    {!! Form::label('rank', 'Rank:') !!}
    {!! Form::number('rank', null, ['class' => 'form-control']) !!}
</div>

<!-- Status Field -->
<div class="form-group col-sm-6">
    {!! Form::label('status', 'Status:') !!}
    {!! Form::select('status', ['A' => 'ACTIVE', 'I' => 'INACTIVE'], null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('highlightArticles.index') !!}" class="btn btn-default">Cancel</a>
</div>
