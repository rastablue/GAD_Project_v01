@can('trabajos.show')
    <a href="{{ route('trabajos.show', Hashids::encode($id)) }}" class="btn btn-sm btn-info">
        <i class="fas fa-fw fa-eye"></i>
        Ver
    </a>
@endcan
@can('trabajos.revision')
    @if ($estado != 'Finalizado')
        <button type="button" data-id="{{ $id }}" data-manobra="{{ $manobra }}" data-diagnostico="{{ $diagnostico }}" data-toggle="modal" data-target="#RevisaTareaModal" class="btn btn-warning btn-sm" id="getActualizaId">
            <i class="fas fa-fw fa-check-circle"></i>
            Revisar
        </button>
    @else
        <button type="button" data-toggle="modal" data-manobra="{{ $manobra }}" data-diagnostico="{{ $diagnostico }}" data-target="#NoOptionModal" class="btn btn-warning btn-sm">
            <i class="fas fa-fw fa-check-circle"></i>
            Revisar
        </button>
    @endif
@endcan
@can('trabajos.destroy')
    <button type="button" data-id="{{ $id }}" data-toggle="modal" data-target="#DeleteProductModal" class="btn btn-danger btn-sm" id="getDeleteId"><i class="fas fa-fw fa-trash"></i>Eliminar</button>
@endcan
