@can('mantenimientos.create')
    <a href="{{ route('mantenimientos.createfrom', Hashids::encode($id)) }}" class="btn btn-sm btn-success">
        <i class="fas fa-fw fa-plus"></i>
        Mantenimiento
    </a>
@endcan
@can('maquinarias.show')
    <a href="{{ route('maquinarias.show', Hashids::encode($id)) }}" class="btn btn-sm btn-info">
        <i class="fas fa-fw fa-eye"></i>
        Ver
    </a>
@endcan
@can('maquinarias.edit')
    <a href="{{ route('maquinarias.edit', Hashids::encode($id)) }}" class="btn btn-sm btn-warning">
        <i class="fas fa-fw fa-pen"></i>
        Editar
    </a>
@endcan
@can('maquinarias.destroy')
    <button type="button" data-id="{{ $id }}" data-toggle="modal" data-target="#DeleteProductModal" class="btn btn-danger btn-sm" id="getDeleteId">
        <i class="fas fa-fw fa-trash"></i>
        Eliminar
    </button>
@endcan
