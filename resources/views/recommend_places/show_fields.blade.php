<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{!! $recommendPlace->id !!}</p>
</div>

<!-- Place Id Field -->
<div class="form-group">
    {!! Form::label('place_id', 'Place Id:') !!}
    <p>{!! $recommendPlace->place_id !!}</p>
</div>

<div class="form-group">
    {!! Form::label('type', 'Type:') !!}
    <p>{!! $recommendPlace->type !!}</p>
</div>

<!-- Rank Field -->
<div class="form-group">
    {!! Form::label('rank', 'Rank:') !!}
    <p>{!! $recommendPlace->rank !!}</p>
</div>

<!-- Status Field -->
<div class="form-group">
    {!! Form::label('status', 'Status:') !!}
    <p>{!! $recommendPlace->status !!}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{!! $recommendPlace->created_at !!}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{!! $recommendPlace->updated_at !!}</p>
</div>

