@extends('layouts.app')

@section('css')
@endsection

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Pagos</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
                        <li class="breadcrumb-item active">Pagos</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            {{-- <h3 class="card-title"></h3> --}}
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example2" class="table data-table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Nº</th>
                                        <th>Cliente</th>
                                        <th>Tipo de pago</th>
                                        <th>Valoración</th>
                                        <th>Fecha Hora Pago</th>
                                        <th>Total</th>
                                        <th>Opciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $cont = 1;
                                    @endphp
                                    @foreach ($pagos as $pago)
                                        <tr>
                                            <td>{{ $cont++ }}</td>
                                            <td>{{ $pago->entrega->cliente->nombre }}
                                                {{ $pago->entrega->cliente->paterno }}
                                                {{ $pago->entrega->cliente->materno }}</td>
                                            <td>{{ $pago->metodo_pago }}</td>
                                            <td>{{ $pago->valoracion }}</td>
                                            <td>{{ $pago->fecha_hora_pago }}</td>
                                            <td>{{ $pago->total_pago }}</td>
                                            <td class="btns-opciones">
                                                <a href="{{ route('pagos.show', $pago->id) }}" class="evaluar"><i
                                                        class="fa fa-eye" data-toggle="tooltip" data-placement="left"
                                                        title="Ver información"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
    </section>

    @include('modal.eliminar')

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

        @if (session('url_qr'))
            window.open("{{ session('url_qr') }}","_blank");
        @endif


        $('table.data-table').DataTable({
            order: [
                [0, 'desc']
            ],
            columns: [
                null,
                null,
                null,
                null,
                null,
                null,
                {
                    width: "15%"
                },
            ],
            scrollCollapse: true,
            language: lenguaje,
            pageLength: 25
        });


        // ELIMINAR
        $(document).on('click', 'table tbody tr td.btns-opciones a.eliminar', function(e) {
            e.preventDefault();
            let pago = $(this).parents('tr').children('td').eq(1).text();
            $('#mensajeEliminar').html(`¿Está seguro(a) de eliminar el registro?`);
            let url = $(this).attr('data-url');
            console.log($(this).attr('data-url'));
            $('#formEliminar').prop('action', url);
        });

        $('#btnEliminar').click(function() {
            $('#formEliminar').submit();
        });
    </script>
@endsection

@endsection
