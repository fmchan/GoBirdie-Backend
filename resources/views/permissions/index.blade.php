@extends('layouts.app')

@section('title', '| Permissions')

@section('content')

<div class="col-lg-12 col-lg-offset-1">
    <div class="row">
        <div class="col-lg-12"><h2><i class="fa fa-key"></i> Permissions</h2>
        </div>
    </div>
    <hr>
    <div class="table-responsive">
        <table class="table table-bordered table-striped">

            <thead>
                <tr>
                    <th>Permissions</th>
                    <th>Operation</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($permissions as $permission)
                <tr>
                    <td>{{ $permission->name }}</td> 
                    <td>
                    <a href="{{ URL::to('permissions/'.$permission->id.'/edit') }}" class="btn btn-info pull-left" style="margin-right: 3px;">Edit</a>

                    {!! Form::open(['method' => 'DELETE', 'route' => ['permissions.destroy', $permission->id] ]) !!}
                    {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                    {!! Form::close() !!}

                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

@can('permission-create')
    <a href="{{ URL::to('permissions/create') }}" class="btn btn-success">Add Permission</a>
@endcan

</div>

@endsection