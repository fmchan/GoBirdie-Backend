<div class="table-responsive">
    <table class="table" id="banners-table">
        <thead>
            <tr>
                <th>Title</th>
        <th>Photo</th>
        <th>Type</th>
        <th>Link</th>
        <th>Rank</th>
        <th>Start</th>
        <th>End</th>
        <th>Status</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($banners as $banner)
            <tr>
                <td>{!! $banner->title !!}</td>
            <td><a href="{{ asset('/uploads/banners/'.$banner->photo) }}" target="_blank"><img style="width:200px" src="{{ asset('/uploads/banners/'.$banner->photo) }}"/></a></td>
            <td>{!! $banner->type !!}</td>
            <td>{!! $banner->link !!}</td>
            <td>{!! $banner->rank !!}</td>
            <td>{!! $banner->start !!}</td>
            <td>{!! $banner->end !!}</td>
            <td>{!! $banner->status !!}</td>
                <td>
                    {!! Form::open(['route' => ['banners.destroy', $banner->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{!! route('banners.show', [$banner->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                        <a href="{!! route('banners.edit', [$banner->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
