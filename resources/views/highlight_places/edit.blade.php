@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Highlight Place
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($highlightPlace, ['route' => ['highlightPlaces.update', $highlightPlace->id], 'method' => 'patch']) !!}

                        @include('highlight_places.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection