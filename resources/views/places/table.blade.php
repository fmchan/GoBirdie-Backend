<div class="table-responsive">
    <table class="table" id="places-table">
        <thead>
            <tr>
                <th>Title</th>
        <th>City</th>
        <th>District</th>
        <th>Categories</th>
        <th>Organization</th>
        <th>Heart</th>
        <th>Bookmark</th>
        <th>Address</th>
        <th>Lat</th>
        <th>Long</th>
        <th>Transport Short</th>
        <th>Transport Long</th>
        <th>Telephone</th>
        <th>Age Start</th>
        <th>Age End</th>
        <th>Book</th>
        <th>Opening</th>
        <th>Opening Select</th>
        <th>Fee</th>
        <th>Fee Number</th>
        <th>Area</th>
        <th>Tags Public</th>
        <th>Tags Private</th>
        <th>Email</th>
        <th>Website</th>
        <th>Content</th>
        <th>Facilities</th>
        <th>Photos</th>
        <th>Related Articles</th>
        <th>Related Places</th>
        <th>Rank</th>
        <th>Status</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($places as $place)
            <tr>
                <td>{!! $place->title !!}</td>
            <td>{!! $place->city !!}</td>
            <td>{!! $place->district !!}</td>
            <td>{!! $place->categories !!}</td>
            <td>{!! $place->organization !!}</td>
            <td>{!! $place->heart !!}</td>
            <td>{!! $place->bookmark !!}</td>
            <td>{!! $place->address !!}</td>
            <td>{!! $place->lat !!}</td>
            <td>{!! $place->long !!}</td>
            <td>{!! $place->transport_short !!}</td>
            <td>{!! $place->transport_long !!}</td>
            <td>{!! $place->telephone !!}</td>
            <td>{!! $place->age_start !!}</td>
            <td>{!! $place->age_end !!}</td>
            <td>{!! $place->book !!}</td>
            <td>{!! $place->opening !!}</td>
            <td>{!! $place->opening_select !!}</td>
            <td>{!! $place->fee !!}</td>
            <td>{!! $place->fee_number !!}</td>
            <td>{!! $place->area !!}</td>
            <td>{!! $place->tags_public !!}</td>
            <td>{!! $place->tags_private !!}</td>
            <td>{!! $place->email !!}</td>
            <td>{!! $place->website !!}</td>
            <td>{!! $place->content !!}</td>
            <td>{!! $place->facilities !!}</td>
            <td>{!! $place->photos !!}</td>
            <td>{!! $place->related_articles !!}</td>
            <td>{!! $place->related_places !!}</td>
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
