<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>WEBDELIVERY | Iniciar Sesión</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('template/AdminLTE-3.0.5/plugins/fontawesome-free/css/all.min.css')}}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="{{asset('template/AdminLTE-3.0.5/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('template/AdminLTE-3.0.5/dist/css/adminlte.min.css')}}">
  <!-- Google Font: Source Sans Pro -->
  @yield('css')
</head>
<body class="hold-transition login-page">
@yield('content')

<!-- jQuery -->
<script src="{{asset('template/AdminLTE-3.0.5/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('template/AdminLTE-3.0.5/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('template/AdminLTE-3.0.5/dist/js/adminlte.min.js')}}"></script>

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
{{-- <script src="{{ asset('jquery-steps/src/defaults.js') }}"></script>
--}}
<script src="{{ asset('jquery-steps/lib/modernizr-2.6.2.min.js') }}"></script>
<script src="{{ asset('jquery-steps/lib/jquery.cookie-1.3.1.js') }}"></script>
<script src="{{ asset('jquery-steps/build/jquery.steps.js') }}"></script>
<script src="{{ asset('jquery-steps/build/jquery.steps.fix.js') }}"></script>

{{-- MIS SCRIPTS --}}

<script>
    $('[data-toggle="tooltip"]').tooltip();

    lenguaje = {
        "decimal": "",
        "emptyTable": "No se encontraron registros",
        "info": "Mostrando _START_ a _END_ de _TOTAL_ Registros",
        "infoEmpty": "Mostrando 0 to 0 of 0 Registros",
        "infoFiltered": "(Filtrado de _MAX_ total registros)",
        "infoPostFix": "",
        "thousands": ",",
        "lengthMenu": "Mostrar _MENU_ Registros",
        "loadingRecords": "Cargando...",
        "processing": "Procesando...",
        "search": "Buscar:",
        "zeroRecords": "Sin resultados encontrados",
        "paginate": {
            "first": '<i class="fa fa-fast-backward"></i>',
            "last": '<i class="fa fa-fast-forward"></i>',
            "next": '<i class="fa fa-step-forward"></i>',
            "previous": '<i class="fa fa-step-backward"></i>'
        }
    };

    $.extend($.validator.messages, {
        required: "Este campo es obligatorio.",
        maxlength: $.validator.format("El tamaño maximo es de {0} caracteres."),
        minlength: $.validator.format("El tamaño minimo es de {0} caracteres."),
        rangelength: $.validator.format("El valor debe estar entre {0} y {1}."),
        email: "Correo electronico no valido.",
        url: "URL no valida.",
        date: "Formato de fecha no valido.",
        number: "El valor debe ser númerico.",
        max: $.validator.format("El valor debe ser menor o igual que {0}"),
        min: $.validator.format("El valor debe ser mayor o igual que {0}"),
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
