<div class="form-group col-sm-12">
  {{Form::label('banner', 'Banner',['class' => 'control-label'])}}
  <span class="required">*</span>
  @if(isset($banner->photo))
  <img src="{!! asset('/uploads/banners/'.$banner->photo) !!}"/>
  @endif
  {{Form::file('banner')}}
</div>

<div class="form-group col-sm-12">
    {!! Form::label('title', 'Title:') !!}
    {!! Form::text('title', null, ['class' => 'form-control']) !!}
</div>

<!-- Type Field -->
<div class="form-group col-sm-6">
    {!! Form::label('type', 'Type:') !!}
    {!! Form::select('type', ['N' => 'None', 'E' => 'External', 'P' => 'Place', 'A' => 'Article'], null, ['class' => 'form-control']) !!}
</div>

<!-- Link Field -->
<div class="form-group col-sm-6">
    {!! Form::label('link', 'Link:') !!}
    {!! Form::text('link', null, ['class' => 'form-control']) !!}
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

@if(isset($banner))
{{ Form::hidden('update', true) }}
@endif

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('banners.index') !!}" class="btn btn-default">Cancel</a>
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