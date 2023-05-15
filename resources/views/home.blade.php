@extends('layouts.app')

@section('background-image')
    {{-- style="background-image:url({{asset('imgs/fondo.jpg')}})" --}}
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
    <style>
        .highcharts-axis-labels tspan {
            font-size: 10px;
        }
    </style>
@endsection

@section('content')
    @php
        $nombre_usuario = Auth::user()->full_name;
    @endphp

    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Inicio</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right bg-white">
                        <li class="breadcrumb-item active">Inicio</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body text-center">
                            <h3 class="font-weight-bold">WEBDELIVERY - SISTEMA WEB DE PEDIDOS Y ENTREGAS A DOMICILIO CON
                                PAGOS QR
                            </h3>
                            <h4>Bienvenido(a) {{ $nombre_usuario }}</h4>
                        </div>
                    </div>
                </div>
            </div>
            @if (Auth::user()->tipo == 'ADMINISTRADOR')
                @include('includes.home.home_admin')
            @endif
            @if (Auth::user()->tipo == 'EMPRESA')
                @include('includes.home.home_empresa')
            @endif
            @if (Auth::user()->tipo == 'DISTRIBUIDOR')
                @include('includes.home.home_distribuidor')
            @endif
            <div class="row">
                @if (Auth::user()->tipo == 'ADMINISTRADOR' || Auth::user()->tipo == 'EMPRESA')
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <h3>Cantidad de Ingresos</h3>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Fecha Inicio:</label>
                                            <input type="date" value="{{ date('Y-m-d') }}" name="fecha_ini"
                                                id="fecha_ini1" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Fecha Fin:</label>
                                            <input type="date" value="{{ date('Y-m-d') }}" name="fecha_fin"
                                                id="fecha_fin1" class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Empresa:</label>
                                            @if (Auth::user()->tipo == 'EMPRESA')
                                                <select name="empresa" id="empresa1" class="form-control">
                                                    <option value="{{ Auth::user()->datosUsuario->empresa_id }}">
                                                        {{ Auth::user()->datosUsuario->empresa->nombre }}</option>
                                                </select>
                                            @else
                                                <select class="form-control" name="empresa" id="empresa1">
                                                    <option value="todos">Todos</option>
                                                    @foreach ($empresas as $value)
                                                        <option value="{{ $value->id }}">{{ $value->nombre }}</option>
                                                    @endforeach
                                                </select>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div id="g_ingresos"></div>
                            </div>
                        </div>
                    </div>
                @endif

                @if (Auth::user()->tipo != 'CLIENTE')
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <h3>Entregas de Distribuidores</h3>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Fecha Inicio:</label>
                                            <input type="date" value="{{ date('Y-m-d') }}" name="fecha_ini"
                                                id="fecha_ini2" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Fecha Fin:</label>
                                            <input type="date" value="{{ date('Y-m-d') }}" name="fecha_fin"
                                                id="fecha_fin2" class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Empresa:</label>
                                            @if (Auth::user()->tipo == 'EMPRESA')
                                                <select name="empresa2" id="empresa2" class="form-control">
                                                    <option value="{{ Auth::user()->datosUsuario->empresa_id }}">
                                                        {{ Auth::user()->datosUsuario->empresa->nombre }}</option>
                                                </select>
                                            @else
                                                <select class="form-control" name="empresa2" id="empresa2">
                                                    <option value="todos">Todos</option>
                                                    @foreach ($empresas as $value)
                                                        <option value="{{ $value->id }}">{{ $value->nombre }}</option>
                                                    @endforeach
                                                </select>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Distribuidor:</label>
                                            @if (Auth::user()->tipo == 'DISTRIBUIDOR')
                                                <select name="distribuidor" id="distribuidor2" class="form-control">
                                                    <option value="{{ Auth::user()->id }}">
                                                        {{ Auth::user()->datosUsuario->nombre }}
                                                        {{ Auth::user()->datosUsuario->paterno }}
                                                        {{ Auth::user()->datosUsuario->materno }}</option>
                                                </select>
                                            @else
                                                <select class="form-control" name="distribuidor" id="distribuidor2">
                                                    <option value="todos">Todos</option>
                                                    @foreach ($distribuidors as $value)
                                                        <option value="{{ $value->user->id }}">{{ $value->nombre }}
                                                            {{ $value->paterno }} {{ $value->paterno }} -
                                                            "{{ $value->distribuidor->nombre }}"</option>
                                                    @endforeach
                                                </select>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div id="g_entregas"></div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
            @if (Auth::user()->tipo == 'CLIENTE')
                @include('includes.home.home_cliente')
            @endif
        </div>
        <!--/. container-fluid -->
    </section>
    <!-- /.content -->

    <input type="hidden" value="{{ route('pagos.g_info_ingresos') }}" id="urlGIngresos">
    <input type="hidden" value="{{ route('entregas.g_info_entregas') }}" id="urlGEntregas">
    <input type="hidden" value="{{ route('ordens.store') }}" id="urlRegistraOrden">
    <input type="hidden" value="{{ route('productos.lista_empresas') }}" id="urlListaProductosEmpresas">

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
    </script>
    <script src="{{ asset('js/reloj.js') }}"></script>
    @if (Auth::user()->tipo != 'CLIENTE')
        <script src="{{ asset('js/graficos.js') }}"></script>
    @endif
    @if (Auth::user()->tipo == 'CLIENTE')
        <script>
            let oCarrito = {
                productos: [],
                total: 0,
                cliente: {
                    id: {{ Auth::user()->cliente->id }},
                    nombre: '{{ $nombre_usuario }}'
                },
            };
        </script>
        <script src="{{ asset('js/ordens/pedido_cliente.js') }}"></script>
    @endif
@endsection
