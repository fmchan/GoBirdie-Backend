<div class="table-responsive">
    <table class="table" id="categoryPlaces-table">
        <thead>
            <tr>
                <th>Name</th>
        <th>Icon</th>
        <th>Rank Home</th>
        <th>Rank Place</th>
        <th>Status</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($categoryPlaces as $categoryPlace)
            <tr>
                <td>{!! $categoryPlace->name !!}</td>
            <td><img src="{{ asset('/uploads/icons/'.$categoryPlace->icon) }}"/></td>
            <td>{!! $categoryPlace->rank_home !!}</td>
            <td>{!! $categoryPlace->rank_place !!}</td>
            <td>{!! $categoryPlace->status !!}</td>
                <td>
                    {!! Form::open(['route' => ['categoryPlaces.destroy', $categoryPlace->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{!! route('categoryPlaces.show', [$categoryPlace->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                        <a href="{!! route('categoryPlaces.edit', [$categoryPlace->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
