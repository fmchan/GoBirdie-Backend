<div class="table-responsive">
    <table class="table" id="highlightPlaces-table">
        <thead>
            <tr>
                <th>Place Id</th>
        <th>Rank</th>
        <th>Status</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($highlightPlaces as $highlightPlace)
            <tr>
                <td>{!! $highlightPlace->place_id !!}</td>
            <td>{!! $highlightPlace->rank !!}</td>
            <td>{!! $highlightPlace->status !!}</td>
                <td>
                    {!! Form::open(['route' => ['highlightPlaces.destroy', $highlightPlace->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{!! route('highlightPlaces.show', [$highlightPlace->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                        <a href="{!! route('highlightPlaces.edit', [$highlightPlace->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
