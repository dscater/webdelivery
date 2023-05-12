@if (count($entregas) > 0)
    @foreach ($entregas as $entrega)
        <div class="col-md-2">
            <div class="card">
                <div class="card-body">
                    <div class="contenedor_cliente">
                        <div class="opciones">
                            <div class="dropdown">
                                <button class="btn btn-link dropdown-toggle" type="button" id="dropdownMenu1"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                    <i class="fa fa-ellipsis-v"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-left" aria-labelledby="dropdownMenu1">
                                    <a href="{{ route('entregas.qr_pdf', $entrega->id) }}" class="dropdown-item" target="_blank"><i
                                        class="fa fa-qrcode"></i>
                                    Pdf QR</a>
                                    <a href="{{ route('entregas.edit', $entrega->id) }}" class="dropdown-item"><i
                                            class="fa fa-edit"></i>
                                        Editar</a>
                                    <a href="#" data-url="{{ route('entregas.destroy', $entrega->id) }}"
                                        data-info="{{ $entrega->orden->cliente->nombre }} {{ $entrega->orden->cliente->paterno }} {{ $entrega->orden->cliente->materno }}"
                                        data-toggle="modal" data-target="#modal-eliminar"
                                        class="eliminar dropdown-item"><i class="fa fa-trash"></i>
                                        Eliminar</a>
                                </div>
                            </div>
                        </div>
                        <div class="foto_qr">
                            <a href="{{ route('entregas.qr_pdf', $entrega->id) }}" target="_blank" class="foto">
                                <img src="{{ asset('imgs/qr/' . $entrega->qr) }}" alt="Foto">
                            </a>
                        </div>
                        <div class="nombre_cliente">
                            {{ $entrega->orden->cliente->nombre }} {{ $entrega->orden->cliente->paterno }}
                            {{ $entrega->orden->cliente->materno }}
                        </div>
                        <div class="ci_cliente">
                            {{ $entrega->orden->producto->nombre }} - "{{ $entrega->orden->empresa->nombre }}"
                        </div>
                        <div class="ci_cliente">
                            Cantidad: {{ $entrega->orden->cantidad }}
                        </div>
                        <div class="ocupacion_cliente">
                            Entrega: {{ date('d/m/Y H:i', strtotime($entrega->fecha_hora_entrega)) }}
                        </div>
                        <div class="ci_cliente">
                            Distribuidor: {{ $entrega->orden->distribuidor->datosUsuario->nombre}} {{ $entrega->orden->distribuidor->datosUsuario->paterno}} {{ $entrega->orden->distribuidor->datosUsuario->materno}} - "{{ $entrega->orden->distribuidor->datosUsuario->distribuidor->nombre}}"
                        </div>
                        <div class="ocupacion_cliente">
                            @php
                                $estado = 'entregado';
                                if ($entrega->estado != 'ENTREGADO') {
                                    $estado = 'pendiente';
                                }
                            @endphp
                            <button class="btn btn-sm {{$estado}}">{{ $entrega->estado }}</button>
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
