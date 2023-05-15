@php
    $orden = $entrega->orden;
@endphp
@include('ordens.parcial.orden')
<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <label>Fecha Hora Entrega*</label>
            <div class="row">
                <div class="col-md-6">
                    {{ Form::date('fecha_entrega', isset($entrega) ? $entrega->fecha_entrega : date('Y-m-d'), ['class' => 'form-control', 'required']) }}
                </div>
                <div class="col-md-6">
                    {{ Form::time('hora_entrega', isset($entrega) ? date('H:i', strtotime($entrega->hora_entrega)) : date('H:i'), ['class' => 'form-control', 'required', 'step' => '1']) }}
                </div>
            </div>
        </div>
    </div>
</div>
