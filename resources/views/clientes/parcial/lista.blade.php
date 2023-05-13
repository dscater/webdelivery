@if (count($clientes) > 0)
    @foreach ($clientes as $cliente)
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
                                    <a href="{{ route('clientes.edit', $cliente->id) }}" class="dropdown-item"><i
                                            class="fa fa-edit"></i>
                                        Editar</a>
                                    <a href="#" data-url="{{ route('clientes.destroy', $cliente->user->id) }}"
                                        data-info="{{ $cliente->nombre }} {{ $cliente->paterno }} {{ $cliente->materno }}"
                                        data-toggle="modal" data-target="#modal-eliminar"
                                        class="eliminar dropdown-item"><i class="fa fa-trash"></i>
                                        Eliminar</a>
                                </div>
                            </div>
                        </div>
                        <div class="foto_cliente">
                            <a href="{{ route('clientes.edit', $cliente->id) }}" class="foto">
                                <img src="{{ asset('imgs/users/' . $cliente->user->foto) }}" alt="Foto">
                            </a>
                        </div>
                        <div class="nombre_cliente">
                            {{ $cliente->nombre }}
                            {{ $cliente->paterno }}
                            {{ $cliente->materno }}
                        </div>
                        <div class="ci_cliente">
                            {{ $cliente->ci }} {{ $cliente->ci_exp }}
                        </div>
                        <div class="ocupacion_cliente">
                            <button class="btn btn-xs text-sm btn-danger btn-block"
                                onclick="reemplazarPassword(event,'{{ $cliente->full_name }}','{{ route('users.reemplazar_password', $cliente->user->id) }}')">Reemplazar
                                contraseña</button>
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
