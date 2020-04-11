@can('roles.show')
    <a href="{{ route('roles.show', Hashids::encode($id)) }}" class="btn btn-sm btn-info">
        <i class="fas fa-fw fa-eye"></i>
        Ver
    </a>
@endcan
@can('roles.edit')
    <a href="{{ route('roles.edit', Hashids::encode($id)) }}" class="btn btn-sm btn-warning">
        <i class="fas fa-fw fa-pen"></i>
        Editar
    </a>
@endcan
@can('roles.destroy')
<button type="button" data-id="{{ $id }}" data-toggle="modal" data-target="#DeleteProductModal" class="btn btn-danger btn-sm" id="getDeleteId"><i class="fas fa-fw fa-trash"></i>Eliminar</button>
@endcan
