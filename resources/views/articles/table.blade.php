<div class="table-responsive">
    <table class="table" id="articles-table">
        <thead>
            <tr>
                <th>Title</th>
                <th>Start</th>
                <th>End</th>
                <th>District</th>
                <th>Categories</th>
                <th>Tags Public</th>
                <th>Tags Private</th>
                <th>Rank</th>
                <th>Status</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($articles as $article)
            <tr>
                <td>{!! $article->title !!}</td>
            <td>{!! $article->start->format('d/m/Y') !!}</td>
            <td>{!! $article->end->format('d/m/Y') !!}</td>
            <td>{!! $article->districtObj->name !!}</td>
            <td>
                @if(null !== ($categories = $article->getCategories()))
                    {!! implode(', ', $categories) !!}
                @else
                  N/A
                @endif
            </td>
            <td>
                @if(null !== ($tags_public = $article->getTagsPublic()))
                    {!! implode(', ', $tags_public) !!}
                @else
                  N/A
                @endif
            </td>
            <td>
                @if(null !== ($tags_private = $article->getTagsPrivate()))
                    {!! implode(', ', $tags_private) !!}
                @else
                  N/A
                @endif
            </td>
            <td>{!! $article->rank !!}</td>
            <td>{!! $article->status !!}</td>
                <td>
                    {!! Form::open(['route' => ['articles.destroy', $article->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{!! route('articles.show', [$article->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                        <a href="{!! route('articles.edit', [$article->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
