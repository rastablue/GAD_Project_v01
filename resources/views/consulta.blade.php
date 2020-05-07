@extends('layouts.appOption')

@section('content')
    <div>

        <div class="container">

            <!-- Outer Row -->
            <div class="row justify-content-center">
        
                <div class="col-xl-10 col-lg-12 col-md-9">
        
                    <div class="card">
                        <div class="row mt-3 mb-3 ml-2 mr-2">
                            {{-- Menu de opciones --}}
                                <div class="col-3">
        
                                    <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                        <a class="nav-link active" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true">Solicitud</a>
                                        <a class="nav-link" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false">Solicitante</i></a>
                                        <a class="nav-link" id="v-pills-cliente-tab" data-toggle="pill" href="#v-pills-cliente" role="tab" aria-controls="v-pills-cliente" aria-selected="true">Requerimientos</a>
                                        <a href="javascript:history.back()" class="btn btn-dark mt-5">Realizar otra consulta..</a>
                                    </div>
        
        
                                </div>
        
                            {{-- Container de opciones --}}
                                <div class="card-body col-9">
                                    <div class="tab-content" id="v-pills-tabContent">
                                        {{-- Solicituds --}}
                                            <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
    
                                                {{-- Codigo --}}
                                                    <div class="form-group row">
                                                        <label for="codigo" class="col-md-4 col-form-label text-md-right">Codigo</label>
                                                        <div class="col-md-6">
                                                            <input id="codigo" type="text" class="form-control" disabled value=" {{ $solicitud->codigo_solicitud }} " name="codigo" required autocomplete="Codigo" autofocus>
                                                        </div>
                                                    </div>

                                                {{-- Fecha Emision --}}
                                                    <div class="form-group row">
                                                        <label for="codigo" class="col-md-4 col-form-label text-md-right">Fecha de Emision</label>
                                                        <div class="col-md-6">
                                                            <input id="codigo" type="text" class="form-control" disabled value=" {{ $solicitud->fecha_emision }} " name="codigo" required autocomplete="Codigo" autofocus>
                                                        </div>
                                                    </div>

                                                {{-- Fecha Revision --}}
                                                    <div class="form-group row">
                                                        <label for="codigo" class="col-md-4 col-form-label text-md-right">Fecha de Revision</label>
                                                        <div class="col-md-6">
                                                            <input id="codigo" type="text" class="form-control" disabled value=" {{ $solicitud->fecha_revision }} " name="codigo" required autocomplete="Codigo" autofocus>
                                                        </div>
                                                    </div>

                                                {{-- Funcionario que la creo --}}
                                                    <div class="form-group row">
                                                        <label for="codigo" class="col-md-4 col-form-label text-md-right">Funcionario contribuyente</label>
                                                        <div class="col-md-6">
                                                            <input id="codigo" type="text" class="form-control" disabled value="{{ $solicitud->users->name }}  {{ $solicitud->users->apellido_pater }}" name="codigo" required autocomplete="Codigo" autofocus>
                                                        </div>
                                                    </div>

                                                {{-- Detalle --}}
                                                    <div class="form-group row">
                                                        <label for="detalle" class="col-md-4 col-form-label text-md-right">Detalle</label>
                                                        <div class="col-md-6">
                                                            <textarea id="detalle" type="text" class="form-control" disabled placeholder=" {{ $solicitud->detalle }}" name="detalle" required autocomplete="detalle" autofocus></textarea>
                                                        </div>
                                                    </div>

                                                {{-- Observacion --}}
                                                    <div class="form-group row">
                                                        <label for="detalle" class="col-md-4 col-form-label text-md-right">Observacion</label>
                                                        <div class="col-md-6">
                                                            <textarea id="obsservacion" type="text" class="form-control" disabled placeholder=" {{ $solicitud->observacion }}" name="observacion"></textarea>
                                                        </div>
                                                    </div>

                                                {{-- Estado --}}
                                                    <div class="form-group row">
                                                        <label for="codigo" class="col-md-4 col-form-label text-md-right">Estado Solicitud</label>
                                                        <div class="col-md-6">
                                                            @if (@$solicitud->estado == 'Aprobado')
                                                                <input id="codigo" type="text" class="form-control bg-success text-light" disabled value="{{ $solicitud->estado }}" name="codigo" required autocomplete="Codigo" autofocus>
                                                            @endif
                                                            @if (@$solicitud->estado == 'Reprobado')
                                                                <input id="codigo" type="text" class="form-control bg-danger text-light" disabled value="{{ $solicitud->estado }}" name="codigo" required autocomplete="Codigo" autofocus>
                                                            @endif
                                                            @if (@$solicitud->estado == 'Pendiente')
                                                                <input id="codigo" type="text" class="form-control bg-info text-light" disabled value="{{ $solicitud->estado }}" name="codigo" required autocomplete="Codigo" autofocus>
                                                            @endif
                                                        </div>
                                                    </div>
    
                                            </div>
    
                                        {{-- Solicitante --}}
                                            <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
    
                                                {{-- Cedula --}}
                                                    <div class="form-group row">
                                                        <label for="codigo" class="col-md-4 col-form-label text-md-right">Cedula del solicitante</label>
                                                        <div class="col-md-6">
                                                            <input id="codigo" type="text" class="form-control" disabled value="{{ $solicitud->clientes->cedula }}" name="codigo" required autocomplete="Codigo" autofocus>
                                                        </div>
                                                    </div>

                                                {{-- Nombre--}}
                                                    <div class="form-group row">
                                                        <label for="codigo" class="col-md-4 col-form-label text-md-right">Nombre del solicitante</label>
                                                        <div class="col-md-6">
                                                            <input id="codigo" type="text" class="form-control" disabled value="{{ $solicitud->clientes->name }} {{ $solicitud->clientes->apellido_pater }} {{ $solicitud->clientes->apellido_mater }}" name="codigo" required autocomplete="Codigo" autofocus>
                                                        </div>
                                                    </div>

                                                {{-- Direccion --}}
                                                    <div class="form-group row">
                                                        <label for="direc" class="col-md-4 col-form-label text-md-right">Direccion</label>

                                                        <div class="col-md-6">
                                                            <input id="direc" type="text" class="form-control" disabled value="{{ $solicitud->clientes->direc }}" name="direc" required autofocus>
                                                        </div>
                                                    </div>

                                                {{-- Telefono --}}
                                                    <div class="form-group row">
                                                        <label for="tlf" class="col-md-4 col-form-label text-md-right">Telefono</label>

                                                        <div class="col-md-6">
                                                            <input id="tlf" type="text" class="form-control" disabled value="{{ $solicitud->clientes->tlf }}" name="tlf" required autofocus>
                                                        </div>
                                                    </div>

                                                {{-- Email --}}
                                                    <div class="form-group row">
                                                        <label for="email" class="col-md-4 col-form-label text-md-right">E-Mail Address</label>

                                                        <div class="col-md-6">
                                                            <input id="email" type="email" class="form-control" disabled value="{{ $solicitud->clientes->email }}" name="email" required autofocus>
                                                        </div>
                                                    </div>
    
                                            </div>
    
                                        {{-- Requerimientos --}}
                                            <div class="tab-pane fade" id="v-pills-cliente" role="tabpanel" aria-labelledby="v-pills-cliente-tab">
                                                <div id="accordion">
                                                @if(@$solicitud->tareas->first())
                                                    @foreach (@App\Solicitud::findOrFail($solicitud->id)->tareas as $item)

                                                        <div class="col-lg-12">
                                                            <div class="card shadow mb-4">
                                                                    
                                                                <div class="card">
                                                                    <div class="card-header" id="headingOne">
                                                                        <h5 class="font-weight-bold text-primary">
                                                                            <button class="btn btn-link btn-sm" data-toggle="collapse" data-target="#collapseOne{{ $loop->iteration }}" aria-expanded="true" aria-controls="collapseOne">
                                                                                Datos del Requerimiento:
                                                                                <h6 class="mb-0 font-weight-bold text-dark">
                                                                                    <i>{{ $item->fake_id}}</i>
                                                                                </h6>
                                                                            </button>
                                                                        </h5>
                                                                    </div>
                                                                
                                                                    <div id="collapseOne{{ $loop->iteration }}" class="collapse hide" aria-labelledby="headingOne" data-parent="#accordion">
                                                                        <div class="card-body">
                                                                            {{-- Codigo Tarea --}}
                                                                                <div class="form-group row">
                                                                                    <label for="codigo" class="col-md-4 col-form-label text-md-right">Codigo Requerimiento</label>
                                                                                    <div class="col-md-6">
                                                                                        <input type="input" disabled value="{{ $item->fake_id }}" class="form-control" required autocomplete="Fecha inicio" autofocus>
                                                                                    </div>
                                                                                </div>

                                                                            {{-- Fecha Inicio --}}
                                                                                <div class="form-group row">
                                                                                    <label for="codigo" class="col-md-4 col-form-label text-md-right">Fecha de Inicio</label>
                                                                                    <div class="col-md-6">
                                                                                        <input type="input" disabled value="{{ $item->fecha_inicio }}" class="form-control" required autocomplete="Fecha inicio" autofocus>
                                                                                    </div>
                                                                                </div>

                                                                            {{-- Fecha Fin --}}
                                                                                <div class="form-group row">
                                                                                    <label for="codigo" class="col-md-4 col-form-label text-md-right">Fecha de Fin</label>
                                                                                    <div class="col-md-6">
                                                                                        <input type="input" disabled value="{{ $item->fecha_fin }}" class="form-control" required autocomplete="Fecha fin" autofocus>
                                                                                    </div>
                                                                                </div>

                                                                            {{-- Direccion --}}
                                                                                <div class="form-group row">
                                                                                    <label for="detalle" class="col-md-4 col-form-label text-md-right">Direccion</label>
                                                                                    <div class="col-md-6">
                                                                                        <textarea type="text" disabled class="form-control" required autocomplete="direccion" autofocus> {{ $item->direc_tarea }} </textarea>
                                                                                    </div>
                                                                                </div>

                                                                            {{-- Detalle --}}
                                                                                <div class="form-group row">
                                                                                    <label for="detalle" class="col-md-4 col-form-label text-md-right">Detalle</label>
                                                                                    <div class="col-md-6">
                                                                                        <textarea type="text" disabled class="form-control" required autocomplete="detalle" autofocus> {{ $item->detalle }} </textarea>
                                                                                    </div>
                                                                                </div>

                                                                            {{-- Observacion --}}
                                                                                <div class="form-group row">
                                                                                    <label for="detalle" class="col-md-4 col-form-label text-md-right">Observacion</label>
                                                                                    <div class="col-md-6">
                                                                                        <textarea type="text" disabled class="form-control" required autocomplete="detalle" autofocus> {{ $item->observacion }} </textarea>
                                                                                    </div>
                                                                                </div>

                                                                            {{-- Estado --}}
                                                                                <div class="form-group row">
                                                                                    <label for="codigo" class="col-md-4 col-form-label text-md-right">Estado</label>
                                                                                    <div class="col-md-6">
                                                                                        <input type="input" disabled value="{{ $item->estado }}" class="form-control" required autocomplete="Fecha fin" autofocus>
                                                                                    </div>
                                                                                </div>

                                                                            {{-- Vehiculos asignados --}}
                                                                                @if (@$item->maquinarias)
                                                                                    <div class="text-center">
                                                                                        <em>Se ha asignado {{ $item->maquinarias->count() }} maquinaria(s) a esta tarea</em><br><br>
                                                                                    </div>
                                                                                @else
                                                                                    <div class="text-center">
                                                                                        <em>No se han asignado maquinarias a esta tarea</em><br><br>
                                                                                    </div>
                                                                                @endif
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                        
                                                            </div>
                                                        </div>

                                                    @endforeach
                                                    </div>
                                                @endif
    
                                            </div>
                                    </div>
                                </div>
                        </div>
                    </div>
        
                </div>
        
            </div>
        
        </div>
    </div>
  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>
  <script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    //Borra gradual mente el mensaje de session !info
    $(document).ready(function() {
        setTimeout(function() {
            $(".msg").slideUp(700);
            },4000);
    });
</script>

@endsection
