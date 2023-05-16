@if (count($ordens) > 0)
    @foreach ($ordens as $orden)
        <div class="elemento_lista">
            <div class="card">
                <div class="card-body">
                    <div class="contenedor_cliente">
                        @if (Auth::user()->tipo != 'CLIENTE')
                            <div class="opciones">
                                <div class="dropdown">
                                    <button class="btn btn-link dropdown-toggle" type="button" id="dropdownMenu1"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                        <i class="fa fa-ellipsis-v"></i>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-left" aria-labelledby="dropdownMenu1">
                                        <a href="{{ route('ordens.edit', $orden->id) }}" class="dropdown-item"><i
                                                class="fa fa-edit"></i>
                                            Editar</a>
                                        <a href="#" data-url="{{ route('ordens.destroy', $orden->id) }}"
                                            data-info="{{ $orden->cliente->nombre }} {{ $orden->cliente->paterno }} {{ $orden->cliente->materno }}"
                                            data-toggle="modal" data-target="#modal-eliminar"
                                            class="eliminar dropdown-item"><i class="fa fa-trash"></i>
                                            Eliminar</a>
                                    </div>
                                </div>
                            </div>
                        @endif
                        @if (Auth::user()->tipo == 'CLIENTE')
                            <div class="nombre_cliente">
                                <a href="{{ route('ordens.show', $orden->id) }}">Ver orden {{ $orden->nro_orden }}</a>
                            </div>
                        @endif
                        <div class="nombre_cliente">
                            @if (Auth::user()->tipo != 'CLIENTE')
                                <a href="{{ route('ordens.edit', $orden->id) }}">{{ $orden->cliente->full_name }}</a>
                            @else
                                {{ $orden->cliente->full_name }}
                            @endif
                        </div>
                        <div class="ocupacion_cliente">
                            Pedido: {{ date('d/m/Y H:i', strtotime($orden->fecha_hora_pedido)) }}
                        </div>
                        @if ($orden->estado != 'PENDIENTE' && $orden->fecha_hora_entrega)
                            <div class="ocupacion_cliente">
                                Entrega: {{ date('d/m/Y H:i', strtotime($orden->fecha_hora_entrega)) }}
                            </div>
                        @endif
                        @if ($orden->distribuidor)
                            <div class="ci_cliente text-xs">
                                Distribuidor: {{ $orden->distribuidor->datosUSuario->nombre }}
                                {{ $orden->distribuidor->datosUSuario->paterno }}{{ $orden->distribuidor->datosUSuario->materno }}
                                - "{{ $orden->distribuidor->datosUsuario->distribuidor->nombre }}"
                            </div>
                        @endif
                        <div class="ocupacion_cliente">
                            @php
                                $estado = 'entregado';
                                if ($orden->estado == 'PENDIENTE') {
                                    $estado = 'pendiente';
                                }
                                if ($orden->estado == 'EN CAMINO') {
                                    $estado = 'en_camino';
                                }
                            @endphp
                            <button
                                class="btn btn-sm btn-block btn-flat {{ $estado }}">{{ $orden->estado }}</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@else
    <div class="col-md-12">
        NO SE ENCONTRARON REGISTROS
    </div>
@endif
