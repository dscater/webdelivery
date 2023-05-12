<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>WEBDELIVERY | Pago</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('template/AdminLTE-3.0.5/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet"
        href="{{ asset('template/AdminLTE-3.0.5/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('template/AdminLTE-3.0.5/dist/css/adminlte.min.css') }}">
    <!-- Google Font: Source Sans Pro -->
    <style>
        .overlay.dark {
            z-index: 1000;
            position: absolute;
            height: 100%;
            width: 100%;
            left: 0px;
            top: 0px;
            background: rgba(0, 0, 0, 0.445);
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .overlay.dark span {
            margin-left: 10px;
        }

        .overlay.dark .contenedor {
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 15px;
            background: rgb(32, 32, 32);
            color:white;
        }

    </style>
    @yield('css')
</head>

<body class="hold-transition login-page">
    @extends('layouts.login')

    @section('css')
        <link rel="stylesheet" href="{{ asset('css/pago.css') }}">
    @endsection

    @section('content')

        <div class="login-box">
            <!-- /.login-logo -->
            <div class="card">
                <div class="card-body login-card-body">
                    @if (session('bien'))
                        <div class="alert alert-success"><button class="close" data-dismiss="alert">&times;</button>Pago
                            registrado con éxito</div>
                    @endif
                    @if (session('error'))
                        <div class="alert alert-danger"><button class="close"
                                data-dismiss="alert">&times;</button>{{ session('error') }}</div>
                    @endif
                    <h3 class="login-box-msg">REGISTRAR PAGO</h3>
                    {{ Form::open(['route' => ['pagos.store', $entrega->id], 'method' => 'post']) }}
                    @csrf
                    <div class="form-group">
                        <label>Metodo de Pago*</label>
                        <select name="metodo_pago" id="metodo_pago" class="form-control" required>
                            <option value="">Seleccione...</option>
                            <option value="EFECTIVO">EFECTIVO</option>
                            <option value="DEPÓSITO BANCARIO">DEPÓSITO BANCARIO</option>
                        </select>
                    </div>
                    <div class="row">
                        <!-- /.col -->
                        <div class="col-12 mb-2">
                            <button type="submit" id="btnRegistrar"
                                class="btn btn-danger bg-red btn-block btn-sm">REGISTRAR</button>
                        </div>
                        <!-- /.col -->
                    </div>

                    {{ Form::close() }}
                </div>
                <!-- /.login-card-body -->
            </div>
        </div>
        <div class="overlay dark">
            <div class="contenedor"><i class="fas fa-2x fa-sync-alt fa-spin"></i> <span
                    class="font-weight-bold">REGISTRANDO...</span></div>
        </div>
        <!-- /.login-box -->
    @endsection


    @section('scripts')
        <script>
            @if (session('bien'))
                mensajeNotificacion('{{ session('bien') }}','success');
            @endif

            @if (session('info'))
                mensajeNotificacion('{{ session('info') }}','info');
            @endif

            @if (session('error'))
                mensajeNotificacion('{{ session('error') }}','error');
            @endif
        </script>
    @endsection

    <!-- jQuery -->
    <script src="{{ asset('template/AdminLTE-3.0.5/plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('template/AdminLTE-3.0.5/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('template/AdminLTE-3.0.5/dist/js/adminlte.min.js') }}"></script>

    <!-- SweetAlert2 -->
    <script src="{{ asset('template/AdminLTE-3.0.5/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
    <!-- Toastr -->
    <script src="{{ asset('template/AdminLTE-3.0.5/plugins/toastr/toastr.min.js') }}"></script>

    <!-- JQUERY VALIDATE -->
    <script src="{{ asset('template/AdminLTE-3.0.5/plugins/jquery-validation/jquery.validate.min.js') }}"></script>

    <!-- AdminLTE App -->
    <script src="{{ asset('template/AdminLTE-3.0.5/dist/js/adminlte.js') }}"></script>

    <!-- OPTIONAL SCRIPTS -->
    <script src="{{ asset('template/AdminLTE-3.0.5/dist/js/demo.js') }}"></script>

    <!-- PAGE SCRIPTS -->
    <script src="{{ asset('template/AdminLTE-3.0.5/dist/js/pages/dashboard2.js') }}"></script>

    {{-- DEBOUNCE --}}
    <script src="{{ asset('js/debounce.js') }}"></script>

    {{-- STEPS --}}
    {{-- <script src="{{ asset('jquery-steps/src/defaults.js') }}"></script> --}}
    <script src="{{ asset('jquery-steps/lib/modernizr-2.6.2.min.js') }}"></script>
    <script src="{{ asset('jquery-steps/lib/jquery.cookie-1.3.1.js') }}"></script>
    <script src="{{ asset('jquery-steps/build/jquery.steps.js') }}"></script>
    <script src="{{ asset('jquery-steps/build/jquery.steps.fix.js') }}"></script>

    {{-- MIS SCRIPTS --}}

    <script>
        $(document).ready(function() {
            $('.overlay.dark').hide();
            @if (session('bien'))
                mensajeNotificacion('{{ session('bien') }}','success');
            @endif

            @if (session('info'))
                mensajeNotificacion('{{ session('info') }}','info');
            @endif

            @if (session('error'))
                mensajeNotificacion('{{ session('error') }}','error');
            @endif

            $('#btnRegistrar').click(function() {
                $('.overlay.dark').show();
            });
        });

        function mensajeNotificacion(mensaje, tipo) {
            let Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000
            });
            Toast.fire({
                icon: tipo,
                title: mensaje
            })
        }
    </script>

    @yield('scripts')

</body>

</html>
