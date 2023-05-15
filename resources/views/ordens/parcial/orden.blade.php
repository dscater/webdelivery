<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <p><strong>Nro. de orden: {{ $orden->nro_orden }}</strong></p>
                        <p><strong>Cliente: </strong>{{ $orden->cliente->full_name }}</p>
                        @if ($orden->entrega && $orden->distribuidor)
                            <p><strong>Distribuidor: </strong>{{ $entrega->orden->distribuidor->datosUsuario->nombre }}
                                {{ $entrega->orden->distribuidor->datosUsuario->paterno }}
                                {{ $entrega->orden->distribuidor->datosUsuario->materno }} -
                                "{{ $entrega->orden->distribuidor->datosUsuario->distribuidor->nombre }}"</p>
                        @endif
                        <p><strong>Fecha y hora de pedido: </strong>{{ $orden->fecha_hora_pedido }}</p>
                    </div>
                    <div class="col-md-12">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Producto</th>
                                    <th>Empresa</th>
                                    <th>C/U</th>
                                    <th>Cantidad</th>
                                    <th>Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $cont = 1;
                                @endphp
                                @foreach ($orden->detalle_ordens as $do)
                                    <tr>
                                        <td>{{ $cont++ }}</td>
                                        <td>{{ $do->producto->nombre }}</td>
                                        <td>{{ $do->producto->empresa->nombre }}</td>
                                        <td>{{ $do->precio }}</td>
                                        <td>{{ $do->cantidad }}</td>
                                        <td>{{ $do->subtotal }}</td>
                                    </tr>
                                @endforeach
                                <tr>
                                    <td colspan="5" class="text-lg font-weight-bold">TOTAL</td>
                                    <td class="text-lg font-weight-bold">{{ $orden->total }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
