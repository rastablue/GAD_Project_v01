<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>GAD Municipal</title>
    <link rel="shortcut icon" href="{{ asset('images/ico/favicon-16x16.png') }}">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <!-- DataTable -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>

    <!-- Custom fonts for this template-->
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">


    <!-- Custom styles for this template-->
    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/fotos.css') }}" rel="stylesheet">
</head>

<body id="page-top">

    <!-- Page Wrapper -->
        <div id="wrapper">

            <!-- Variables usadas para notificaciones, ejercicios etc -->
                @php
                    $notificaciones = 0;
                @endphp
                @if (isset($solicitud_notificacion))
                    @if ($solicitud_notificacion->count() > 0)
                        @php
                            $notificaciones += 1;
                        @endphp
                    @endif
                @else
                    @php
                        $solicitud_notificacion = 0;
                    @endphp
                @endif

                @if (isset($solicitud_vencida))
                    @if ($solicitud_vencida)
                        @php
                            $notificaciones += 1;
                        @endphp
                    @endif
                @else
                    @php
                        $solicitud_vencida = 0;
                    @endphp
                @endif

                @if (isset($requerimientos))
                    @if ($requerimientos->count() > 0)
                        @php
                            $notificaciones += 1;
                        @endphp
                    @endif
                @else
                    @php
                        $requerimientos = 0;
                    @endphp
                @endif

            <!-- Barra Lateral -->
                <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

                    <!-- SB Admin -->
                        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('home') }}">
                            <!--Para rotar un icono en fontAwesome se usa: rotate-n-15 en una etiqueta div que encierre la i-->
                            <div class="sidebar-brand-icon">
                                <i class="fas fa-landmark"></i>
                            </div>
                            <br>
                            <div class="sidebar-brand-text mx-3">{{ config('app.name', 'Laravel') }}</div>
                        </a>

                    <!-- Divider 
                        <hr class="sidebar-divider my-0">-->

                    <!-- Dashboard 
                        <li class="nav-item active">
                            <a class="nav-link" href="{{ route('home') }}">
                                <i class="fas fa-fw fa-tachometer-alt"></i>
                                <span>Dashboard</span></a>
                        </li>-->

                    <!-- Divider -->
                        <hr class="sidebar-divider">
                        <strong class="text-light ml-3">{{ Auth::user()->roles->first()->name }}</strong>
                        <hr class="sidebar-divider">

                    <!-- Actividades -->
                        @can('actividades')
                            <div class="sidebar-heading">
                                Actividades
                            </div>

                            <!-- Encargos -->
                                @can('actividades.encargos')
                                    <li class="nav-item">
                                        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseEncargos" aria-expanded="true" aria-controls="collapsePages">
                                            <i class="fas fa-fw fa-briefcase"></i>
                                            <span>Encargos</span>
                                        </a>
                                        <div id="collapseEncargos" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                                            <div class="bg-white py-2 collapse-inner rounded">
                                                @can('actividades.encargos.general')
                                                    <h6 class="collapse-header">General:</h6>
                                                    @can('actividades.encargos.general.solicitudes')
                                                        <a class="collapse-item" href="{{ route('solicituds.index') }}"><i class="fas fa-fw fa-folder"></i>  Solicitudes</a>
                                                    @endcan
                                                    @can('actividades.encargos.general.tareas')
                                                        <a class="collapse-item" href="{{ route('tareas.index') }}"><i class="fas fa-fw fa-file-alt"></i>  Requerimientos</a>
                                                    @endcan
                                                @endcan
                                                @can('actividades.encargos.asignaciones')
                                                    <div class="collapse-divider"></div>
                                                    <h6 class="collapse-header">Asignaciones:</h6>
                                                    <!--<a class="collapse-item" href="{{ route('asigna.create') }}"><i class="fas fa-fw fa-link"></i>  Asignar: Vehiculos</a>-->
                                                    <a class="collapse-item" href="{{ route('asignavehi.create') }}"><i class="fas fa-fw fa-link"></i>  Asignar: Operarios</a>
                                                @endcan
                                            </div>
                                        </div>
                                    </li>
                                @endcan

                            <!-- Mantenimientos -->
                                @can('actividades.mantenimientos')
                                    <li class="nav-item">
                                        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseMantenimientos" aria-expanded="true" aria-controls="collapsePages">
                                            <i class="fas fa-fw fa-road"></i>
                                            <span>Mantenimientos</span>
                                        </a>
                                        <div id="collapseMantenimientos" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                                            <div class="bg-white py-2 collapse-inner rounded">
                                                @can('actividades.mantenimientos.general')
                                                    <h6 class="collapse-header">General:</h6>
                                                    @can('actividades.mantenimientos.general.mantenimientos')
                                                        <a class="collapse-item" href="{{ route('mantenimientos.index') }}"><i class="fas fa-fw fa-ambulance"></i>  Mantenimientos</a>
                                                    @endcan
                                                    {{--@can('actividades.mantenimientos.general.trabajos')
                                                        <a class="collapse-item" href="{{ route('trabajos.index') }}"><i class="fas fa-fw fa-heart"></i>  Trabajos</a>
                                                    @endcan--}}
                                                @endcan

                                            </div>
                                        </div>
                                    </li>
                                @endcan

                            <!-- Divider -->
                                <hr class="sidebar-divider">
                        @endcan


                    <!-- Admin -->
                        @can('admin')
                            <div class="sidebar-heading">
                                Admin
                            </div>

                            <!-- Personas -->
                                @can('admin.personas')
                                    <li class="nav-item">
                                        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseAdmin" aria-expanded="true" aria-controls="collapsePages">
                                            <i class="fas fa-fw fa-user"></i>
                                            <span>Personas</span>
                                        </a>
                                        <div id="collapseAdmin" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                                            <div class="bg-white py-2 collapse-inner rounded">
                                                @can('admin.personas.administrativo')
                                                    <h6 class="collapse-header">Administrativo:</h6>
                                                    @can('admin.personas.administrativo.funcionarios')
                                                        <a class="collapse-item" href="{{ route('users.index') }}"><i class="fas fa-fw fa-user"></i>  Funcionarios Publicos</a>
                                                    @endcan
                                                    @can('admin.personas.administrativo.operarios')
                                                        <a class="collapse-item" href="{{ route('operarios.index') }}"><i class="fas fa-fw fa-id-card"></i>  Operarios</a>
                                                    @endcan
                                                @endcan
                                                @can('admin.personas.general')
                                                    <div class="collapse-divider"></div>
                                                    <h6 class="collapse-header">General:</h6>
                                                    @can('admin.personas.general.clientes')
                                                        <a class="collapse-item" href="{{ route('clientes.index') }}"><i class="fas fa-fw fa-address-book"></i>  Clientes</a>
                                                    @endcan
                                                @endcan
                                            </div>
                                        </div>
                                    </li>
                                @endcan

                            <!-- Maquinarias/Vehiculos -->
                                @can('admin.vehiculos')
                                    <li class="nav-item">
                                        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseVehiculos" aria-expanded="true" aria-controls="collapsePages">
                                            <i class="fas fa-fw fa-car"></i>
                                            <span>Vehiculos</span>
                                        </a>
                                        <div id="collapseVehiculos" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                                            <div class="bg-white py-2 collapse-inner rounded">
                                                @can('admin.vehiculos.administrativo')
                                                    <h6 class="collapse-header">Administrativo:</h6>
                                                    @can('admin.vehiculos.administrativo.maquinarias')
                                                        <a class="collapse-item" href="{{ route('maquinarias.index') }}"><i class="fas fa-fw fa-truck"></i>  Maquinarias</a>
                                                    @endcan
                                                @endcan
                                                @can('admin.vehiculos.general')
                                                    <div class="collapse-divider"></div>
                                                    <h6 class="collapse-header">General:</h6>
                                                    @can('admin.vehiculos.general.marcas')
                                                        <a class="collapse-item" href="{{ route('marcas.index') }}"><i class="fas fa-fw fa-trademark"></i>  Marcas</a>
                                                    @endcan
                                                @endcan
                                            </div>
                                        </div>
                                    </li>
                                @endcan

                            <!-- Roles Y Permisos -->
                                @can('roles.index')
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('roles.index') }}">
                                            <i class="fas fa-fw fa-key"></i>
                                            <span>Roles y Permisos</span></a>
                                    </li>
                                @endcan
                        @endcan

                    <!-- Divider -->
                        <hr class="sidebar-divider d-none d-md-block">

                    <!-- Sidebar Toggler (Sidebar) -->
                        <div class="text-center d-none d-md-inline">
                            <button class="rounded-circle border-0" id="sidebarToggle"></button>
                        </div>

                </ul>
            <!-- Fin Barra Lateral -->

            <!-- Contenido -->
                <div id="content-wrapper" class="d-flex flex-column">

                    <!-- Contenido principal -->
                        <div id="content">

                            <!-- Barra Superior -->
                                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                                    <!-- Sidebar Toggle (Topbar) -->
                                        <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                                            <i class="fa fa-bars"></i>
                                        </button>

                                    <!-- Topbar Navbar -->
                                        <ul class="navbar-nav ml-auto">

                                            
                                            <!-- Nav Item - Campana Notificaciones -->
                                                <li class="nav-item dropdown no-arrow">
                                                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        @if ($notificaciones >= 1)
                                                            <span class="badge badge-danger">{{$notificaciones}}</span>
                                                        @endif
                                                        <i class="fas fa-bell fa-2x"></i>
                                                    </a>

                                                    <!-- Dropdown - Opciones Del Usuario -->
                                                        @if ($notificaciones >= 1)
                                                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                                                @if (@$solicitud_notificacion !== 0)
                                                                    @if ($solicitud_notificacion->count() > 0)
                                                                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#pendientesModal">
                                                                            <i class="fas fa-fw fa-folder"></i>
                                                                            Hay <strong>{{$solicitud_notificacion->count()}}</strong> solicitudes pendientes de revision.
                                                                        </a>
                                                                        <div class="dropdown-divider"></div>
                                                                    @endif
                                                                @endif
                                                                @if ($solicitud_vencida)
                                                                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#vencerModal">
                                                                        <i class="fas fa-fw fa-folder"></i>
                                                                        Hay <strong>{{$solicitud_vencida}}</strong> solicitudes que se acercan a los 10<br>
                                                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; dias desde su ingreso y aun estan en estado<br>
                                                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; pendiente.
                                                                    </a>
                                                                    <div class="dropdown-divider"></div>
                                                                @endif
                                                                @if (@$requerimientos !== 0)
                                                                    @if (@$requerimientos->count() > 0)
                                                                        <a class="dropdown-item" href="{{ route('tareas.index') }}" target="_blank">
                                                                            <i class="fas fa-fw fa-file-alt"></i>
                                                                            Hay <strong>{{$requerimientos->count()}}</strong> requerimientos en estado pendiente.<br>
                                                                        </a>
                                                                    @endif
                                                                @endif
                                                            </div>
                                                        @else
                                                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                                                <a class="dropdown-item" href="#">
                                                                    <i class="fas fa-check-circle"></i>
                                                                    No hay notificaciones para mostrar.
                                                                </a>
                                                            </div>
                                                        @endif
                                                        
                                                </li>

                                            <!-- Nav Item - Informacion Del usuario -->
                                                <li class="nav-item dropdown no-arrow">
                                                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ Auth::user()->name }}  {{ Auth::user()->apellido_pater }}</span>
                                                        @if (Auth::user()->path)
                                                            <img class="img-profile rounded-circle" src="{{ Auth::user()->url_path }}" alt="Perfil">
                                                        @else
                                                            <div class="img-profile rounded-circle">
                                                                <i class="fas fa-user-tie fa-2x"></i>
                                                            </div>
                                                        @endif

                                                    </a>
                                                    <!-- Dropdown - Opciones Del Usuario -->
                                                        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                                            <a class="dropdown-item" href=" {{ route('profile.edit', Hashids::encode(Auth::user()->id)) }} ">
                                                                <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i> Profile
                                                            </a>
                                                            <div class="dropdown-divider"></div>
                                                            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                                                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                                                            Salir
                                                            </a>
                                                        </div>
                                                </li>

                                        </ul>

                                </nav>
                            <!-- Fin De La Barra Superior -->

                            <!-- Mensajes de notificacion -->
                                @if(session('info'))
                                    <div class="msg" style="z-index: 99 !important">
                                        <div class="container">
                                            <div class="row">
                                                <div class="col-md-10 offset-md-1">
                                                    <div class="alert alert-success">
                                                        {{ session('info') }}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                @if(session('danger'))
                                    <div class="msg" style="z-index: 99 !important">
                                        <div class="container">
                                            <div class="row">
                                                <div class="col-md-10 offset-md-1">
                                                    <div class="alert alert-danger">
                                                        {{ session('danger') }}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                @if(session('warning'))
                                    <div style="z-index: 99 !important">
                                        <div class="container">
                                            <div class="row">
                                                <div class="col-md-10 offset-md-1">
                                                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                                        {{ session('warning') }}
                                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                
                            <!-- Contenido interno de la pagina -->
                                <div class="container-fluid">

                                    @yield('content')

                                </div>
                            <!-- /.Fin del contenido interno -->

                            <!-- Contenido de tabla de la pagina -->
                                <div class="container-fluid">

                                    @yield('table')

                                </div>
                            <!-- /.Fin del contenido de tabla de la pagina -->

                            <!-- Contenido de estadisticas de la pagina -->
                                <div class="container-fluid">

                                    @yield('stats')

                                </div>
                            <!-- /.Fin del contenido de estadisticas de la pagina -->

                        </div>
                    <!-- Fin del Contenido Principal -->

                    <!-- Footer -->
                        <footer class="sticky-footer">
                            <div class="container my-auto">
                                <div class="copyright text-center my-auto">
                                    <span>Copyright &copy; GAD MUNICIPAL LAS NAVES 2020</span>
                                </div>
                            </div>
                        </footer>
                    <!-- End of Footer -->

                </div>
            <!-- Fin del Contenido -->

        </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
        <a class="scroll-to-top rounded" href="#page-top">
            <i class="fas fa-angle-up"></i>
        </a>

    <!-- Solicitudes Pendiente Modal-->
        <div class="modal fade" id="pendientesModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Solicitudes Pendientes</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body text-center">

                        @if ($solicitud_notificacion !== 0)
                            @foreach ($solicitud_notificacion as $item)
                                <a href="{{ route('solicituds.show', Hashids::encode($item->id)) }}" class="btn btn-sm btn-info my-1" target="_blank">
                                    <i class="fas fa-fw fa-eye"></i>
                                    {{ $item->codigo_solicitud }}
                                </a>
                            @endforeach
                        @endif

                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>

    <!-- Solicitudes por Vencer Modal-->
        <div class="modal fade" id="vencerModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Solicitudes mas Antiguas</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body text-center">

                        @php
                            $hoy = date("Y-m-d");
                        @endphp

                        @if (@App\Solicitud::where('estado', 'Pendiente')->get()->count() >= 1)
                            @php
                                $solicitud_notificacion = App\Solicitud::where('estado', 'Pendiente')->get();
                            @endphp
                            @foreach ($solicitud_notificacion as $item)
                                @php
                                    //restar la fecha de hoy de la fecha de emision de la solicitud
                                    $diff = abs(strtotime($hoy) - strtotime($item->fecha_emision));
                                    //convertir a años
                                    $years = floor($diff / (365*60*60*24));
                                    //convertir a meses
                                    $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
                                    //convertir a dias
                                    $days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));

                                    //comprobar si han pasado 8 dias de la emision
                                    $dias_pasados = floor($diff - $days);
                                    //convertir a años
                                    $years = floor($dias_pasados / (365*60*60*24));
                                    //convertir a meses
                                    $months = floor(($dias_pasados - $years * 365*60*60*24) / (30*60*60*24));
                                    //convertir a dias
                                    $dias_pasados = floor(($dias_pasados - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
                                @endphp
                                @if ($dias_pasados >= 8 || $months >= 1)
                                    <a href="{{ route('solicituds.show', Hashids::encode($item->id)) }}" class="btn btn-sm btn-info my-1" target="_blank">
                                        <i class="fas fa-fw fa-eye"></i>
                                        {{ $item->codigo_solicitud }}
                                    </a>
                                @endif
                            @endforeach
                        @endif

                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>

    <!-- Logout Modal-->
        <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">¿Desea Salir?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    </div>
                    <div class="modal-body">Seleccione "Salir" si esta seguro de que desea terminar esta sesion.</div>
                    <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
                    <a class="btn btn-primary" href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">Salir</a>
                    </div>
                </div>
            </div>
        </div>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>

        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

    <!-- Scripts -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <script type="text/javascript">
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            //Borra gradual mente el mensaje de session !info
            $(document).ready(function() {
                setTimeout(function() {
                    $(".msg").slideUp(2000);
                    },3000);
            });
        </script>

        <!-- App scripts -->
        @stack('scripts')

        <!-- Core plugin JavaScript-->
        <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>

        <!-- Custom scripts for all pages-->
        <script src="{{ asset('js/sb-admin-2.min.js') }}"></script>

        <!-- Page level custom scripts -->
        @stack('charts')

        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js" charset="utf-8"></script>

</body>
</html>
