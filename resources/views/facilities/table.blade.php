<div class="table-responsive">
    <table class="table" id="facilities-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
        <th>Icon</th>
        <th>Rank</th>
        <th>Status</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($facilities as $facility)
            <tr>
                <td>{!! $facility->id !!}</td>
                <td>{!! $facility->name !!}</td>
            <td><img src="{{ asset('/uploads/facilities/'.$facility->icon) }}"/></td>
            <td>{!! $facility->rank !!}</td>
            <td>{!! $facility->status !!}</td>
                <td>
                    {!! Form::open(['route' => ['facilities.destroy', $facility->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{!! route('facilities.show', [$facility->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                        <a href="{!! route('facilities.edit', [$facility->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
