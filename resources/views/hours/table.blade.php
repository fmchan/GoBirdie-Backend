<div class="table-responsive">
    <table class="table" id="hours-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
        <th>Rank</th>
        <th>Status</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($hours as $hour)
            <tr>
                <td>{!! $hour->id !!}</td>
                <td>{!! $hour->name !!}</td>
            <td>{!! $hour->rank !!}</td>
            <td>{!! $hour->status !!}</td>
                <td>
                    {!! Form::open(['route' => ['hours.destroy', $hour->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{!! route('hours.show', [$hour->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                        <a href="{!! route('hours.edit', [$hour->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
