@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">

                <div class="card-header d-flex justify-content-between align-items-center">
                    <span><h4><b>Actualizar Datos de: </b><i>{{ $user->name }} {{ $user->apellido_pater }}</i></h4></span>
                    <a href="javascript:history.back()">
                        <img class="img-responsive img-rounded float-left" src="{{ asset('images/retroceder.png') }}">
                    </a>
                </div>

                <div class="row">
                    <div class="col-lg-6 d-none d-lg-block bg-login">
                        @if ($user->path)
                            <div class="avatar text-center" style="background-image: url({{ Auth::user()->url_path }})"></div>
                        @else
                            <div class="avatar text-center mt-15"><div>
                                <i class="fas fa-user-tie fa-10x mt-5"></i>
                            </div></div>
                        @endif
                    </div>
                    <div class="col-lg-6">
                      <div class="p-5">
                        <div class="text-center">
                          <h1 class="h4 text-gray-900 mb-4">Actualizar datos</h1>
                        </div>
                            <form class="user" method="POST" action="{{ route('pass.update', $user->id) }}" enctype="multipart/form-data">
                                @method('PUT')
                                @csrf

                                <div class="form-group">
                                    <input id="password" type="password" class="form-control form-control-user" name="oldPassword" autocomplete="email" placeholder="Contraseña Actual">
                                </div>

                                <div class="form-group">
                                    <input id="password" type="password" class="form-control form-control-user" name="newPassword" autocomplete="email" placeholder="Nueva Contraseña">
                                </div>

                                <div class="form-group">
                                    <input id="password" type="password" class="form-control form-control-user" name="newPassword2" autocomplete="email" placeholder="Confirmar Contraseña">
                                </div>

                                {{-- Foto de Perfil --}}
                                    <div class="form-group text-center">
                                        <label for="file-upload" class="custom-file-upload">
                                            <i class="fa fa-cloud-upload"></i> Cambiar foto de perfil
                                        </label>
                                        <span id="file-selected"></span>
                                        <input id="file-upload" accept="image/jpeg,image/png" type="file" name="foto">
                                    </div>

                                <button type="submit" class="btn btn-primary btn-user btn-block">
                                    Actualizar
                                </button>
                            </form>
                      </div>
                    </div>
                  </div>

            </div>
        </div>
    </div>
</div>
<script>
 $('#file-upload').bind('change', function() { var fileName = ''; fileName = $(this).val(); $('#file-selected').html(fileName); })
</script>
@endsection
