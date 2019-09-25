<!-- Keyword Field -->
<div class="form-group col-sm-12">
    {!! Form::label('keyword', 'Keyword:') !!}
    {!! Form::text('keyword', null, ['class' => 'form-control']) !!}
</div>

<!-- Start Field -->
<div class="form-group col-sm-6">
    {!! Form::label('start', 'Start:') !!}
    {!! Form::text('start', null, ['class' => 'form-control','id'=>'start']) !!}
</div>


<!-- End Field -->
<div class="form-group col-sm-6">
    {!! Form::label('end', 'End:') !!}
    {!! Form::text('end', null, ['class' => 'form-control','id'=>'end']) !!}
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
    <a href="{!! route('hotKeywordArticles.index') !!}" class="btn btn-default">Cancel</a>
</div>

@section('scripts')
<script type="text/javascript">
    $('#start').datetimepicker({
        format: 'YYYY-MM-DD HH:mm:ss',
        useCurrent: false
    })
    $('#end').datetimepicker({
        format: 'YYYY-MM-DD HH:mm:ss',
        useCurrent: false
    })
</script>
@endsection