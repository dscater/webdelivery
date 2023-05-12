<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label>Cliente*</label>
            @if (isset($entrega))
                @if($entrega->estado == 'ENTREGADO')
                {{ Form::select('cliente', [
                    '' => $entrega->orden->cliente->nombre . ' ' . $entrega->orden->cliente->paterno . ' ' . $entrega->orden->cliente->materno 
                ], null, ['class' => 'form-control', 'required', 'id' => 'orden']) }}
                @else
                {{ Form::select('cliente_id', $array_clientes, null, ['class' => 'form-control', 'required', 'id' => 'cliente_id']) }}
                @endif
            @else
            {{ Form::select('cliente_id', $array_clientes, null, ['class' => 'form-control', 'required', 'id' => 'cliente_id']) }}
            @endif
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group">
            <label>Orden*</label>
            @if (isset($entrega))
                @if($entrega->estado == 'ENTREGADO')
                {{ Form::select('orden', [
                    '' => 'Orden nro. ' . $entrega->orden->nro_orden . ' | ' . $entrega->orden->producto->nombre . ' (' . $entrega->orden->cantidad . ') | ' . 'Empresa ' . $entrega->orden->empresa->nombre . ' | ' . 'Distribuidor ' . $entrega->orden->distribuidor->nombre
                ], null, ['class' => 'form-control', 'required', 'id' => 'orden']) }}
                @else
                {{ Form::select('orden_id', $array_ordens, null, ['class' => 'form-control', 'required', 'id' => 'orden_id']) }}
                @endif
            @else
                {{ Form::select('orden_id', $array_ordens, null, ['class' => 'form-control', 'required', 'id' => 'orden_id']) }}
            @endif
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <label>Fecha Hora Entrega*</label>
            <div class="row">
                <div class="col-md-6">
                    {{ Form::date('fecha_entrega', isset($entrega) ? $entrega->fecha_entrega : date('Y-m-d'), ['class' => 'form-control', 'required']) }}
                </div>
                <div class="col-md-6">
                    {{ Form::time('hora_entrega', isset($entrega) ? $entrega->hora_entrega : date('H:i'), ['class' => 'form-control', 'required']) }}
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
