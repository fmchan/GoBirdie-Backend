<div class="table-responsive">
    <table class="table" id="hotKeywordPlaces-table">
        <thead>
            <tr>
                <th>Keyword</th>
        <th>Rank</th>
        <th>Status</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($hotKeywordPlaces as $hotKeywordPlace)
            <tr>
                <td>{!! $hotKeywordPlace->keyword !!}</td>
            <td>{!! $hotKeywordPlace->rank !!}</td>
            <td>{!! $hotKeywordPlace->status !!}</td>
                <td>
                    {!! Form::open(['route' => ['hotKeywordPlaces.destroy', $hotKeywordPlace->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{!! route('hotKeywordPlaces.show', [$hotKeywordPlace->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                        <a href="{!! route('hotKeywordPlaces.edit', [$hotKeywordPlace->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
