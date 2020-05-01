{!! Form::model($role, ['route' => ['roles.update', $role->id]]) !!}

<div class="form-group">
    {{ Form::label('name', 'Nombre') }}
    {{ Form::text('name', null, ['class' => 'form-control']) }}
</div>
{{-- Guard --}}
<input id="guard_name" type="hidden" name="guard_name" value="web">
<hr>
<h3>Lista de Permisos</h3>
<div class="form-group">
    <ul class="list-unstyled">
        @foreach ($permissions as $permission)
            <li>
                <label>
                    {{ Form::checkbox('permissions[]', $permission->id, null) }}
                    {{ $permission->name }}
                    <em>({{ $permission->guard_name ?: 'N/A' }})</em>
                </label>
            </li>
        @endforeach
    </ul>
</div>
