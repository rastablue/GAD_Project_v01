@can('tareas.create')
    @if ($estado != 'Reprobado')
        <a href="{{ route('tareas.createfrom', Hashids::encode($id)) }}" class="btn btn-sm btn-success">
            <i class="fas fa-fw fa-plus"></i>
            Tarea
        </a>
    @else
        <button type="button" data-toggle="modal" data-target="#NoOptionModal" class="btn btn-success btn-sm">
            <i class="fas fa-fw fa-plus"></i>
            Tarea
        </button>
    @endif
@endcan
@can('solicitudes.show')
    <a href="{{ route('solicituds.show', Hashids::encode($id)) }}" class="btn btn-sm btn-info">
        <i class="fas fa-fw fa-eye"></i>
        Ver
    </a>
@endcan
@can('solicitudes.revision')
    @if ($estado != 'Reprobado')
        <button type="button" data-id="{{ $id }}" data-toggle="modal" data-target="#RevisaSolicitudModal" class="btn btn-warning btn-sm" id="getActualizaId">
            <i class="fas fa-fw fa-check-circle"></i>
            Revisar
        </button>
    @else
        <button type="button" data-toggle="modal" data-target="#NoOptionModal" class="btn btn-warning btn-sm">
            <i class="fas fa-fw fa-check-circle"></i>
            Revisar
        </button>
    @endif
    
@endcan
@can('solicitudes.destroy')
    <button type="button" data-id="{{ $id }}" data-toggle="modal" data-target="#DeleteProductModal" class="btn btn-danger btn-sm" id="getDeleteId"><i class="fas fa-fw fa-trash"></i>Eliminar</button>
@endcan
