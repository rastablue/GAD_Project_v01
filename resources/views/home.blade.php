@extends('layouts.app')

@section('content')

<div class="container-fluid">


    <div class="col-md-12">
        <div class="row">
            <!-- Chart Pendientes -->
                <div class="col-lg-8">
                    <div class="card border-left-warning shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                        <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                                        Pendientes
                                    </div>
                                    <div style="width: 100%;margin: 0 auto;">
                                        {!! $pendientesChart->container() !!}
                                    </div>
                                    {!! $pendientesChart->script() !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            <!-- Charts Laterales -->
                <div class="col-lg-4 mb-4">
                    <!-- Chart Personas -->
                        <div class="card border-left-primary shadow h-100 py-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase ml-3">
                                <i class="fas fa-comments fa-2x text-gray-300"></i>
                                Personas
                            </div>
                            <div style="width: 65%;margin: -30% auto;">
                                {!! $personasChart->container() !!}
                            </div>
                            {!! $personasChart->script() !!}
                    <!-- Chart Maquinarias -->
                            <div class="text-xs font-weight-bold text-primary text-uppercase ml-3 mt-5">
                                <i class="fas fa-truck fa-2x text-gray-300"></i>
                                Maquinarias
                            </div>
                            <div style="width: 65%;margin: -30% auto;">
                                {!! $maquinariaChart->container() !!}
                            </div>
                            {!! $maquinariaChart->script() !!}
                        </div>
                </div>
        </div>
    </div>

</div>

@endsection
