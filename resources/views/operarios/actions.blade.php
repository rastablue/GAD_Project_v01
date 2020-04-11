@can('operarios.show')
    <a href="{{ route('operarios.show', Hashids::encode($id)) }}" class="btn btn-sm btn-info">
        <i class="fas fa-fw fa-eye"></i>
        Ver
    </a>
@endcan
@can('operarios.edit')
    <a href="{{ route('operarios.edit', Hashids::encode($id)) }}" class="btn btn-sm btn-warning">
        <i class="fas fa-fw fa-pen"></i>
        Editar
    </a>
@endcan
{{--@can('operarios.edit')
    <button type="button" data-id="{{ $id }}" data-toggle="modal" data-target="#EditOperarioModal" class="btn btn-danger btn-sm" id="getEditId"><i class="fas fa-fw fa-trash"></i>Prueba</button>
@endcan--}}
@can('operarios.destroy')
    <button type="button" data-id="{{ $id }}" data-toggle="modal" data-target="#DeleteProductModal" class="btn btn-danger btn-sm" id="getDeleteId"><i class="fas fa-fw fa-trash"></i>Eliminar</button>
@endcan
