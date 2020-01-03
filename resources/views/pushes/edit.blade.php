@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Push
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($push, ['route' => ['pushes.update', $push->id], 'method' => 'patch']) !!}

                        @include('pushes.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection