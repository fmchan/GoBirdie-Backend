<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

  <div class="form-group col-sm-6">
      {{Form::label('photo', 'Icon',['class' => 'control-label'])}}
      <span class="required">*</span>
      @if(isset($categoryArticle->icon))
      <img src="{!! asset('/uploads/icons/'.$categoryArticle->icon) !!}"/>
      @endif
      {{Form::file('photo')}}
  </div>

<!-- Rank Home Field -->
<div class="form-group col-sm-6">
    {!! Form::label('rank_home', 'Rank Home:') !!}
    {!! Form::number('rank_home', null, ['class' => 'form-control']) !!}
</div>

<!-- Rank Place Field -->
<div class="form-group col-sm-6">
    {!! Form::label('rank_place', 'Rank Place:') !!}
    {!! Form::number('rank_place', null, ['class' => 'form-control']) !!}
</div>

<!-- Status Field -->
<div class="form-group col-sm-6">
    {!! Form::label('status', 'Status:') !!}
    {!! Form::select('status', ['I' => 'INACTIVE', 'A' => 'ACTIVE'], null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('categoryArticles.index') !!}" class="btn btn-default">Cancel</a>
</div>
