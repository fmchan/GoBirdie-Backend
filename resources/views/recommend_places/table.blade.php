<div class="table-responsive">
    <table class="table" id="recommendPlaces-table">
        <thead>
            <tr>
                <th>Place Id</th>
        <th>Rank</th>
        <th>Status</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($recommendPlaces as $recommendPlace)
            <tr>
                <td>{!! $recommendPlace->place_id !!}</td>
            <td>{!! $recommendPlace->rank !!}</td>
            <td>{!! $recommendPlace->status !!}</td>
                <td>
                    {!! Form::open(['route' => ['recommendPlaces.destroy', $recommendPlace->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{!! route('recommendPlaces.show', [$recommendPlace->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                        <a href="{!! route('recommendPlaces.edit', [$recommendPlace->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
