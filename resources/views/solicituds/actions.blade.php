@can('tareas.create')
    @if ($estado != 'Reprobado' && $estado != 'Finalizado')
        <a href="{{ route('tareas.createfrom', Hashids::encode($id)) }}" class="btn btn-sm btn-success">
            <i class="fas fa-fw fa-plus"></i>
            Tarea
        </a>
    @else
        <button type="button" data-toggle="modal" data-observacion="{{ $observacion }}" data-detalle="{{ $detalle }}" data-target="#NoOptionModal" class="btn btn-success btn-sm">
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
    @if ($estado === 'Reprobado')
        <button type="button" data-toggle="modal" data-observacion="{{ $observacion }}" data-detalle="{{ $detalle }}" data-target="#NoOptionModal" class="btn btn-warning btn-sm">
            <i class="fas fa-fw fa-check-circle"></i>
            Revisar
        </button>
    @endif
    @if ($estado === 'Pendiente')
        @if (!$fecha_inicio)
            @php
                $fecha_inicio = 'No se ha asignado una fecha de inicio a esta solicitud. Aprobarla provocara que se asigne como fecha de inicio la fecha de la aprobacion.'
            @endphp
        @endif
        <button type="button" data-id="{{ $id }}" data-observacion="{{ $observacion }}" data-detalle="{{ $detalle }}" data-fecha_inicio="{{ $fecha_inicio }}"
         data-toggle="modal" data-target="#RevisaSolicitudModal" class="btn btn-warning btn-sm revisar" id="getActualizaId">
            <i class="fas fa-fw fa-check-circle"></i>
            Revisar
        </button>
    @endif
    @if ($estado === 'Aprobado')
        <button type="button" data-id="{{ $id }}" data-observacion="{{ $observacion }}" data-detalle="{{ $detalle }}" data-toggle="modal" data-target="#FinalizaSolicitudModal" class="btn btn-warning btn-sm revisar" id="getActualizaId">
            <i class="fas fa-fw fa-flag"></i>
            Concluir
        </button>
    @endif
    @if ($estado === 'Finalizado')
        <button type="button" data-toggle="modal" data-id="{{ $id }}" data-fecha="{{ $fecha_finalizacion }}" data-observacion="{{ $observacion }}" data-detalle="{{ $detalle }}" data-target="#FinalizadoModal" class="btn btn-warning btn-sm">
            <i class="fas fa-fw fa-check-circle"></i>
            Revisar
        </button>
    @endif
@endcan
@can('solicitudes.destroy')
    <button type="button" data-id="{{ $id }}" data-toggle="modal" data-target="#DeleteProductModal" class="btn btn-danger btn-sm" id="getDeleteId"><i class="fas fa-fw fa-trash"></i>Eliminar</button>
@endcan