<div class="row">
    @if (Auth::user()->tipo == 'EMPRESA')
        <input type="hidden" name="empresa_id" id="empresa_id" value="{{ Auth::user()->datosUsuario->empresa_id }}">
    @else
        <div class="col-md-4">
            <div class="form-group">
                <label>Empresa*</label>
                {{ Form::select('empresa_id', $array_empresas, null, ['class' => 'form-control', 'required', 'id' => 'empresa_id']) }}
            </div>
        </div>
    @endif
    <div class="col-md-4">
        <div class="form-group">
            <label>Producto*</label>
            {{ Form::select('producto_id', $array_productos, null, ['class' => 'form-control', 'required', 'id' => 'producto_id']) }}
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label>Cantidad*</label>
            {{ Form::number('cantidad', null, ['class' => 'form-control', 'required', 'step' => '0.01', 'min' => '0.01']) }}
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label>Cliente*</label>
            {{ Form::select('cliente_id', $array_clientes, null, ['class' => 'form-control', 'required', 'id' => 'cliente_id']) }}
        </div>
    </div>
    @if (Auth::user()->tipo == 'DISTRIBUIDOR')
        <input type="hidden" name="distribuidor_id" id="distribuidor_id" value="{{ Auth::user()->id }}">
    @else
        <div class="col-md-4">
            <div class="form-group">
                <label>Distribuidor*</label>
                {{ Form::select('distribuidor_id', $array_distribuidors, null, ['class' => 'form-control', 'required']) }}
            </div>
        </div>
    @endif

    <div class="col-md-4">
        <div class="form-group">
            <label>Fecha Hora Pedido*</label>
            <div class="row">
                <div class="col-md-6">
                    {{ Form::date('fecha_pedido', isset($orden) ? $orden->fecha_pedido : date('Y-m-d'), ['class' => 'form-control', 'required']) }}
                </div>
                <div class="col-md-6">
                    {{ Form::time('hora_pedido', isset($orden) ? $orden->hora_pedido : date('H:i'), ['class' => 'form-control', 'required']) }}
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label>Fecha Hora Entrega*</label>
            <div class="row">
                <div class="col-md-6">
                    {{ Form::date('fecha_entrega', isset($orden) ? $orden->fecha_entrega : date('Y-m-d'), ['class' => 'form-control', 'required']) }}
                </div>
                <div class="col-md-6">
                    {{ Form::time('hora_entrega', isset($orden) ? $orden->hora_entrega : date('H:i'), ['class' => 'form-control', 'required']) }}
                </div>
            </div>
        </div>
    </div>

    {{-- <div class="col-md-4">
        <div class="form-group">
            <label>Estado*</label>
            {{ Form::select('estado', [
                '' => 'Seleccione...',
                'PENDIENTE' =>'PENDIENTE',
                'ENTREGADO' =>'ENTREGADO',
            ], null, ['class' => 'form-control', 'required']) }}
        </div>
    </div> --}}
</div>
