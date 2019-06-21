<div class="table-responsive">
    <table class="table" id="categoryArticles-table">
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
        @foreach($categoryArticles as $categoryArticle)
            <tr>
                <td>{!! $categoryArticle->name !!}</td>
            <td><img src="{{ asset('/uploads/icons/'.$categoryArticle->icon) }}"/></td>
            <td>{!! $categoryArticle->rank_home !!}</td>
            <td>{!! $categoryArticle->rank_place !!}</td>
            <td>{!! $categoryArticle->status !!}</td>
                <td>
                    {!! Form::open(['route' => ['categoryArticles.destroy', $categoryArticle->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{!! route('categoryArticles.show', [$categoryArticle->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                        <a href="{!! route('categoryArticles.edit', [$categoryArticle->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
