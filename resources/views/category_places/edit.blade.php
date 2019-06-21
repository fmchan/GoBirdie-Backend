@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Category Place
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($categoryPlace, ['route' => ['categoryPlaces.update', $categoryPlace->id], 'method' => 'patch']) !!}

                        @include('category_places.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection