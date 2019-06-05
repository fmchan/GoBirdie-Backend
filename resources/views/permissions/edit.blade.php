@extends('layouts.app')

@section('title', '| Edit Permission')

@section('content')

<div class='col-lg-4 col-lg-offset-4'>

    {{-- @include ('errors.list') --}}
    <div class="row">
        <div class="col-lg-12"><h2><i class="fa fa-key"></i> Permissions</h2>
        </div>
    </div>
    <hr>
    {{ Form::model($permission, array('route' => array('permissions.update', $permission->id), 'method' => 'PUT')) }}

    <div class="form-group">
        {{ Form::label('name', 'Permission Name') }}
        {{ Form::text('name', null, array('class' => 'form-control')) }}
    </div>
    <br>
    {{ Form::submit('Edit', array('class' => 'btn btn-primary')) }}

    {{ Form::close() }}

</div>

@endsection