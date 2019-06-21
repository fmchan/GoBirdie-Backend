@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Facility
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($facility, ['route' => ['facilities.update', $facility->id], 'files' => true, 'method' => 'patch']) !!}

                        @include('facilities.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection