<div class="table-responsive">
    <table class="table" id="highlightArticles-table">
        <thead>
            <tr>
                <th>Article Id</th>
        <th>Rank</th>
        <th>Status</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($highlightArticles as $highlightArticle)
            <tr>
                <td>{!! $highlightArticle->article_id !!}</td>
            <td>{!! $highlightArticle->rank !!}</td>
            <td>{!! $highlightArticle->status !!}</td>
                <td>
                    {!! Form::open(['route' => ['highlightArticles.destroy', $highlightArticle->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{!! route('highlightArticles.show', [$highlightArticle->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                        <a href="{!! route('highlightArticles.edit', [$highlightArticle->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
