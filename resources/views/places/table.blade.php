<div class="table-responsive">
    <table class="table" id="places-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Organization</th>
                <th>District</th>
                <th>Categories</th>
                <th>Tags Public</th>
                <th>Tags Private</th>
                <th>Rank</th>
                <th>Status</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($places as $place)
            <tr>
                <td>{!! $place->id !!}</td>
                <td>{!! $place->title !!}</td>
                <td>{!! $place->organizationObj->name !!}</td>
            <td>{!! $place->districtObj->name !!}</td>
            <td>
                @if(null !== ($categories = $place->getCategories()))
                    {!! implode(', ', $categories) !!}
                @else
                  N/A
                @endif
            </td>
            <td>
                @if(null !== ($tags_public = $place->getTagsPublic()))
                    {!! implode(', ', $tags_public) !!}
                @else
                  N/A
                @endif
            </td>
            <td>
                @if(null !== ($tags_private = $place->getTagsPrivate()))
                    {!! implode(', ', $tags_private) !!}
                @else
                  N/A
                @endif
            </td>
            <td>{!! $place->rank !!}</td>
            <td>{!! $place->status !!}</td>
                <td>
                    {!! Form::open(['route' => ['places.destroy', $place->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{!! route('places.show', [$place->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                        <a href="{!! route('places.edit', [$place->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
