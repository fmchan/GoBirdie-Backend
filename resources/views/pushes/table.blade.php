<div class="table-responsive">
    <table class="table" id="pushes-table">
        <thead>
            <tr>
                <th>Title</th>
        <th>Body</th>
        <th>Create Date</th>
        {{--<th>Json</th>
        <th>Ttl</th>
        <th>Image</th>
        <th>Channel</th>
                <th colspan="3">Action</th>--}}
            </tr>
        </thead>
        <tbody>
        @foreach($pushes as $push)
            <tr>
                <td>{!! $push->title !!}</td>
            <td>{!! $push->body !!}</td>
            <td>{!! $push->created_at !!}</td>
            {{--<td>{!! $push->json !!}</td>
            <td>{!! $push->ttl !!}</td>
            <td>{!! $push->image !!}</td>
            <td>{!! $push->channel !!}</td>
                <td>
                    {!! Form::open(['route' => ['pushes.destroy', $push->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{!! route('pushes.show', [$push->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                        <a href="{!! route('pushes.edit', [$push->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>--}}
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
