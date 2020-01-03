<!-- Channel Field -->
<div class="form-group col-sm-6">
    {!! Form::label('title', 'Title:') !!}
    {!! Form::text('title', null, ['class' => 'form-control']) !!}
</div>

<!-- Body Field -->
<div class="form-group col-sm-6">
    {!! Form::label('body', 'Body:') !!}
    {!! Form::text('body', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Send', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('pushes.index') !!}" class="btn btn-default">Cancel</a>
</div>
