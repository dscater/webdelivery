@extends('layouts.app')

@section('css')
@endsection

@section('content')
    @php
        $nombre_usuario = Auth::user()->full_name;
    @endphp
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Ordenes</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('ordens.index') }}">Ordenes</a></li>
                        <li class="breadcrumb-item active">Modificar</li>
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
                            <h3 class="card-title">Orden nro: {{ $orden->nro_orden }}</h3>
                        </div>
                        <!-- /.card-header -->
                        {!! Form::model($orden, ['route' => ['ordens.update', $orden->id], 'method' => 'put', 'files' => true]) !!}
                        <div class="card-body">
                            @if (Auth::user()->tipo == 'CLIENTE')
                                @include('includes.home.home_cliente')
                            @else
                            @endif
                        </div>
                        {!! Form::close() !!}
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
    </section>
    {!! Form::open(['route' => ['ordens.destroy', $orden->id], 'method' => 'delete', 'id' => 'formEliminaOrden']) !!}
    {!! Form::close() !!}
    <input type="hidden" value="{{ route('ordens.actualizarOrden', $orden->id) }}" id="urlRegistraOrden">
    <input type="hidden" value="{{ route('productos.lista_empresas') }}" id="urlListaProductosEmpresas">
    @php
        if (!isset($orden) || (isset($orden) && $orden->estado == 'PENDIENTE')) {
            $muestra_productos = "true";
        } else {
            $muestra_productos = "false";
        }
    @endphp
@endsection
@section('scripts')
    @if (Auth::user()->tipo == 'CLIENTE')
        <script>
            let array_productos = [];
            @foreach ($orden->detalle_ordens as $do)
                array_productos.push({
                    id: {{ $do->id }},
                    producto_id: {{ $do->producto_id }},
                    nombre: '{{ $do->producto->nombre }}',
                    empresa: '{{ $do->producto->empresa->nombre }}',
                    cantidad: {{ $do->cantidad }},
                    precio: {{ $do->precio }},
                    subtotal: {{ $do->subtotal }}
                });
            @endforeach
            let oCarrito = {
                productos: array_productos,
                total: 0,
                cliente: {
                    id: {{ Auth::user()->cliente->id }},
                    nombre: '{{ $nombre_usuario }}'
                },
                eliminados: [],
                muestra_accion: '{{ $muestra_productos }}',
            };
            console.log(oCarrito);
        </script>
        <script src="{{ asset('js/ordens/pedido_cliente.js') }}"></script>
        <script>
            $("#btnEliminarOrden").click(function() {
                Swal.fire({
                    title: "¿Está seguro(a) de eliminar esta orden?",
                    html: "Nro. de orden: {{ $orden->nro_orden }}",
                    showCancelButton: true,
                    confirmButtonColor: "#bf2a2e",
                    confirmButtonText: "Si, eliminar",
                    cancelButtonText: "No, cancelar",
                }).then((result) => {
                    if (result.value) {
                        $("#formEliminaOrden").submit();
                    }
                });
            });
        </script>
    @endif
@endsection
