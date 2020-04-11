{!! Form::model(['route' => 'roles.store']) !!}

<div class="form-group">
    {{ Form::label('name', 'Nombre') }}
    {{ Form::text('name', null, ['class' => 'form-control']) }}
</div>
{{-- Guard --}}
<input id="guard_name" type="hidden" name="guard_name" value="web">
