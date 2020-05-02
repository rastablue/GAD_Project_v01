<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::post('consultas', 'LogoutController@consulta')->name('consultas');

Route::middleware(['auth'])->group(function(){

    //Roles

        Route::post('roles/store', 'RoleController@store')->name('roles.store')
                    ->middleware('can:roles.create');

        Route::get('roles', 'RoleController@index')->name('roles.index')
                    ->middleware('can:roles.index');

        Route::get('get-roles', 'RoleController@roleData')->name('datatables.roles')
                    ->middleware('can:roles.index');

        Route::get('roles/create', 'RoleController@create')->name('roles.create')
                    ->middleware('can:roles.create');

        Route::put('roles/{role}', 'RoleController@update')->name('roles.update')
                    ->middleware('can:roles.edit');

        Route::get('roles/{role}', 'RoleController@show')->name('roles.show')
                    ->middleware('can:roles.show');

        Route::delete('roles/{role}', 'RoleController@destroy')->name('roles.destroy')
                    ->middleware('can:roles.destroy');

        Route::get('roles/{role}/edit', 'RoleController@edit')->name('roles.edit')
                    ->middleware('can:roles.edit');

    //Users

        Route::get('descargar-users', 'UserController@reportes')->name('users.reportes')
                    ->middleware('can:users.show');

        Route::post('users/store', 'UserController@store')->name('users.store')
                    ->middleware('can:users.create');

        Route::get('users', 'UserController@index')->name('users.index')
                    ->middleware('can:users.index');

        Route::get('get-users', 'UserController@userData')->name('datatables.users')
                    ->middleware('can:users.index');

        Route::get('users/create', 'UserController@create')->name('users.create')
                    ->middleware('can:users.create');

        Route::put('users/{user}', 'UserController@update')->name('users.update')
                    ->middleware('can:users.edit');

        Route::put('update/{user}', 'UserController@updatepass')->name('pass.update');

        Route::get('users/{user}', 'UserController@show')->name('users.show')
                    ->middleware('can:users.show');

        Route::delete('users/{user}', 'UserController@destroy')->name('users.destroy')
                    ->middleware('can:users.destroy');

        Route::get('users/{user}/edit', 'UserController@edit')->name('users.edit')
                    ->middleware('can:users.edit');

        Route::get('profile/{user}', 'UserController@updateProfile')->name('profile.edit');

    //Clientes

        Route::get('descargar-clientes', 'ClienteController@reportes')->name('clientes.reportes')
                        ->middleware('can:clientes.show');

        Route::post('clientes/store', 'ClienteController@store')->name('clientes.store')
                        ->middleware('can:clientes.create');

        Route::get('clientes', 'ClienteController@index')->name('clientes.index')
                        ->middleware('can:clientes.index');

        Route::get('get-clientes', 'ClienteController@clienteData')->name('datatables.clientes')
                        ->middleware('can:clientes.index');

        Route::get('clientes/create', 'ClienteController@create')->name('clientes.create')
                        ->middleware('can:clientes.create');

        Route::put('clientes/{cliente}', 'ClienteController@update')->name('clientes.update')
                        ->middleware('can:clientes.edit');

        Route::get('clientes/{cliente}', 'ClienteController@show')->name('clientes.show')
                        ->middleware('can:clientes.show');

        Route::delete('clientes/{cliente}', 'ClienteController@destroy')->name('clientes.destroy')
                        ->middleware('can:clientes.destroy');

        Route::get('clientes/{cliente}/edit', 'ClienteController@edit')->name('clientes.edit')
                        ->middleware('can:clientes.edit');

    //Operarios

        Route::get('descargar-operarios', 'OperarioController@reportes')->name('operarios.reportes')
                        ->middleware('can:operarios.show');

        Route::get('descargar-operarios/{operario}', 'OperarioController@pdf')->name('operarios.pdf');

        Route::post('operarios/store', 'OperarioController@store')->name('operarios.store')
                        ->middleware('can:operarios.create');

        /*El boton agregar, de la vista tareas.show envia a esta ruta y luego es redirigido a la vista asignaciones.update
        con el id de la tarea y el total de las maquinarias para que puedan ser inspeccionadas*/
        Route::get('asignacionvehiculo/{asigna}/edit', 'OperarioController@asigna')->name('asignavehi.edit')
                        ->middleware('can:actividades.encargos.asignaciones');

        /*El formulario de la vista asignaciones.update envia a esta ruta los datos de la tarea y los vehiculos seleccionados
        mediante un array para actualizar los vehiculos asignados a una tarea*/
        Route::post('asignacionvehiculo/{asigna}/store', 'OperarioController@asignaStore')->name('asignavehi.store')
                        ->middleware('can:actividades.encargos.asignaciones');

        //Abre el formulario de asignaciones desde el menu lateral, redirige a la vista asignaciones.create
        Route::get('asignacionvehiculo/create', 'OperarioController@asignaCreate')->name('asignavehi.create')
                        ->middleware('can:actividades.encargos.asignaciones');

        //Almacena la informacion del formulario de la vista asignaciones.create
        Route::post('asignacionvehiculo/storecode', 'OperarioController@asignaStoreCode')->name('asignavehi.storecode')
                        ->middleware('can:actividades.encargos.asignaciones');

        Route::get('operarios', 'OperarioController@index')->name('operarios.index')
                        ->middleware('can:operarios.index');

        Route::get('get-operarios', 'OperarioController@operarioData')->name('datatables.operarios')
                        ->middleware('can:operarios.index');

        Route::get('operarios/create', 'OperarioController@create')->name('operarios.create')
                        ->middleware('can:operarios.create');

        Route::put('operarios/{operario}', 'OperarioController@update')->name('operarios.update')
                        ->middleware('can:operarios.edit');

        Route::get('operarios/{operario}', 'OperarioController@show')->name('operarios.show')
                        ->middleware('can:operarios.show');

        Route::delete('operarios/{operario}', 'OperarioController@destroy')->name('operarios.destroy')
                        ->middleware('can:operarios.destroy');

        Route::get('operarios/{operario}/edit', 'OperarioController@edit')->name('operarios.edit')
                        ->middleware('can:operarios.edit');

    //Solicituds

        Route::get('descargar-solicituds', 'SolicitudController@reportes')->name('solicituds.reportes')
                        ->middleware('can:solicitudes.show');

        Route::get('descargar-solicituds/{solicitud}', 'SolicitudController@pdf')->name('solicituds.pdf');

        Route::post('solicituds/store', 'SolicitudController@store')->name('solicituds.store')
                        ->middleware('can:solicitudes.create');

        Route::post('solicituds/clientestore', 'SolicitudController@clienteStore')->name('solicituds.clientestore')
                        ->middleware('can:solicitudes.create');

        Route::get('solicituds', 'SolicitudController@index')->name('solicituds.index')
                        ->middleware('can:solicitudes.index');

        Route::get('get-solicituds', 'SolicitudController@solicitudData')->name('datatables.solicituds')
                        ->middleware('can:solicitudes.index');

        Route::get('solicituds/createcliente', 'SolicitudController@createCliente')->name('solicituds.createcliente')
                        ->middleware('can:solicitudes.create');

        Route::get('solicituds/create', 'SolicitudController@create')->name('solicituds.create')
                        ->middleware('can:solicitudes.create');

        Route::put('solicituds/{solicitud}', 'SolicitudController@update')->name('solicituds.update')
                        ->middleware('can:solicitudes.edit');

        Route::get('solicituds/{solicitud}', 'SolicitudController@show')->name('solicituds.show')
                        ->middleware('can:solicitudes.show');

        Route::delete('solicituds/{solicitud}', 'SolicitudController@destroy')->name('solicituds.destroy')
                        ->middleware('can:solicitudes.destroy');

        Route::get('solicituds/{solicitud}/edit', 'SolicitudController@edit')->name('solicituds.edit')
                        ->middleware('can:solicitudes.edit');

        ///Aprobar o Reprobar solicitudes
        Route::put('solicituds/aprobar/{solicitud}', 'SolicitudController@aprobar')->name('solicituds.aprobar')
                        ->middleware('can:solicitudes.edit');

        Route::put('solicituds/reprobar/{solicitud}', 'SolicitudController@reprobar')->name('solicituds.reprobar')
                        ->middleware('can:solicitudes.edit');

    //Tareas

        Route::get('descargar-tareas', 'TareaController@reportes')->name('tareas.reportes')
                        ->middleware('can:tareas.show');

        Route::post('tareas/store', 'TareaController@store')->name('tareas.store')
                        ->middleware('can:tareas.create');

        Route::post('tareas/storefrom', 'TareaController@storeFrom')->name('tareas.storefrom')
                        ->middleware('can:tareas.create');

        //Boton de solicitudes.show para agregar nuevas tareas a dicha solicitud, envia el id de la solicitud
        Route::get('tareas/{tarea}/createFrom', 'TareaController@createFrom')->name('tareas.createfrom')
                        ->middleware('can:tareas.show');

        Route::get('tareas', 'TareaController@index')->name('tareas.index')
                        ->middleware('can:tareas.index');

        Route::get('get-tareas', 'TareaController@tareaData')->name('datatables.tareas')
                        ->middleware('can:tareas.index');

        Route::get('tareas/create', 'TareaController@create')->name('tareas.create')
                        ->middleware('can:tareas.create');

        Route::put('tareas/{tarea}', 'TareaController@update')->name('tareas.update')
                        ->middleware('can:tareas.edit');

        Route::get('tareas/{tarea}', 'TareaController@show')->name('tareas.show')
                        ->middleware('can:tareas.show');

        Route::delete('tareas/{tarea}', 'TareaController@destroy')->name('tareas.destroy')
                        ->middleware('can:tareas.destroy');

        Route::get('tareas/{tarea}/edit', 'TareaController@edit')->name('tareas.edit')
                        ->middleware('can:tareas.edit');

        ///Aprobar o Reprobar solicitudes
        Route::put('tareas/abandonar/{tarea}', 'TareaController@abandonar')->name('tareas.aabandonar')
                        ->middleware('can:tareas.edit');

        Route::put('tareas/proceso/{tarea}', 'TareaController@proceso')->name('tareas.proceso')
                        ->middleware('can:tareas.edit');

        Route::put('tareas/finalizar/{tarea}', 'TareaController@finalizar')->name('tareas.finalizar')
                        ->middleware('can:tareas.edit');

    //Maquinarias

        Route::get('descargar-maquinarias', 'MaquinariaController@reportes')->name('maquinarias.reportes')
                        ->middleware('can:maquinarias.show');

        Route::post('maquinarias/store', 'MaquinariaController@store')->name('maquinarias.store')
                        ->middleware('can:maquinarias.create');

        //Boton de solicitudes.show para agregar nuevas tareas a dicha solicitud, envia el id de la solicitud
        Route::get('maquinarias/{maquinaria}/createFrom', 'MaquinariaController@createFrom')->name('maquinarias.createfrom')
                        ->middleware('can:maquinarias.show');

        /*El boton agregar, de la vista tareas.show envia a esta ruta y luego es redirigido a la vista asignaciones.update
        con el id de la tarea y el total de las maquinarias para que puedan ser inspeccionadas*/
        Route::get('asignacion/{asigna}/edit', 'MaquinariaController@asigna')->name('asigna.edit')
                        ->middleware('can:actividades.encargos.asignaciones');

        /*El formulario de la vista asignaciones.update envia a esta ruta los datos de la tarea y los vehiculos seleccionados
        mediante un array para actualizar los vehiculos asignados a una tarea*/
        Route::post('asignacion/{asigna}/store', 'MaquinariaController@asignaStore')->name('asigna.store')
                        ->middleware('can:actividades.encargos.asignaciones');

        //Abre el formulario de asignaciones desde el menu lateral, redirige a la vista asignaciones.create
        Route::get('asignacion/create', 'MaquinariaController@asignaCreate')->name('asigna.create')
                        ->middleware('can:actividades.encargos.asignaciones');

        //Almacena la informacion del formulario de la vista asignaciones.create
        Route::post('asignacion/storecode', 'MaquinariaController@asignaStoreCode')->name('asigna.storecode')
                        ->middleware('can:actividades.encargos.asignaciones');

        Route::get('maquinarias', 'MaquinariaController@index')->name('maquinarias.index')
                        ->middleware('can:maquinarias.index');

        Route::get('get-maquinarias', 'MaquinariaController@maquinariaData')->name('datatables.maquinarias')
                        ->middleware('can:maquinarias.index');

        Route::get('maquinarias/create', 'MaquinariaController@create')->name('maquinarias.create')
                        ->middleware('can:maquinarias.create');

        Route::put('maquinarias/{maquinaria}', 'MaquinariaController@update')->name('maquinarias.update')
                        ->middleware('can:maquinarias.edit');

        Route::get('maquinarias/{maquinaria}', 'MaquinariaController@show')->name('maquinarias.show')
                        ->middleware('can:maquinarias.show');

        Route::delete('maquinarias/{maquinaria}', 'MaquinariaController@destroy')->name('maquinarias.destroy')
                        ->middleware('can:maquinarias.destroy');

        Route::get('maquinarias/{maquinaria}/edit', 'MaquinariaController@edit')->name('maquinarias.edit')
                        ->middleware('can:maquinarias.edit');

    //Mantenimientos

        Route::get('descargar-mantenimientos', 'MantenimientoController@reportes')->name('mantenimientos.reportes')
                    ->middleware('can:mantenimientos.show');

        Route::get('descargar-mantenimientos/{mantenimiento}', 'MantenimientoController@pdf')->name('mantenimientos.pdf');

        Route::post('mantenimientos/store', 'MantenimientoController@store')->name('mantenimientos.store')
                    ->middleware('can:mantenimientos.create');

        Route::get('mantenimientos', 'MantenimientoController@index')->name('mantenimientos.index')
                    ->middleware('can:mantenimientos.index');

        Route::get('get-mantenimientos', 'MantenimientoController@mantenimientoData')->name('datatables.mantenimientos')
                    ->middleware('can:mantenimientos.index');

        Route::get('mantenimientos/create', 'MantenimientoController@create')->name('mantenimientos.create')
                    ->middleware('can:mantenimientos.create');

        Route::get('mantenimientos/{mantenimiento}/createfrom', 'MantenimientoController@createFrom')->name('mantenimientos.createfrom')
                    ->middleware('can:mantenimientos.create');

        Route::put('mantenimientos/{mantenimiento}', 'MantenimientoController@update')->name('mantenimientos.update')
                    ->middleware('can:mantenimientos.edit');

        Route::get('mantenimientos/{mantenimiento}', 'MantenimientoController@show')->name('mantenimientos.show')
                    ->middleware('can:mantenimientos.show');

        Route::get('mantenimientos/fichas/{mantenimiento}', 'MantenimientoController@ficha')->name('mantenimientos.ficha')
                    ->middleware('can:mantenimientos.show');

        Route::delete('mantenimientos/{mantenimiento}', 'MantenimientoController@destroy')->name('mantenimientos.destroy')
                    ->middleware('can:mantenimientos.destroy');

        Route::get('mantenimientos/{mantenimiento}/edit', 'MantenimientoController@edit')->name('mantenimientos.edit')
                    ->middleware('can:mantenimientos.edit');

        ///Modificar estados de Mantenimientos
        Route::put('mantenimientos/activo/{mantenimiento}', 'MantenimientoController@activo')->name('mantenimientos.activo')
                ->middleware('can:mantenimientos.edit');

        Route::put('mantenimientos/espera/{mantenimiento}', 'MantenimientoController@espera')->name('mantenimientos.espera')
                ->middleware('can:mantenimientos.edit');

        Route::put('mantenimientos/inactivo/{mantenimiento}', 'MantenimientoController@inactivo')->name('mantenimientos.inactivo')
                ->middleware('can:mantenimientos.edit');

        Route::put('mantenimientos/finalizar/{mantenimiento}', 'MantenimientoController@finalizar')->name('mantenimientos.finalizar')
                ->middleware('can:mantenimientos.edit');

    //Trabajos

        Route::get('descargar-trabajos', 'TrabajoController@reportes')->name('trabajos.reportes')
                    ->middleware('can:trabajos.show');

        Route::post('trabajos/store', 'TrabajoController@store')->name('trabajos.store')
                    ->middleware('can:trabajos.create');

        //Boton de mantenimientos.show para agregar nuevos trabajos a dicho mantenimiento, envia el id del mantenimiento
        Route::get('trabajos/{trabajo}/createFrom', 'TrabajoController@createFrom')->name('trabajos.createfrom')
                        ->middleware('can:trabajos.show');

        Route::get('trabajos', 'TrabajoController@index')->name('trabajos.index')
                    ->middleware('can:trabajos.index');

        Route::get('get-trabajos', 'TrabajoController@trabajoData')->name('datatables.trabajos')
                    ->middleware('can:trabajos.index');

        Route::get('trabajos/create', 'TrabajoController@create')->name('trabajos.create')
                    ->middleware('can:trabajos.create');

        Route::put('trabajos/{trabajo}', 'TrabajoController@update')->name('trabajos.update')
                    ->middleware('can:trabajos.edit');

        Route::get('trabajos/{trabajo}', 'TrabajoController@show')->name('trabajos.show')
                    ->middleware('can:trabajos.show');

        Route::delete('trabajos/{trabajo}', 'TrabajoController@destroy')->name('trabajos.destroy')
                    ->middleware('can:trabajos.destroy');

        Route::get('trabajos/{trabajo}/edit', 'TrabajoController@edit')->name('trabajos.edit')
                    ->middleware('can:trabajos.edit');

        ///Modificar estados de Mantenimientos
        Route::put('trabajos/activo/{trabajo}', 'TrabajoController@activo')->name('trabajos.activo')
                ->middleware('can:trabajos.edit');

        Route::put('trabajos/espera/{trabajo}', 'TrabajoController@espera')->name('trabajos.espera')
                ->middleware('can:trabajos.edit');

        Route::put('trabajos/inactivo/{trabajo}', 'TrabajoController@inactivo')->name('trabajos.inactivo')
                ->middleware('can:trabajos.edit');

        Route::put('trabajos/finalizar/{trabajo}', 'TrabajoController@finalizar')->name('trabajos.finalizar')
                ->middleware('can:trabajos.edit');

    //Marcas

        Route::post('marcas/store', 'MarcaController@store')->name('marcas.store')
                    ->middleware('can:marcas.create');

        Route::get('marcas', 'MarcaController@index')->name('marcas.index')
                    ->middleware('can:marcas.index');

        Route::get('get-marcas', 'MarcaController@marcaData')->name('datatables.marcas')
                    ->middleware('can:marcas.index');

        Route::get('marcas/create', 'MarcaController@create')->name('marcas.create')
                    ->middleware('can:marcas.create');

        Route::put('marcas/{marca}', 'MarcaController@update')->name('marcas.update')
                    ->middleware('can:marcas.edit');

        Route::get('marcas/{marca}', 'Controller@show')->name('marcas.show')
                    ->middleware('can:marcas.show');

        Route::delete('marcas/{marca}', 'MarcaController@destroy')->name('marcas.destroy')
                    ->middleware('can:marcas.destroy');

        Route::get('marcas/{marca}/edit', 'MarcaController@edit')->name('marcas.edit')
                    ->middleware('can:marcas.edit');

});
