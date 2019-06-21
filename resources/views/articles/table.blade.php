<div class="table-responsive">
    <table class="table" id="articles-table">
        <thead>
            <tr>
                <th>Title</th>
        <th>Start</th>
        <th>End</th>
        <th>City</th>
        <th>District</th>
        <th>Categories</th>
        <th>Heart</th>
        <th>Bookmark</th>
        <th>Address</th>
        <th>Lat</th>
        <th>Long</th>
        <th>Transport Short</th>
        <th>Transport Long</th>
        <th>Telephone</th>
        <th>Book</th>
        <th>Opening</th>
        <th>Fee</th>
        <th>Tags Public</th>
        <th>Tags Private</th>
        <th>Email</th>
        <th>Website</th>
        <th>Content</th>
        <th>Facilities</th>
        <th>Photos</th>
        <th>Related Articles</th>
        <th>Related Places</th>
        <th>Rank</th>
        <th>Status</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($articles as $article)
            <tr>
                <td>{!! $article->title !!}</td>
            <td>{!! $article->start !!}</td>
            <td>{!! $article->end !!}</td>
            <td>{!! $article->city !!}</td>
            <td>{!! $article->district !!}</td>
            <td>{!! $article->categories !!}</td>
            <td>{!! $article->heart !!}</td>
            <td>{!! $article->bookmark !!}</td>
            <td>{!! $article->address !!}</td>
            <td>{!! $article->lat !!}</td>
            <td>{!! $article->long !!}</td>
            <td>{!! $article->transport_short !!}</td>
            <td>{!! $article->transport_long !!}</td>
            <td>{!! $article->telephone !!}</td>
            <td>{!! $article->book !!}</td>
            <td>{!! $article->opening !!}</td>
            <td>{!! $article->fee !!}</td>
            <td>{!! $article->tags_public !!}</td>
            <td>{!! $article->tags_private !!}</td>
            <td>{!! $article->email !!}</td>
            <td>{!! $article->website !!}</td>
            <td>{!! $article->content !!}</td>
            <td>{!! $article->facilities !!}</td>
            <td>{!! $article->photos !!}</td>
            <td>{!! $article->related_articles !!}</td>
            <td>{!! $article->related_places !!}</td>
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
