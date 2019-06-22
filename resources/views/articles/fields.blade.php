<!-- Title Field -->
<div class="form-group col-sm-6">
    {!! Form::label('title', 'Title:') !!}
    {!! Form::text('title', null, ['class' => 'form-control']) !!}
</div>
<!-- Categories Field -->
<div class="form-group col-sm-6">
    {!! Form::label('categories', 'Categories:') !!}
    {!! Form::select('categories[]', $categories, null, ['multiple'=>'multiple','class'=>'', 'id' => 'categories']) !!}
</div>

<!-- Start Field -->
<div class="form-group col-sm-6">
    {!! Form::label('start', 'Start Date:') !!}
    {!! Form::date('start', isset($article) ? $article->start->format('Y-m-d') : null, ['class' => 'form-control','id'=>'start']) !!}
</div>
<!-- End Field -->
<div class="form-group col-sm-6">
    {!! Form::label('end', 'End Date:') !!}
    {!! Form::date('end', isset($article) ? $article->end->format('Y-m-d') : null, ['class' => 'form-control','id'=>'end']) !!}
</div>

<!-- City Field -->
<div class="form-group col-sm-6">
    {!! Form::label('city', 'City:') !!}
    {!! Form::select('city', $cities, null, ['class' => 'form-control']) !!}
</div>
<!-- District Field -->
<div class="form-group col-sm-6">
    {!! Form::label('district', 'District:') !!}
    {!! Form::select('district', $districts, null, ['class' => 'form-control']) !!}
</div>

<!-- Address Field -->
<div class="form-group col-sm-6">
    {!! Form::label('address', 'Address:') !!}
    {!! Form::textarea('address', null, ['class' => 'form-control', 'rows' => 4]) !!}
</div>
<!-- Telephone Field -->
<div class="form-group col-sm-6">
    {!! Form::label('telephone', 'Telephone:') !!}
    {!! Form::textarea('telephone', null, ['class' => 'form-control', 'rows' => 4]) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('gps', 'GPS:', ['class' => 'control-label']) !!}
    <div class="input-group">
    {!! Form::text('gps', null, ['class' => 'form-control']) !!}
    <span class="input-group-addon" data-toggle="modal" data-target="#mapModal"><div class="glyphicon glyphicon glyphicon-map-marker"></div></span>
    </div>
</div>
<!-- Facilities Field -->
<div class="form-group col-sm-6">
    {!! Form::label('facilities', 'Facilities:') !!}
    {!! Form::select('facilities[]', $facilities, null, ['multiple'=>'multiple','class'=>'', 'id' => 'facilities']) !!}
</div>

<!-- Book Field -->
<div class="form-group col-sm-12">
    {!! Form::label('book', 'Need Booking?:') !!}
    <label class="radio-inline">
        {!! Form::radio('book', "1", null) !!} Yes
    </label>

    <label class="radio-inline">
        {!! Form::radio('book', "0", null) !!} No
    </label>
</div>

<!-- Transport Short Field -->
<div class="form-group col-sm-6">
    {!! Form::label('transport_short', 'Transport (Short):') !!}
    {!! Form::textarea('transport_short', null, ['class' => 'form-control', 'rows' => 4]) !!}
</div>

<!-- Transport Long Field -->
<div class="form-group col-sm-6">
    {!! Form::label('transport_long', 'Transport (Detail):') !!}
    {!! Form::textarea('transport_long', null, ['class' => 'form-control', 'rows' => 4]) !!}
</div>

<!-- Opening Field -->
<div class="form-group col-sm-6">
    {!! Form::label('opening', 'Opening:') !!}
    {!! Form::textarea('opening', null, ['class' => 'form-control', 'rows' => 4]) !!}
</div>

<!-- Fee Field -->
<div class="form-group col-sm-6">
    {!! Form::label('fee', 'Fee:') !!}
    {!! Form::textarea('fee', null, ['class' => 'form-control', 'rows' => 4]) !!}
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
    {!! Form::textarea('content', null, ['class' => 'form-control summernote']) !!}
</div>

<div class="form-group col-sm-12">
    @if (isset($article) && !empty($photos = $article->getPhotos()))
    <ul class="list-inline">
        @foreach($photos as $i=>$photo)
        <li><img src='{{ $article->resize($i,null,200) }}'/></li>
        @endforeach
    </ul>
    @endif
</div>
<!-- Photos Field -->
<div class="form-group col-sm-12">
    {!! Form::label('photo', 'Photos:') !!}
    <input type="file" class="form-control" name="photo[]" multiple>
</div>

<!-- Tags Public Field -->
<div class="form-group col-sm-6">
    {!! Form::label('tags_public', 'Tags (Public):') !!}
    {!! Form::select('tags_public[]', $tags, null, ['multiple'=>'multiple','class'=>'', 'id' => 'tags_public']) !!}
</div>
<!-- Tags Private Field -->
<div class="form-group col-sm-6">
    {!! Form::label('tags_private', 'Tags (Private):') !!}
    {!! Form::select('tags_private[]', $tags, null, ['multiple'=>'multiple','class'=>'', 'id' => 'tags_private']) !!}
</div>

<!-- Related Articles Field -->
<div class="form-group col-sm-6">
    {!! Form::label('related_articles', 'Related Articles:') !!}
    {!! Form::select('related_articles[]', $articles, null, ['multiple'=>'multiple','class'=>'', 'id' => 'related_articles']) !!}
</div>
<!-- Related Places Field -->
<div class="form-group col-sm-6">
    {!! Form::label('related_places', 'Related Places:') !!}
    {!! Form::select('related_places[]', $places, null, ['multiple'=>'multiple','class'=>'', 'id' => 'related_places']) !!}
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
    <a href="{!! route('articles.index') !!}" class="btn btn-default">Cancel</a>
</div>

<!-- Map Modal -->
<div class="modal fade" id="mapModal" tabindex="-1" role="dialog" aria-labelledby="mapModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="mapModalLabel">Google Map - Find your location</h4>
      </div>
      <div class="modal-body">
            <div>
                <label for="googlemapByAddr">Place Name</label>
                <div class="input-group">
                    <input id="googlemapByAddr" class="form-control" type="text" placeholder="Type a place name"> 
                    <span class="input-group-addon" id="searchByAddr"><i class="glyphicon glyphicon-search"></i></span>
                </div>
            </div>
            <div>
                <label for="googlemapByGPS">Latitude,Longitude</label>
                <div class="input-group">
                    <input id="googlemapByGPS" class="form-control" type="text" placeholder="Type a coordinate"> 
                    <span class="input-group-addon" id="searchByGPS"><i class="glyphicon glyphicon-search"></i></span>
                </div>
            </div>
            <br>
            <div id="latlongmap" style="width: 565px; height: 400px;"></div>
            <div>Current location: <span id="mlat">(0,0)</span></div>
            <div>Marked location: <span id="latlngspan">(0,0)</span></div>
      </div>
      <div class="modal-footer">
        <button type="button" id="modal_save" class="btn btn-default" data-dismiss="modal">Save</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
      </div>
    </div>
  </div>
</div>

@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('css/plugins/selectize.default.css') }}" />
<link rel="stylesheet" type="text/css" href="{{ asset('css/plugins/summernote.css') }}" />
@endsection

@section('scripts')
<script src="{{ asset('js/selectize/selectize.min.js') }}"></script>
<script src="{{ asset('js/summernote/summernote.min.js') }}"></script>
<script src="{{ asset('js/map/map.js') }}"></script>
<script src="{{ asset('js/map/action.js') }}"></script>
<script>

@if(isset($article))
    var tags_public = "{{ $article->tags_public }}";
    $("#tags_public").val(tags_public.split(','));
    var tags_private = "{{ $article->tags_private }}";
    $("#tags_private").val(tags_private.split(','));
    var categories = "{{ $article->categories }}";
    $("#categories").val(categories.split(','));
    var facilities = "{{ $article->facilities }}";
    $("#facilities").val(facilities.split(','));
    var related_articles = "{{ $article->related_articles }}";
    $("#related_articles").val(related_articles.split(','));
    var related_places = "{{ $article->related_places }}";
    $("#related_places").val(related_places.split(','));
@endif

    $('#start').datetimepicker({
        format: 'YYYY-MM-DD',
        useCurrent: false
    });
    $('#end').datetimepicker({
        format: 'YYYY-MM-DD',
        useCurrent: false
    });

    $('#tags_public').selectize({
        //maxItems: 10,
        delimiter: ',',
        persist: false,
        create: function(input) {
            return {
                value: input,
                text: input
            }
        }
    });
    $('#tags_private').selectize({
        //maxItems: 10,
        delimiter: ',',
        persist: false,
        create: function(input) {
            return {
                value: input,
                text: input
            }
        }
    });
    $('#categories').selectize();
    $('#facilities').selectize();
    $('#related_articles').selectize();
    $('#related_places').selectize();

    $('.summernote').summernote({ height: 500 });
</script>
@endsection