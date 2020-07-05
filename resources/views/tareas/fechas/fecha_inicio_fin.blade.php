@extends('layouts.app')

@section('content')

<form id="formAgregarCliente" method="POST" action="{{ route('tareas.updatefechasiniciofin', $tarea->id) }}">
    @method('PUT')
    @csrf
    <div class="row justify-content-center">
        <div class="col-md-8">
            <!-- Formulario Cliente -->
                <div class="card shadow mb-4">

                    <!-- Card Header - Accordion -->
                        <a href="#collapseCardExampl" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
                            <h6 class="m-0 font-weight-bold text-primary">Asignacion de Fechas del requerimiento:
                                <h6 class="m-0 font-weight-bold text-dark">
                                    {{ $tarea->fake_id }}
                                </h6>
                            </h6>
                        </a>

                    <!-- Card Content - Collapse -->
                        <div class="collapse show" id="collapseCardExample">
                            <div class="card-body">
                                <div class="text-center">
                                    <em>Por favor, seleccione las fechas de inicio y de fin del requerimiento<br><br></em>
                                </div>

                                <!-- Fechas -->
                                    <div class="form-row">
                                        <div class="col-md-6 mb-3">
                                            <label for="validationCustom01">Fecha Inicio</label>
                                            <input type="date" name="fecha_inicio" class="form-control @error('fecha_inicio') is-invalid @enderror" value="{{ $fecha_inicio ?? old('fecha_inicio') }}" autocomplete="Fecha inicio" autofocus>
                                        
                                            @error('fecha_inicio')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label for="validationCustom02">Fecha Fin</label>
                                            <input type="date" name="fecha_fin" class="form-control @error('fecha_fin') is-invalid @enderror" value="{{ $fecha_fin ?? old('fecha_fin') }}" autocomplete="Fecha fin" autofocus>
                                        
                                            @error('fecha_fin')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                <!-- Botones -->
                                    <a href="javascript:history.back()" class="btn btn-secondary mt-3">Volver</a>
                                    <button type="submit" form="formAgregarCliente" id="submitBtn" class="btn btn-primary mt-3">Aceptar</button>

                            </div>
                        </div>

                </div>
        </div>
    </div>
</form>
<script>
    function mayus(e) {
        e.value = e.value.toUpperCase();
    }
</script>
@endsection
