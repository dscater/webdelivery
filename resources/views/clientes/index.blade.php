@extends('layouts.app')

@section('css')
@endsection

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Clientes</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right bg-white">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
                        <li class="breadcrumb-item active">Clientes</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <a href="{{ route('clientes.create') }}" class="btn btn-primary">
                        <i class="fa fa-user-plus"></i>
                        <span>Registrar</span>
                    </a>
                </div>
                <div class="col-md-4" style="margin-top:5px;">
                    <div class="panel panel-default">
                        <div class="row">
                            <div class="col-md-12">
                                <input type="text" id="txtBusca" class="form-control" placeholder="Nombre Cliente...">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-2" style="margin-top:5px;">
                    <div class="panel panel-default">
                        <div class="row">
                            <div class="col-md-12">
                                <button class="btn btn-default" type="button" id="btnBuscar" style="width:100%;"><i
                                        class="fa fa-search"></i> BUSCAR</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mt-3" id="contenedorLista">
                @include('clientes.parcial.lista')
            </div>
        </div>
    </section>

    @include('modal.eliminar')
    <input type="hidden" value="{{ route('clientes.index') }}" id="urlLista">
@endsection

@section('scripts')
    <script>
        @if (session('bien'))
            mensajeNotificacion('{{ session('bien') }}', 'success');
        @endif

        @if (session('info'))
            mensajeNotificacion('{{ session('info') }}', 'info');
        @endif

        @if (session('error'))
            mensajeNotificacion('{{ session('error') }}', 'error');
        @endif

        // ELIMINAR-NUEVO
        $(document).on('click', '.opciones .dropdown a.eliminar', function(e) {
            e.preventDefault();
            let registro = $(this).attr('data-info');
            $('#mensajeEliminar').html(`¿Está seguro(a) de eliminar al registro <b>${registro}</b>?`);
            let url = $(this).attr('data-url');
            $('#formEliminar').prop('action', url);
        });

        $('#btnEliminar').click(function() {
            $('#formEliminar').submit();
        });

        $('#btnBuscar').click(cargaLista);

        $('#txtBusca').on('keyup', function() {
            cargaLista();
        });

        function cargaLista() {
            $('#contenedorLista').html('<div class="col-md-12">Cargando...</div>');
            $.ajax({
                type: "GET",
                url: $('#urlLista').val(),
                data: {
                    texto: $('#txtBusca').val(),
                    fecha: $('#txtFecha').val(),
                },
                dataType: "json",
                success: function(response) {
                    $('#contenedorLista').html(response.html);
                }
            });
        }

        function reemplazarPassword(event, descripcion, url) {
            event.preventDefault();
            Swal.fire({
                title: "Reemplazar contraseña",
                html: "Usuario: <strong>" + descripcion + "</strong>",
                input: "text",
                inputPlaceholder: "Ingrese el nuevo valor aquí...",
                showCancelButton: true,
                confirmButtonColor: "#2E86C1",
                confirmButtonText: "Guardar cambios",
                cancelButtonText: "No, cancelar",
                showLoaderOnConfirm: true,
                preConfirm: (data) => {
                    return $.ajax({
                        headers: {
                            "X-CSRF-TOKEN": $("#token").val()
                        },
                        type: "POST",
                        url: url,
                        data: {
                            password: data
                        },
                        dataType: "json",
                        success: function(response) {
                            if (response.sw) {
                                Swal.fire({
                                    icon: "success",
                                    title: "Actualización éxitosa",
                                    showConfirmButton: false,
                                    timer: 1500,
                                });
                            } else {
                                Swal.fire({
                                    icon: "error",
                                    title: "Ocurrió un error",
                                    showConfirmButton: false,
                                    timer: 1500,
                                });
                            }
                        },
                        error: function(xhr, ajaxOptions, thrownError) {
                            Swal.showValidationMessage(
                                'Ocurrió un error al enviar el registro'
                            )
                        }
                    });
                },
                allowOutsideClick: () => !Swal.isLoading(),
            });
        }
    </script>
@endsection
