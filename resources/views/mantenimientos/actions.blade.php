@can('trabajos.create')
    <a href="{{ route('trabajos.createfrom', Hashids::encode($id)) }}" class="btn btn-sm btn-success">
        <i class="fas fa-fw fa-plus"></i>
        Trabajo
    </a>
@endcan
@can('mantenimientos.show')
    <a href="{{ route('mantenimientos.show', Hashids::encode($id)) }}" class="btn btn-sm btn-info">
        <i class="fas fa-fw fa-eye"></i>
        Ver
    </a>
@endcan
@can('mantenimientos.edit')
    <a href="{{ route('mantenimientos.edit', Hashids::encode($id)) }}" class="btn btn-sm btn-warning">
        <i class="fas fa-fw fa-pen"></i>
        Editar
    </a>
@endcan
@can('mantenimientos.destroy')
    <button type="button" data-id="{{ $id }}" data-toggle="modal" data-target="#DeleteProductModal" class="btn btn-danger btn-sm" id="getDeleteId"><i class="fas fa-fw fa-trash"></i>Eliminar</button>
@endcan
