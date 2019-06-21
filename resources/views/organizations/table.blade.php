<div class="table-responsive">
    <table class="table" id="organizations-table">
        <thead>
            <tr>
                <th>Name</th>
        <th>Rank</th>
        <th>Status</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($organizations as $organization)
            <tr>
                <td>{!! $organization->name !!}</td>
            <td>{!! $organization->rank !!}</td>
            <td>{!! $organization->status !!}</td>
                <td>
                    {!! Form::open(['route' => ['organizations.destroy', $organization->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{!! route('organizations.show', [$organization->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                        <a href="{!! route('organizations.edit', [$organization->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
