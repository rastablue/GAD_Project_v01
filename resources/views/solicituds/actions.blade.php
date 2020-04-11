@can('tareas.create')
    <a href="{{ route('tareas.createfrom', Hashids::encode($id)) }}" class="btn btn-sm btn-success">
        <i class="fas fa-fw fa-plus"></i>
        Tarea
    </a>
@endcan
@can('solicitudes.show')
    <a href="{{ route('solicituds.show', Hashids::encode($id)) }}" class="btn btn-sm btn-info">
        <i class="fas fa-fw fa-eye"></i>
        Ver
    </a>
@endcan
@can('solicitudes.edit')
    <a href="{{ route('solicituds.edit', Hashids::encode($id)) }}" class="btn btn-sm btn-warning">
        <i class="fas fa-fw fa-pen"></i>
        Editar
    </a>
@endcan
@can('solicitudes.destroy')
    <button type="button" data-id="{{ $id }}" data-toggle="modal" data-target="#DeleteProductModal" class="btn btn-danger btn-sm" id="getDeleteId"><i class="fas fa-fw fa-trash"></i>Eliminar</button>
@endcan
