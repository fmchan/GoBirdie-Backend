<!-- Title Field -->
<div class="form-group col-sm-6">
    {!! Form::label('title', 'Title:') !!}
    {!! Form::text('title', null, ['class' => 'form-control']) !!}
</div>

<!-- City Field -->
<div class="form-group col-sm-6">
    {!! Form::label('city', 'City:') !!}
    {!! Form::select('city', ['1' => 'one', '2' => 'two'], null, ['class' => 'form-control']) !!}
</div>

<!-- District Field -->
<div class="form-group col-sm-6">
    {!! Form::label('district', 'District:') !!}
    {!! Form::select('district', ['1' => 'one', '2' => 'two'], null, ['class' => 'form-control']) !!}
</div>

<!-- Categories Field -->
<div class="form-group col-sm-6">
    {!! Form::label('categories', 'Categories:') !!}
    {!! Form::text('categories', null, ['class' => 'form-control']) !!}
</div>

<!-- Organization Field -->
<div class="form-group col-sm-6">
    {!! Form::label('organization', 'Organization:') !!}
    {!! Form::select('organization', ['1' => 'one', '2' => 'two'], null, ['class' => 'form-control']) !!}
</div>

<!-- Heart Field -->
<div class="form-group col-sm-6">
    {!! Form::label('heart', 'Heart:') !!}
    {!! Form::number('heart', null, ['class' => 'form-control']) !!}
</div>

<!-- Bookmark Field -->
<div class="form-group col-sm-6">
    {!! Form::label('bookmark', 'Bookmark:') !!}
    {!! Form::number('bookmark', null, ['class' => 'form-control']) !!}
</div>

<!-- Address Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('address', 'Address:') !!}
    {!! Form::textarea('address', null, ['class' => 'form-control']) !!}
</div>

<!-- Lat Field -->
<div class="form-group col-sm-6">
    {!! Form::label('lat', 'Lat:') !!}
    {!! Form::text('lat', null, ['class' => 'form-control']) !!}
</div>

<!-- Long Field -->
<div class="form-group col-sm-6">
    {!! Form::label('long', 'Long:') !!}
    {!! Form::text('long', null, ['class' => 'form-control']) !!}
</div>

<!-- Transport Short Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('transport_short', 'Transport Short:') !!}
    {!! Form::textarea('transport_short', null, ['class' => 'form-control']) !!}
</div>

<!-- Transport Long Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('transport_long', 'Transport Long:') !!}
    {!! Form::textarea('transport_long', null, ['class' => 'form-control']) !!}
</div>

<!-- Telephone Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('telephone', 'Telephone:') !!}
    {!! Form::textarea('telephone', null, ['class' => 'form-control']) !!}
</div>

<!-- Age Start Field -->
<div class="form-group col-sm-6">
    {!! Form::label('age_start', 'Age Start:') !!}
    {!! Form::number('age_start', null, ['class' => 'form-control']) !!}
</div>

<!-- Age End Field -->
<div class="form-group col-sm-6">
    {!! Form::label('age_end', 'Age End:') !!}
    {!! Form::number('age_end', null, ['class' => 'form-control']) !!}
</div>

<!-- Book Field -->
<div class="form-group col-sm-12">
    {!! Form::label('book', 'Book:') !!}
    <label class="radio-inline">
        {!! Form::radio('book', "1", null) !!} Yes
    </label>

    <label class="radio-inline">
        {!! Form::radio('book', "0", null) !!} No
    </label>

</div>

<!-- Opening Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('opening', 'Opening:') !!}
    {!! Form::textarea('opening', null, ['class' => 'form-control']) !!}
</div>

<!-- Opening Select Field -->
<div class="form-group col-sm-6">
    {!! Form::label('opening_hours', 'Opening Select:') !!}
    {!! Form::text('opening_hours', null, ['class' => 'form-control']) !!}
</div>

<!-- Fee Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('fee', 'Fee:') !!}
    {!! Form::textarea('fee', null, ['class' => 'form-control']) !!}
</div>

<!-- Fee Number Field -->
<div class="form-group col-sm-6">
    {!! Form::label('fee_number', 'Fee Number:') !!}
    {!! Form::number('fee_number', null, ['class' => 'form-control']) !!}
</div>

<!-- Area Field -->
<div class="form-group col-sm-6">
    {!! Form::label('areas', 'Area:') !!}
    {!! Form::text('areas', null, ['class' => 'form-control']) !!}
</div>

<!-- Tags Public Field -->
<div class="form-group col-sm-6">
    {!! Form::label('tags_public', 'Tags Public:') !!}
    {!! Form::text('tags_public', null, ['class' => 'form-control']) !!}
</div>

<!-- Tags Private Field -->
<div class="form-group col-sm-6">
    {!! Form::label('tags_private', 'Tags Private:') !!}
    {!! Form::text('tags_private', null, ['class' => 'form-control']) !!}
</div>

<!-- Email Field -->
<div class="form-group col-sm-6">
    {!! Form::label('email', 'Email:') !!}
    {!! Form::email('email', null, ['class' => 'form-control']) !!}
</div>

<!-- Website Field -->
<div class="form-group col-sm-6">
    {!! Form::label('website', 'Website:') !!}
    {!! Form::text('website', null, ['class' => 'form-control']) !!}
</div>

<!-- Content Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('content', 'Content:') !!}
    {!! Form::textarea('content', null, ['class' => 'form-control']) !!}
</div>

<!-- Facilities Field -->
<div class="form-group col-sm-6">
    {!! Form::label('facilities', 'Facilities:') !!}
    {!! Form::text('facilities', null, ['class' => 'form-control']) !!}
</div>

<!-- Photos Field -->
<div class="form-group col-sm-6">
    {!! Form::label('photos', 'Photos:') !!}
    {!! Form::text('photos', null, ['class' => 'form-control']) !!}
</div>

<!-- Related Articles Field -->
<div class="form-group col-sm-6">
    {!! Form::label('related_articles', 'Related Articles:') !!}
    {!! Form::text('related_articles', null, ['class' => 'form-control']) !!}
</div>

<!-- Related Places Field -->
<div class="form-group col-sm-6">
    {!! Form::label('related_places', 'Related Places:') !!}
    {!! Form::text('related_places', null, ['class' => 'form-control']) !!}
</div>

<!-- Rank Field -->
<div class="form-group col-sm-6">
    {!! Form::label('rank', 'Rank:') !!}
    {!! Form::number('rank', null, ['class' => 'form-control']) !!}
</div>

<!-- Status Field -->
<div class="form-group col-sm-6">
    {!! Form::label('status', 'Status:') !!}
    {!! Form::select('status', ['I' => 'INACTIVE', 'A' => 'ACTIVE'], null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('places.index') !!}" class="btn btn-default">Cancel</a>
</div>
