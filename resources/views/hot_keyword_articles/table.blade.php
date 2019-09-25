<div class="table-responsive">
    <table class="table" id="hotKeywordArticles-table">
        <thead>
            <tr>
                <th>Keyword</th>
        <th>Rank</th>
        <th>Start</th>
        <th>End</th>
        <th>Status</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($hotKeywordArticles as $hotKeywordArticle)
            <tr>
                <td>{!! $hotKeywordArticle->keyword !!}</td>
            <td>{!! $hotKeywordArticle->rank !!}</td>
            <td>{!! $hotKeywordArticle->start !!}</td>
            <td>{!! $hotKeywordArticle->end !!}</td>
            <td>{!! $hotKeywordArticle->status !!}</td>
                <td>
                    {!! Form::open(['route' => ['hotKeywordArticles.destroy', $hotKeywordArticle->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{!! route('hotKeywordArticles.show', [$hotKeywordArticle->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                        <a href="{!! route('hotKeywordArticles.edit', [$hotKeywordArticle->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
