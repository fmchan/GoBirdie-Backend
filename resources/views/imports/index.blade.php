@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1 class="pull-left">Importer</h1>
    </section>
    <div class="clearfix"></div>
    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>

        @if ($errors->any())
            <div class="alert alert-danger">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

<div class="box box-primary">
            <div class="box-body">
                <div class="row">
    <form action="{!! route('imports.uploadImages') !!}" method="post" enctype="multipart/form-data" id="uploadImages">
        @csrf
        <div class="form-group col-sm-12">
        <input type="file" name="photo[]" multiple>
    </div>
    <div class="form-group col-sm-12">
        <input class="btn btn-primary" type="submit" value="Import Images" form="uploadImages">
    </div>
    </form></div>
</div></div>

<div class="box box-primary">
            <div class="box-body">
                <div class="row">
    <form action="{!! route('imports.index') !!}" method="post" enctype="multipart/form-data" id="importFile">
        @csrf

        @if (Session::has('success'))
            <div class="alert alert-success">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                <p>{{ Session::get('success') }}</p>
            </div>
        @endif
                    <div class="form-group col-sm-12">
        <input type="file" name="import_file" />
                </div>
                 <div class="form-group col-sm-12">
        <input type="radio" name="type" value="article" checked> 情報
        <input type="radio" name="type" value="place"> 好去處
    </div>
    <div class="form-group col-sm-12">
        <input class="btn btn-primary" type="submit" value="Import Excel File" form="importFile">
    </div>
    </form></div>
</div></div>
</div>
    <section class="content-header">
        <h1 class="pull-left">Image Library</h1>
    </section>
    <div class="clearfix"></div>
    <div class="content">
        <div class="box box-primary">
            <div class="box-body">
                <div class="row">
                    <div class="form-group col-sm-12">
                    {!! Form::open(['route' => 'imports.deleteImage', 'id' => 'photo-delete']) !!}
                        <ul class="list-inline">
                            @foreach($files as $i=>$photo)
                            <li>
                                <span class="close">&times;</span>
                                <img src='resizer.php?&h=200&zc=1&src={{ $photo }}' alt="{{ $photo }}"/>
                            </li>
                            @endforeach
                        </ul>
                    {{ Form::hidden('filename', null) }}
                    {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>

  </div>
@endsection

@section('scripts')
<script>
    $(".close").click(function() {
      src = $(this).closest('li').find('img').attr("alt");
      console.log(src);
      $("#photo-delete input[name=filename]").val(src);
      $("#photo-delete").submit();
    });
    /*$( "form" ).submit(function( event ) {
      alert( "Handler for called." + $(this).attr("id") );
      event.preventDefault();
    });*/
</script>
@endsection