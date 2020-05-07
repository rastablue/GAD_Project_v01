@extends('layouts.app')

@section('content')

<form id="formAgregarCliente" method="GET" action="{{ route('mantenimientos.reporteselectapply') }}">
    @csrf
    <div class="row justify-content-center">
        <div class="col-md-8">
            <!-- Formulario Cliente -->
                <div class="card shadow mb-4">

                    <!-- Card Header - Accordion -->
                        <a href="#collapseCardExampl" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
                            <h6 class="m-0 font-weight-bold text-primary">Filtro de Reportes</h6>
                        </a>

                    <!-- Card Content - Collapse -->
                        <div class="collapse show" id="collapseCardExample">
                            <div class="card-body">
                                <div class="text-center">
                                    <em>Por favor, seleccione las fechas entre las que desea consultar<br><br></em>
                                </div>

                                <!-- Fechas -->
                                    <div class="form-row">
                                        <div class="col-md-6 mb-3">
                                            <label for="validationCustom01">Fecha Inicio</label>
                                            <input type="date" class="form-control" name="fecha_inicio" required>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="validationCustom02">Fecha Fin</label>
                                            <input type="date" class="form-control" name="fecha_fin" required>
                                        </div>
                                    </div>

                                <!-- Radio buttons -->
                                    <div class="my-3">
                                        <div class="custom-control custom-radio">
                                            <input type="radio" id="customRadio1" name="customRadio" class="custom-control-input" value="1" required>
                                            <label class="custom-control-label" for="customRadio1">Todos los registros</label>
                                        </div>
                                        <div class="custom-control custom-radio">
                                            <input type="radio" id="customRadio2" name="customRadio" class="custom-control-input" value="2" required>
                                            <label class="custom-control-label" for="customRadio2">Mantenimientos activos</label>
                                        </div>
                                        <div class="custom-control custom-radio">
                                            <input type="radio" id="customRadio3" name="customRadio" class="custom-control-input" value="3" required>
                                            <label class="custom-control-label" for="customRadio3">Mantenimientos en espera</label>
                                        </div>
                                        <div class="custom-control custom-radio">
                                            <input type="radio" id="customRadio4" name="customRadio" class="custom-control-input" value="4" required>
                                            <label class="custom-control-label" for="customRadio4">Mantenimientos finalizados</label>
                                        </div>
                                        <div class="custom-control custom-radio">
                                            <input type="radio" id="customRadio5" name="customRadio" class="custom-control-input" value="5" required>
                                            <label class="custom-control-label" for="customRadio5">Mantenimientos inactivos</label>
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
