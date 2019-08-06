<!-- Title Field -->
<div class="form-group">
    {!! Form::label('title', 'Title:') !!}
    <p>{!! $article->title !!}</p>
</div>

<!-- Start Field -->
<div class="form-group">
    {!! Form::label('start', 'Start:') !!}
    <p>{!! $article->start->format('d/m/Y') !!}</p>
</div>

<!-- End Field -->
<div class="form-group">
    {!! Form::label('end', 'End:') !!}
    <p>{!! $article->end->format('d/m/Y') !!}</p>
</div>

<div class="form-group">
    {!! Form::label('display', 'Display:') !!}
    <p>{!! $article->display->format('d/m/Y') !!}</p>
</div>

<!-- City Field -->
<div class="form-group">
    {!! Form::label('city', 'City:') !!}
    <p>{!! $article->cityObj->name !!}</p>
</div>

<!-- District Field -->
<div class="form-group">
    {!! Form::label('district', 'District:') !!}
    <p>{!! $article->districtObj->name !!}</p>
</div>

<!-- Categories Field -->
<div class="form-group">
    {!! Form::label('categories', 'Categories:') !!}
    @if(null !== ($categories = $article->getCategories()))
      {!! implode(', ', $categories) !!}
    @else
      N/A
    @endif
</div>

<!-- 
<div class="form-group">
    {!! Form::label('heart', 'Heart:') !!}
    <p>{!! $article->heart !!}</p>
</div>
-->

<!-- Bookmark Field -->
<div class="form-group">
    {!! Form::label('bookmark', 'Bookmark:') !!}
    <p>{!! $article->bookmark !!}</p>
</div>

<!-- Address Field -->
<div class="form-group">
    {!! Form::label('address', 'Address:') !!}
    <p>{!! $article->address !!}</p>
</div>

<!-- Lat Field -->
<div class="form-group">
    {!! Form::label('gps', 'gps:') !!}
    <p id="googlemapByGPS">{!! $article->gps !!}</p>
</div>

<!-- Transport Short Field -->
<div class="form-group">
    {!! Form::label('transport_short', 'Transport Short:') !!}
    <p>{!! $article->transport_short !!}</p>
</div>

<!-- Transport Long Field -->
<div class="form-group">
    {!! Form::label('transport_long', 'Transport Long:') !!}
    <p>{!! $article->transport_long !!}</p>
</div>

<!-- Telephone Field -->
<div class="form-group">
    {!! Form::label('telephone', 'Telephone:') !!}
    <p>{!! $article->telephone !!}</p>
</div>

<!-- Book Field -->
<div class="form-group">
    {!! Form::label('book', 'Book:') !!}
    <p>{!! $article->book ? "true" : "false" !!}</p>
</div>

<!-- Opening Field -->
<div class="form-group">
    {!! Form::label('opening', 'Opening:') !!}
    <p>{!! $article->opening !!}</p>
</div>

<!-- Fee Field -->
<div class="form-group">
    {!! Form::label('fee', 'Fee:') !!}
    <p>{!! $article->fee !!}</p>
</div>

<!-- Tags Public Field -->
<div class="form-group">
    {!! Form::label('tags_public', 'Tags Public:') !!}
    @if(null !== ($tags_public = $article->getTagsPublic()))
      {!! implode(', ', $tags_public) !!}
    @else
      N/A
    @endif
</div>

<!-- Tags Private Field -->
<div class="form-group">
    {!! Form::label('tags_private', 'Tags Private:') !!}
    @if(null !== ($tags_private = $article->getTagsPrivate()))
      {!! implode(', ', $tags_private) !!}
    @else
      N/A
    @endif
</div>

<!-- Email Field -->
<div class="form-group">
    {!! Form::label('email', 'Email:') !!}
    <p>{!! $article->email !!}</p>
</div>

<!-- Website Field -->
<div class="form-group">
    {!! Form::label('website', 'Website:') !!}
    <p>{!! $article->website !!}</p>
</div>

<!-- Content Field -->
<div class="form-group">
    {!! Form::label('content', 'Content:') !!}
    <p>{!! $article->content !!}</p>
</div>

<!-- Facilities Field -->
<div class="form-group">
    {!! Form::label('facilities', 'Facilities:') !!}
    @if(null !== ($facilities = $article->getFacilities()))
      {!! implode(', ', $facilities) !!}
    @else
      N/A
    @endif
</div>

<div class="form-group col-sm-12">
{!! Form::model($article, ['route' => ['articles.delete', $article->id], 'id' => 'photo-delete']) !!}
    @if (!empty($photos = $article->getPhotos()))
    <ul class="list-inline">
        @foreach($photos as $i=>$photo)
        <li>
            <span class="close">&times;</span>
            <img src='{{ $article->resize($i,null,200) }}' alt="{{ $photo }}"/>
        </li>
        @endforeach
    </ul>
    @endif
{{ Form::hidden('filename', null) }}
{!! Form::close() !!}
</div>

<!-- Related Articles Field -->
<div class="form-group">
    {!! Form::label('related_articles', 'Related Articles:') !!}
    @if(null !== ($related_articles = $article->getRelatedArticles()))
      {!! implode(', ', $related_articles) !!}
    @else
      N/A
    @endif
</div>

<!-- Related Places Field -->
<div class="form-group">
    {!! Form::label('related_places', 'Related Places:') !!}
    @if(null !== ($related_places = $article->getRelatedPlaces()))
      {!! implode(', ', $related_places) !!}
    @else
      N/A
    @endif
</div>

<!-- Rank Field -->
<div class="form-group">
    {!! Form::label('rank', 'Rank:') !!}
    <p>{!! $article->rank !!}</p>
</div>

<!-- Status Field -->
<div class="form-group">
    {!! Form::label('status', 'Status:') !!}
    <p>{!! $article->status !!}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{!! $article->created_at !!}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{!! $article->updated_at !!}</p>
</div>

<div class="form-group">
    <!-- map accordin -->
    <div id="map_panel" class="panel panel-primary">
        <div class="panel-heading">
            <h4 class="panel-title">
                <span class="glyphicon glyphicon-map-marker"></span>
                <a data-toggle="collapse" data-parent="#accordion" href="#collapse2">Click Here to show Google Map</a>
            </h4>
        </div>
        <div id="collapse2" class="panel-collapse collapse">
            <div class="panel-body">
                <div id="latlongmap" style="width: 595px; height: 400px;"></div>
                <div>Marked location: <span id="latlngspan">(0,0)</span></div>
            </div>
        </div>
    </div>
    <!-- end map accordin -->
</div>

@section('scripts')
<script src="{{ asset('js/map/map.js') }}"></script>
<script src="{{ asset('js/map/action.js') }}"></script>
<script>
    $(".close").click(function() {
      src = $(this).closest('li').find('img').attr("alt");
      //console.log(src);
      $("#photo-delete input[name=filename]").val(src);
      $("#photo-delete").submit();
    });
    $('#map_panel > .panel-heading a').click(function(){

        var gpslocation = "{{$article->gps}}";
        setTimeout(function () {
            google.maps.event.trigger(map, 'resize');
            if ($("#googlemapByGPS").text().length > 0)
                codeCoordinate($("#googlemapByGPS").text());
        }, 1000); //wait for modal pop up
    });
</script>
@endsection