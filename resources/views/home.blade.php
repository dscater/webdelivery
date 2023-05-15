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
                @if (Auth::user()->tipo == 'CLIENTE')
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <h3>Realiza tu orden</h3>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Empresa:</label>
                                            <select class="form-control select2" name="empresa2">
                                                <option value="todos">Todos</option>
                                                @foreach ($empresas as $value)
                                                    <option value="{{ $value->id }}">{{ $value->nombre }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Buscar producto</label>
                                            <input type="text" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="row contenedorLista max50vh" id="contenedorLista">
                                            @include('productos.parcial.lista')
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <h3>Tu carrito</h3>
                                <div class="row">
                                    <div class="col-md-12">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Producto</th>
                                                    <th>Empresa</th>
                                                    <th>C/U</th>
                                                    <th>Cantidad</th>
                                                    <th>Total</th>
                                                    <th>Acción</th>
                                                </tr>
                                            </thead>
                                            <tbody id="contenedorCarrito">

                                            </tbody>
                                        </table>
                                        <p class="text-lg">TOTAL: <strong id="txtTotal">0.00</strong></p>
                                    </div>
                                    <div class="col-md-12">
                                        <button class="btn btn-primary btn-block btn-flat" id="btnRegistraOrden"><i
                                                class="fa fa-shooping-cart"></i> Registrar orden</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
        <!--/. container-fluid -->
    </section>
    <!-- /.content -->

    <input type="hidden" value="{{ route('pagos.g_info_ingresos') }}" id="urlGIngresos">
    <input type="hidden" value="{{ route('entregas.g_info_entregas') }}" id="urlGEntregas">
    <input type="hidden" value="{{ route('ordens.store') }}" id="urlRegistraOrden">
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
            let fila = `<tr class="fila">
                            <td>#</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td class="accion">
                                <button class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></button>
                            </td>
                        </tr>`;
            let fila_vacio = `<tr class="vacio">
                            <td colspan="7" class="text-center text-gray">AÚN NO SE AGREGÓ NINGÚN PRODUCTO</td>
                        </tr>`;
            let txtTotal = $("#txtTotal");
            let contenedorLista = $("#contenedorLista");
            let contenedorCarrito = $("#contenedorCarrito");
            let btnRegistraOrden = $("#btnRegistraOrden");
            $(document).ready(function() {
                listarProductos();
                contenedorLista.on("click", ".agregarProducto", function() {
                    let producto_id = $(this).attr("data-id");
                    let precio = parseFloat($(this).attr("data-precio"));
                    let nombre = $(this).attr("data-nombre");
                    let empresa = $(this).attr("data-empresa");
                    Swal.fire({
                        title: "Indica la cantidad",
                        html: "",
                        input: "number",
                        inputPlaceholder: "Ingrese el valor aquí...",
                        inputAttributes: {
                            min: 1,
                            class: "form-control"
                        },
                        inputValue: 1,
                        showCancelButton: true,
                        confirmButtonColor: "#2E86C1",
                        confirmButtonText: "Agregar al carrito",
                        cancelButtonText: "No, cancelar",
                        inputValidator: (value) => {
                            if (!value || value < 1) {
                                return 'Por favor, ingrese un número válido mayor o igual a 1';
                            }
                        },
                    }).then(result => {
                        if (result.value) {
                            let subtotal = parseFloat(result.value) * parseFloat(precio);
                            oCarrito.productos.push({
                                id: producto_id,
                                nombre: nombre,
                                empresa: empresa,
                                cantidad: result.value,
                                precio: precio.toFixed(2),
                                subtotal: subtotal
                            });
                            listarProductos();
                            mensajeNotificacion('Producto agregado', 'success');
                        }
                    });
                });

                contenedorCarrito.on("click", "tr.fila td.accion button", function() {
                    let fila = $(this).parents("tr.fila");
                    oCarrito.productos.splice(fila.attr("data-index"), 1);
                    listarProductos();
                });
                btnRegistraOrden.click(registrarOrden);
            });

            function registrarOrden() {
                if (oCarrito.productos.length > 0) {
                    $.ajax({
                        headers: {
                            "X-CSRF-TOKEN": $("#token").val()
                        },
                        type: "POST",
                        url: $("urlRegistraOrden").val(),
                        data: oCarrito,
                        dataType: "json",
                        success: function(response) {
                            console.log(response);
                        }
                    });
                } else {
                    Swal.fire({
                        icon: "error",
                        title: "No hay productos en el carrito",
                        showConfirmButton: false,
                    });
                }
            }

            function listarProductos() {
                contenedorCarrito.html("");
                if (oCarrito.productos.length > 0) {
                    let contador = 1;
                    let suma_total = 0;
                    oCarrito.productos.forEach((elem, index) => {
                        suma_total += parseFloat(elem.subtotal);
                        let nueva_fila = $(fila).clone();
                        nueva_fila.attr("data-index", index);
                        nueva_fila.children("td").eq(0).text(contador++);
                        nueva_fila.children("td").eq(1).text(elem.nombre);
                        nueva_fila.children("td").eq(2).text(elem.empresa);
                        nueva_fila.children("td").eq(3).text(elem.precio);
                        nueva_fila.children("td").eq(4).text(elem.cantidad);
                        nueva_fila.children("td").eq(5).text(elem.subtotal);
                        contenedorCarrito.append(nueva_fila);
                    });
                    txtTotal.text(suma_total.toFixed(2));
                    btnRegistraOrden.removeAttr("disabled");
                } else {
                    btnRegistraOrden.prop("disabled", true);
                    txtTotal.text("0.00");
                    contenedorCarrito.html(fila_vacio);
                }
            }
        </script>
    @endif
@endsection
