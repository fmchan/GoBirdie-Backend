@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Hot Keyword Article
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($hotKeywordArticle, ['route' => ['hotKeywordArticles.update', $hotKeywordArticle->id], 'method' => 'patch']) !!}

                        @include('hot_keyword_articles.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection