@php
    if (!isset($orden) || (isset($orden) && $orden->estado == 'PENDIENTE')) {
        $muestra_productos = true;
        $col_productos = 'col-md-6';
        $col_orden = 'col-md-6';
    } else {
        $muestra_productos = false;
        $col_orden = 'col-md-12';
    }
@endphp
<div class="row">
    @if ($muestra_productos)
        <div class="{{ $col_productos }}">
            <div class="card">
                <div class="card-body">
                    @if (isset($orden))
                        <h3>Agregar productos</h3>
                    @else
                        <h3>Realiza tu orden</h3>
                    @endif
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Empresa:</label>
                                <select class="form-control select2" name="empresa2" onchange="listaProductosEmpresas();"
                                    id="select_empresa_busqueda">
                                    <option value="todos">Todos</option>
                                    @foreach ($empresas as $value)
                                        <option value="{{ $value->id }}">{{ $value->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Buscar producto</label>
                                <input type="text" class="form-control" id="texto_busqueda"
                                    onkeyup="listaProductosEmpresas();">
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
    @endif
    <div class="{{ $col_orden }}">
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
                                    @if ($muestra_productos)
                                        <th>Acción</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody id="contenedorCarrito">
                            </tbody>
                        </table>
                        <p class="text-lg">TOTAL: <strong id="txtTotal">0.00</strong></p>
                    </div>
                    @if($muestra_productos)
                    <div class="col-md-12">
                        <button type="button" class="btn btn-primary btn-block btn-flat" id="btnRegistraOrden"><i
                                class="fa fa-shooping-cart"></i> Registrar orden</button>
                    </div>
                    @endif
                    @if (isset($orden) && $orden->estado == 'PENDIENTE')
                        <div class="col-md-12 mt-2">
                            <button type="button" class="btn btn-danger btn-block btn-flat" id="btnEliminarOrden"><i
                                    class="fa fa-shooping-cart"></i> Eliminar orden</button>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
