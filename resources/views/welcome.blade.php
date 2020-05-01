@extends('layouts.appOption')

@section('content')
    <div>

        <div class="container">

            <!-- Outer Row -->
            <div class="row justify-content-center">
        
                <div class="col-xl-10 col-lg-12 col-md-9">
        
                    <div class="card o-hidden border-0 shadow-lg mt-5">
                        <div class="card-body p-0">
                            <!-- Nested Row within Card Body -->
                            <div class="row">
                                <div class="col-lg-6 d-none d-lg-block bg-login"> <img src="{{ asset('images/gad.jpg') }}"> </div>
                                    <div class="col-lg-6">
                                        <div class="p-5 mt-4">
                                            <div class="text-center">
                                                <h1 class="h4 text-gray-900 mb-4 mt-4">Consultar Solicitud</h1>
                                            </div>
                    
                                            <form class="user" method="POST" action="{{ route('consultas') }}">
                                                @csrf
                        
                                                <div class="form-group">
                                                    <input id="buscar" type="text" class="form-control form-control-user @error('buscar') is-invalid @enderror" name="buscar" value="{{ old('buscar') }}" placeholder="Buscar...">
                                                </div>
                        
                                                <button type="submit" class="btn btn-primary btn-user btn-block">
                                                    Consultar
                                                </button>
                                                @if(session('danger'))
                                                    <div class="msg mt-1" style="z-index: 99 !important">
                                                        <div class="container">
                                                            <div class="row">
                                                                <div class="col-md-12 col-md-offset-13">
                                                                    <div class="alert alert-danger">
                                                                        {{ session('danger') }}
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                            </form>
                                        </div>
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
