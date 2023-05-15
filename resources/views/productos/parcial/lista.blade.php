@if (count($productos) > 0)
    @foreach ($productos as $producto)
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
                                        <a href="{{ route('productos.edit', $producto->id) }}" class="dropdown-item"><i
                                                class="fa fa-edit"></i>
                                            Editar</a>
                                        <a href="#" data-url="{{ route('productos.destroy', $producto->id) }}"
                                            data-info="{{ $producto->nombre }}" data-toggle="modal"
                                            data-target="#modal-eliminar" class="eliminar dropdown-item"><i
                                                class="fa fa-trash"></i>
                                            Eliminar</a>
                                    </div>
                                </div>
                            </div>
                        @endif
                        <div class="foto_cliente">
                            <a href="{{ route('productos.edit', $producto->id) }}" class="foto">
                                <img src="{{ $producto->url_imagen }}" alt="Foto">
                            </a>
                        </div>
                        <div class="nombre_cliente">
                            {{ $producto->nombre }}
                        </div>
                        <div class="ocupacion_cliente">
                            "{{ $producto->empresa->nombre }}"
                        </div>
                        <div class="ci_cliente">
                            {{ $producto->precio }}
                        </div>
                        <div class="ci_cliente">
                            {{ $producto->descripcion }}
                        </div>
                        @if (Auth::user()->tipo == 'CLIENTE')
                            <div class="ci_cliente">
                                <button type="button" class="btn btn-primary btn-sm btn-block btn-flat agregarProducto"
                                    data-id="{{ $producto->id }}" data-precio="{{ $producto->precio }}"
                                    data-nombre="{{ $producto->nombre }}" data-empresa="{{ $producto->empresa->nombre }}"><i
                                        class="fa fa-plus"></i> Agregar al
                                    carrito</button>
                            </div>
                        @endif
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
