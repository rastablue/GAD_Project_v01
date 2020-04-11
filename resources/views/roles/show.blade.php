@extends('layouts.app')

@section('content')
<!-- Illustrations -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Detalles del Rol:</h6><i>{{ $role->name }}</i>
            <a href="javascript:history.back()">
                <img class="img-responsive img-rounded float-right" src="{{ asset('images/retroceder.png') }}">
            </a>
        </div>
        <div class="card-body">
            {!! Form::model($role, ['route' => ['roles.show', $role->id]]) !!}
            <h3>Lista de Permisos</h3>
            <div class="form-group">
                <ul class="list-unstyled">
                    @foreach ($permissions as $permission)
                        <li>
                            <label>
                                {{ Form::checkbox('permissions[]', $permission->id, null, ['disabled' => 'true']) }}
                                {{ $permission->name }}
                                <em>({{ $permission->guard_name ?: 'N/A' }})</em>
                            </label>
                        </li>
                    @endforeach
                </ul>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection
